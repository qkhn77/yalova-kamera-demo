<?php

namespace App\Policies;

use App\Models\FirmaKullanici;
use App\Models\User;

/**
 * Kiracı firma içi kullanıcı (firma_kullanicilari) kayıtları.
 * Süper admin tüm firmaları görür; kiracı yalnızca aktif firmayı.
 */
class FirmaIciKullaniciPolitikasi extends BasePolicy
{
    protected string $modulKodu = 'kullanici';

    public function viewAny(User $kullanici): bool
    {
        return $this->yetkiKontrol($kullanici, 'kullanici.goruntule', $this->modulKodu, false);
    }

    public function view(User $kullanici, FirmaKullanici $kayit): bool
    {
        if (! $this->yetkiKontrol($kullanici, 'kullanici.goruntule', $this->modulKodu, false)) {
            return false;
        }

        return $this->kayitFirmasiErisilebilirMi($kullanici, $kayit);
    }

    public function create(User $kullanici): bool
    {
        return $this->yetkiKontrol($kullanici, 'kullanici.olustur', $this->modulKodu, true);
    }

    public function update(User $kullanici, FirmaKullanici $kayit): bool
    {
        if (! $this->yetkiKontrol($kullanici, 'kullanici.guncelle', $this->modulKodu, true)) {
            return false;
        }

        return $this->kayitFirmasiErisilebilirMi($kullanici, $kayit);
    }

    public function delete(User $kullanici, FirmaKullanici $kayit): bool
    {
        if ((int) $kullanici->id === (int) $kayit->kullanici_id) {
            return false;
        }

        if (! $this->yetkiKontrol($kullanici, 'kullanici.sil', $this->modulKodu, true)) {
            return false;
        }

        return $this->kayitFirmasiErisilebilirMi($kullanici, $kayit);
    }

    public function restore(User $kullanici, FirmaKullanici $kayit): bool
    {
        return $this->update($kullanici, $kayit);
    }

    protected function kayitFirmasiErisilebilirMi(User $kullanici, FirmaKullanici $kayit): bool
    {
        if ($this->superAdminMi($kullanici)) {
            return true;
        }

        $fid = $this->aktifFirmaId();

        return $fid !== null && $fid === (int) $kayit->firma_id;
    }
}
