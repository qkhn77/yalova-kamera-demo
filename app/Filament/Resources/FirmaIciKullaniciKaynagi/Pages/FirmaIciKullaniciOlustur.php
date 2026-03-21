<?php

namespace App\Filament\Resources\FirmaIciKullaniciKaynagi\Pages;

use App\Filament\Resources\FirmaIciKullaniciKaynagi;
use App\Models\FirmaKullanici;
use App\Models\User;
use App\Services\TenantContextService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class FirmaIciKullaniciOlustur extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = FirmaIciKullaniciKaynagi::class;

    /**
     * @param  array<string, mixed>  $data
     */
    protected function handleRecordCreation(array $data): Model
    {
        $firmaId = (int) ($data['hedef_firma_id'] ?? app(TenantContextService::class)->aktifFirmaId() ?? 0);
        if ($firmaId <= 0) {
            throw ValidationException::withMessages(['hedef_firma_id' => 'Geçerli firma seçilmelidir.']);
        }

        $email = strtolower(trim((string) ($data['email'] ?? '')));
        if ($email === '') {
            throw ValidationException::withMessages(['email' => 'E-posta zorunludur.']);
        }

        $mevcutKullanici = User::query()->where('email', $email)->first();

        if ($mevcutKullanici) {
            if (FirmaKullanici::query()
                ->withoutGlobalScopes()
                ->where('firma_id', $firmaId)
                ->where('kullanici_id', $mevcutKullanici->id)
                ->whereNull('deleted_at')
                ->exists()) {
                throw ValidationException::withMessages(['email' => 'Bu e-posta bu firmada zaten kayıtlı.']);
            }

            if ((bool) ($mevcutKullanici->super_admin_mi ?? false)) {
                throw ValidationException::withMessages(['email' => 'Sistem yöneticisi bu ekrandan firmaya eklenemez.']);
            }

            $guncelle = [
                'kullanici_adi' => $data['kullanici_adi'],
                'ad_soyad' => $data['ad_soyad'] ?? $mevcutKullanici->ad_soyad,
                'name' => $data['ad_soyad'] ?? $data['kullanici_adi'] ?? $mevcutKullanici->name,
            ];
            if (! empty($data['password'])) {
                $guncelle['password'] = $data['password'];
            }
            $mevcutKullanici->update($guncelle);
            $kullanici = $mevcutKullanici;
        } else {
            if (empty($data['password'])) {
                throw ValidationException::withMessages(['password' => 'Yeni kullanıcı için şifre zorunludur.']);
            }

            $kullanici = User::query()->create([
                'email' => $email,
                'password' => $data['password'],
                'kullanici_adi' => $data['kullanici_adi'],
                'ad_soyad' => $data['ad_soyad'] ?? null,
                'name' => $data['ad_soyad'] ?? $data['kullanici_adi'],
            ]);
        }

        return FirmaKullanici::query()->create([
            'firma_id' => $firmaId,
            'kullanici_id' => $kullanici->id,
            'rol_id' => $data['rol_id'] ?? null,
            'durum' => $data['durum'] ?? 'aktif',
            'onay_durumu' => $data['onay_durumu'] ?? 'aktif',
            'varsayilan_firma_mi' => (bool) ($data['varsayilan_firma_mi'] ?? false),
        ]);
    }
}
