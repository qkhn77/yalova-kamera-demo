<?php

namespace Database\Seeders;

use App\Models\Yetki;
use Illuminate\Database\Seeder;

class SaasPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $kapsamlar = [
            'muhasebe' => ['Muhasebe', ['goruntule', 'olustur', 'guncelle', 'sil']],
            'teknik_servis' => ['Teknik Servis', ['goruntule', 'olustur', 'guncelle', 'sil']],
            'barkodlu_satis' => ['Barkodlu Satış', ['goruntule', 'olustur', 'guncelle']],
            'depo' => ['Depo', ['goruntule', 'olustur', 'guncelle']],
            'restoran' => ['Restoran', ['goruntule', 'olustur', 'guncelle']],
            'proje_yonetimi' => ['Proje Yönetimi', ['goruntule', 'olustur', 'guncelle', 'sil']],
            'personel_takip' => ['Personel Takip', ['goruntule', 'olustur', 'guncelle']],
            'teklif_yonetimi' => ['Teklif Yönetimi', ['goruntule', 'olustur', 'guncelle', 'sil']],
            'e_ticaret' => ['E-ticaret', ['goruntule', 'olustur', 'guncelle']],
            'bt_varlik_yonetimi' => ['BT Varlık Yönetimi', ['goruntule', 'olustur', 'guncelle', 'sil']],
            'web' => ['Web', ['goruntule', 'olustur', 'guncelle', 'sil']],
            'urun' => ['Ürün', ['goruntule', 'olustur', 'guncelle', 'sil']],
            'urun_kategori' => ['Ürün Kategori', ['goruntule', 'olustur', 'guncelle', 'sil']],
            // Sistem / iç alan izinleri (modül aboneliğinden bağımsız, yetkiye bağlı).
            'kullanici' => ['Kullanıcı', ['goruntule', 'olustur', 'guncelle', 'sil', 'yonet']],
            'firma' => ['Firma', ['goruntule', 'guncelle', 'onay']],
            'modul' => ['Modül', ['goruntule', 'yonet']],
        ];

        foreach ($kapsamlar as $kodOnEk => [$adOnEk, $eylemler]) {
            foreach ($eylemler as $eylem) {
                $kod = "{$kodOnEk}.{$eylem}";
                $ad = "{$adOnEk} " . ucfirst($eylem);

                Yetki::query()->updateOrCreate(
                    ['kod' => $kod],
                    [
                        'ad' => $ad,
                        'modul_kodu' => $kodOnEk,
                        'eylem' => $eylem,
                    ]
                );
            }
        }
    }
}
