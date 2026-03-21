<?php

namespace Database\Seeders;

use App\Models\Rol;
use App\Models\Yetki;
use Illuminate\Database\Seeder;

class SaasRolePermissionMatrixSeeder extends Seeder
{
    public function run(): void
    {
        $matrix = [
            'firma_sahibi' => [
                'kullanici.goruntule', 'kullanici.olustur', 'kullanici.guncelle', 'kullanici.sil', 'kullanici.yonet',
                'firma.goruntule', 'firma.guncelle', 'firma.onay',
                'modul.goruntule', 'modul.yonet',
                'muhasebe.goruntule', 'muhasebe.olustur', 'muhasebe.guncelle', 'muhasebe.sil',
                'teknik_servis.goruntule', 'teknik_servis.olustur', 'teknik_servis.guncelle', 'teknik_servis.sil',
                'barkodlu_satis.goruntule', 'barkodlu_satis.olustur', 'barkodlu_satis.guncelle',
                'depo.goruntule', 'depo.olustur', 'depo.guncelle',
                'restoran.goruntule', 'restoran.olustur', 'restoran.guncelle',
                'proje_yonetimi.goruntule', 'proje_yonetimi.olustur', 'proje_yonetimi.guncelle', 'proje_yonetimi.sil',
                'personel_takip.goruntule', 'personel_takip.olustur', 'personel_takip.guncelle',
                'teklif_yonetimi.goruntule', 'teklif_yonetimi.olustur', 'teklif_yonetimi.guncelle', 'teklif_yonetimi.sil',
                'e_ticaret.goruntule', 'e_ticaret.olustur', 'e_ticaret.guncelle',
                'bt_varlik_yonetimi.goruntule', 'bt_varlik_yonetimi.olustur', 'bt_varlik_yonetimi.guncelle', 'bt_varlik_yonetimi.sil',
                'web.goruntule', 'web.olustur', 'web.guncelle', 'web.sil',
                'urun.goruntule', 'urun.olustur', 'urun.guncelle', 'urun.sil',
                'urun_kategori.goruntule', 'urun_kategori.olustur', 'urun_kategori.guncelle', 'urun_kategori.sil',
            ],
            'firma_yoneticisi' => [
                'kullanici.goruntule', 'kullanici.olustur', 'kullanici.guncelle',
                'firma.goruntule', 'firma.guncelle',
                'modul.goruntule',
                'muhasebe.goruntule', 'muhasebe.olustur', 'muhasebe.guncelle',
                'teknik_servis.goruntule', 'teknik_servis.olustur', 'teknik_servis.guncelle',
                'barkodlu_satis.goruntule', 'barkodlu_satis.olustur', 'barkodlu_satis.guncelle',
                'depo.goruntule', 'depo.olustur', 'depo.guncelle',
                'restoran.goruntule', 'restoran.olustur', 'restoran.guncelle',
                'proje_yonetimi.goruntule', 'proje_yonetimi.olustur', 'proje_yonetimi.guncelle',
                'personel_takip.goruntule', 'personel_takip.olustur', 'personel_takip.guncelle',
                'teklif_yonetimi.goruntule', 'teklif_yonetimi.olustur', 'teklif_yonetimi.guncelle',
                'e_ticaret.goruntule', 'e_ticaret.olustur', 'e_ticaret.guncelle',
                'bt_varlik_yonetimi.goruntule', 'bt_varlik_yonetimi.olustur', 'bt_varlik_yonetimi.guncelle',
                'web.goruntule', 'web.olustur', 'web.guncelle',
                'urun.goruntule', 'urun.olustur', 'urun.guncelle',
                'urun_kategori.goruntule', 'urun_kategori.olustur', 'urun_kategori.guncelle',
            ],
            'muhasebe_personeli' => [
                'muhasebe.goruntule', 'muhasebe.olustur', 'muhasebe.guncelle',
                'depo.goruntule',
                'teklif_yonetimi.goruntule',
                'firma.goruntule',
            ],
            'teknik_servis_personeli' => [
                'teknik_servis.goruntule', 'teknik_servis.olustur', 'teknik_servis.guncelle',
                'depo.goruntule',
                'urun.goruntule',
                'urun_kategori.goruntule',
                'firma.goruntule',
            ],
            'satis_personeli' => [
                'barkodlu_satis.goruntule', 'barkodlu_satis.olustur', 'barkodlu_satis.guncelle',
                'teklif_yonetimi.goruntule', 'teklif_yonetimi.olustur', 'teklif_yonetimi.guncelle',
                'urun.goruntule', 'urun.olustur', 'urun.guncelle',
                'urun_kategori.goruntule',
                'e_ticaret.goruntule',
                'firma.goruntule',
            ],
            'depo_personeli' => [
                'depo.goruntule', 'depo.olustur', 'depo.guncelle',
                'urun.goruntule', 'urun.guncelle',
                'urun_kategori.goruntule',
                'barkodlu_satis.goruntule',
                'firma.goruntule',
            ],
            'goruntuleyici' => [
                'firma.goruntule',
                'muhasebe.goruntule',
                'teknik_servis.goruntule',
                'barkodlu_satis.goruntule',
                'depo.goruntule',
                'restoran.goruntule',
                'proje_yonetimi.goruntule',
                'personel_takip.goruntule',
                'teklif_yonetimi.goruntule',
                'e_ticaret.goruntule',
                'bt_varlik_yonetimi.goruntule',
                'web.goruntule',
                'urun.goruntule',
                'urun_kategori.goruntule',
            ],
        ];

        foreach ($matrix as $rolKodu => $yetkiKodlari) {
            $rol = Rol::query()->where('kod', $rolKodu)->first();
            if (! $rol) {
                continue;
            }

            $yetkiIdleri = Yetki::query()
                ->whereIn('kod', array_values(array_unique($yetkiKodlari)))
                ->pluck('id')
                ->all();

            if (! empty($yetkiIdleri)) {
                $rol->yetkiler()->syncWithoutDetaching($yetkiIdleri);
            }
        }
    }
}
