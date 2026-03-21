<?php

namespace App\Policies;

use App\Models\KullaniciYetki;
use App\Models\User;

/**
 * kullanici_yetkileri — ver / reddet satırları.
 */
class KullaniciOzelYetkiPolitikasi extends BasePolicy
{
    protected string $modulKodu = 'kullanici';

    public function viewAny(User $kullanici): bool
    {
        return $this->yetkiKontrol($kullanici, 'kullanici.guncelle', $this->modulKodu, false)
            || $this->yetkiKontrol($kullanici, 'kullanici.yonet', $this->modulKodu, false);
    }

    public function view(User $kullanici, KullaniciYetki $kayit): bool
    {
        return $this->satirOkunabilirMi($kullanici, $kayit);
    }

    public function create(User $kullanici): bool
    {
        return $this->yetkiKontrol($kullanici, 'kullanici.yonet', $this->modulKodu, true);
    }

    public function update(User $kullanici, KullaniciYetki $kayit): bool
    {
        return $this->satirYazilabilirMi($kullanici, $kayit);
    }

    public function delete(User $kullanici, KullaniciYetki $kayit): bool
    {
        return $this->satirYazilabilirMi($kullanici, $kayit);
    }

    protected function satirOkunabilirMi(User $kullanici, KullaniciYetki $kayit): bool
    {
        if ($this->superAdminMi($kullanici)) {
            return true;
        }

        $fid = $this->aktifFirmaId();
        if ($fid === null || $fid !== (int) $kayit->firma_id) {
            return false;
        }

        return $this->yetkiKontrol($kullanici, 'kullanici.guncelle', $this->modulKodu, false)
            || $this->yetkiKontrol($kullanici, 'kullanici.yonet', $this->modulKodu, false);
    }

    protected function satirYazilabilirMi(User $kullanici, KullaniciYetki $kayit): bool
    {
        if (! $this->yetkiKontrol($kullanici, 'kullanici.yonet', $this->modulKodu, true)) {
            return false;
        }

        if ($this->superAdminMi($kullanici)) {
            return true;
        }

        $fid = $this->aktifFirmaId();

        return $fid !== null && $fid === (int) $kayit->firma_id;
    }
}
