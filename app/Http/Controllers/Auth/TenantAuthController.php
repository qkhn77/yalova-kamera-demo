<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Firma;
use App\Models\FirmaKullanici;
use App\Models\User;
use App\Services\TenantContextService;
use App\Support\PanelYonlendirme;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\View\View;

class TenantAuthController extends Controller
{
    public function girisFormu(): View
    {
        return view('auth.tenant-login');
    }

    public function giris(Request $request, TenantContextService $tenantBaglam): RedirectResponse
    {
        $dogrulanmis = $request->validate([
            'firma_kodu' => ['required', 'string', 'max:100'],
            'kullanici_adi_veya_eposta' => ['required', 'string', 'max:255'],
            'sifre' => ['required', 'string', 'max:255'],
        ], [
            'firma_kodu.required' => 'Firma kodu zorunludur.',
            'kullanici_adi_veya_eposta.required' => 'Kullanıcı adı veya e-posta zorunludur.',
            'sifre.required' => 'Şifre zorunludur.',
        ]);

        $firma = Firma::query()
            ->where('firma_kodu', $dogrulanmis['firma_kodu'])
            ->first();

        if (! $firma || $firma->durum !== 'aktif') {
            return back()->withErrors([
                'firma_kodu' => 'Firma kodu geçersiz veya firma aktif değil.',
            ])->withInput($request->except('sifre'));
        }

        $girisKimlik = trim((string) $dogrulanmis['kullanici_adi_veya_eposta']);

        $kullanici = $this->firmaIcinKullaniciBul($firma, $girisKimlik);

        if (! $kullanici || ! Hash::check($dogrulanmis['sifre'], $kullanici->password)) {
            return back()->withErrors([
                'kullanici_adi_veya_eposta' => 'Kullanıcı bilgisi veya şifre hatalı.',
            ])->withInput($request->except('sifre'));
        }

        $yoneticiHesapMi = (bool) ($kullanici->super_admin_mi ?? false) || (bool) ($kullanici->is_admin ?? false);
        if ($yoneticiHesapMi) {
            return back()->withErrors([
                'firma_kodu' => 'Sistem yönetici hesapları firma girişi kullanamaz. Lütfen yönetici giriş sayfasını kullanın: '.route('yonetici.login'),
            ])->withInput($request->except('sifre'));
        }

        $firmaKullanici = FirmaKullanici::query()
            ->withoutGlobalScopes()
            ->where('firma_id', $firma->id)
            ->where('kullanici_id', $kullanici->id)
            ->whereNull('deleted_at')
            ->first();

        if (! $firmaKullanici || $firmaKullanici->durum !== 'aktif') {
            return back()->withErrors([
                'firma' => 'Bu kullanıcı seçilen firmada aktif değil.',
            ])->withInput($request->except('sifre'));
        }

        if (isset($firmaKullanici->onay_durumu)
            && $firmaKullanici->onay_durumu !== null
            && (string) $firmaKullanici->onay_durumu !== 'aktif') {
            return back()->withErrors([
                'firma' => 'Hesabınız henüz onaylanmamış.',
            ])->withInput($request->except('sifre'));
        }

        Auth::login($kullanici, $request->boolean('beni_hatirla'));
        $request->session()->regenerate();

        $tenantBaglam->firmaAyarla(
            $firma,
            $firmaKullanici->rol_id ? (int) $firmaKullanici->rol_id : null,
            (int) $firmaKullanici->id
        );

        return redirect()->intended(PanelYonlendirme::anaSayfaUrl());
    }

    /**
     * Firma bağlantılı kullanıcı; ileride User scope’ları eklense bile sorgu tutarlı kalsın.
     */
    private function firmaIcinKullaniciBul(Firma $firma, string $girisKimlik): ?User
    {
        $tablo = (new User)->getTable();

        return User::query()
            ->withoutGlobalScopes()
            ->whereNull($tablo.'.deleted_at')
            ->where(function ($sorgu) use ($girisKimlik): void {
                $sorgu->where('kullanici_adi', $girisKimlik)
                    ->orWhere('email', $girisKimlik);
            })
            ->whereExists(function ($sorgu) use ($firma, $tablo): void {
                $sorgu->selectRaw('1')
                    ->from('firma_kullanicilari')
                    ->whereColumn('firma_kullanicilari.kullanici_id', $tablo.'.id')
                    ->where('firma_kullanicilari.firma_id', $firma->id)
                    ->where('firma_kullanicilari.durum', 'aktif')
                    ->whereNull('firma_kullanicilari.deleted_at');
            })
            ->first();
    }

    /**
     * Tenant oturum temizliği Auth çıkış olayında (AppServiceProvider) tek merkezden yapılır.
     */
    public function cikis(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('tenant.login');
    }

    public function firmaKoduBulFormu(): View
    {
        return view('auth.firma-kodu-bul');
    }

    public function firmaKoduBul(Request $request): RedirectResponse
    {
        $request->validate([
            'firma_adi' => ['required', 'string', 'min:3', 'max:255'],
        ], [
            'firma_adi.required' => 'Firma adı zorunludur.',
            'firma_adi.min' => 'En az 3 karakter girmelisiniz.',
        ]);

        $anahtar = 'firma-kodu-bul:'.sha1($request->ip());
        if (RateLimiter::tooManyAttempts($anahtar, 5)) {
            return back()->withErrors([
                'firma_adi' => 'Çok fazla deneme yaptınız. Lütfen biraz sonra tekrar deneyin.',
            ])->withInput();
        }

        RateLimiter::hit($anahtar, 60);

        $firmalar = Firma::query()
            ->where('durum', 'aktif')
            ->where('ad', 'like', '%'.$request->string('firma_adi').'%')
            ->orderBy('ad')
            ->limit(5)
            ->get(['id', 'ad', 'firma_kodu']);

        if ($firmalar->isEmpty()) {
            return back()->withErrors([
                'firma_adi' => 'Bu isimle eşleşen aktif firma bulunamadı.',
            ])->withInput();
        }

        return back()->with('bulunan_firma_kodlari', $firmalar->map(function (Firma $firma): array {
            return [
                'ad' => $firma->ad,
                'firma_kodu' => $firma->firma_kodu,
            ];
        })->all());
    }
}
