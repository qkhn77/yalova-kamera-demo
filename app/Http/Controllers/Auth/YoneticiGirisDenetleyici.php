<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\TenantContextService;
use App\Support\KullaniciTablosuYardimcisi;
use App\Support\PanelYonlendirme;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class YoneticiGirisDenetleyici extends Controller
{
    public function girisFormu(): View
    {
        return view('auth.yonetici-giris');
    }

    public function giris(Request $request, TenantContextService $tenantBaglam): RedirectResponse
    {
        $dogrulanmis = $request->validate([
            'kullanici_adi_veya_eposta' => ['required', 'string', 'max:255'],
            'sifre' => ['required', 'string', 'max:255'],
        ], [
            'kullanici_adi_veya_eposta.required' => 'Kullanıcı adı veya e-posta zorunludur.',
            'sifre.required' => 'Şifre zorunludur.',
        ]);

        $kimlik = trim((string) $dogrulanmis['kullanici_adi_veya_eposta']);

        $kullanici = $this->kullaniciKimligiyleBul($kimlik);

        if (! $kullanici || ! Hash::check($dogrulanmis['sifre'], $kullanici->password)) {
            return back()->withErrors([
                'kullanici_adi_veya_eposta' => 'Kullanıcı bilgisi veya şifre hatalı.',
            ])->withInput($request->except('sifre'));
        }

        $yoneticiMi = (bool) ($kullanici->super_admin_mi ?? false) || (bool) ($kullanici->is_admin ?? false);
        if (! $yoneticiMi) {
            return back()->withErrors([
                'kullanici_adi_veya_eposta' => 'Bu giriş yalnızca sistem yöneticileri içindir. Firma kullanıcıları için /giris adresini kullanın.',
            ])->withInput($request->except('sifre'));
        }

        $tenantBaglam->temizle();

        Auth::login($kullanici, $request->boolean('beni_hatirla'));
        $request->session()->regenerate();

        return redirect()->intended(PanelYonlendirme::anaSayfaUrl());
    }

    /**
     * İleride User üzerinde ek global scope olsa bile giriş sorgusu kırılmasın.
     * Soft delete: silinmiş kayıtlar hâlâ dışarıda kalır.
     */
    private function kullaniciKimligiyleBul(string $kimlik): ?User
    {
        $tablo = (new User)->getTable();

        $sorgu = User::query()
            ->withoutGlobalScopes();

        KullaniciTablosuYardimcisi::kullaniciSilinmemisFiltresiUygula($sorgu, $tablo);

        return $sorgu
            ->where(function ($sorgu) use ($kimlik): void {
                $sorgu->where('kullanici_adi', $kimlik)
                    ->orWhere('email', $kimlik);
            })
            ->first();
    }
}
