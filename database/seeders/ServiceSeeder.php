<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['title' => 'IP Kamera Kurulumu', 'short_description' => 'Keşif, montaj ve devreye alma.', 'image' => 'service-image-1.jpg', 'icon' => 'icon-service-item-1.svg', 'sort_order' => 1],
            ['title' => '7/24 Teknik Servis', 'short_description' => 'Arıza tespit, onarım ve destek.', 'image' => 'service-image-2.jpg', 'icon' => 'icon-service-item-2.svg', 'sort_order' => 2],
            ['title' => 'Alarm Sistemleri', 'short_description' => 'Kablosuz/kablolu alarm çözümleri.', 'image' => 'service-image-3.jpg', 'icon' => 'icon-service-item-3.svg', 'sort_order' => 3],
            ['title' => 'Access Control', 'short_description' => 'Kartlı geçiş, kapı kontrol sistemleri.', 'image' => 'service-image-4.jpg', 'icon' => 'icon-service-item-4.svg', 'sort_order' => 4],
            ['title' => 'Akıllı Ev Entegrasyonu', 'short_description' => 'Uygulama ile uzaktan izleme ve kontrol.', 'image' => 'service-image-5.jpg', 'icon' => 'icon-service-item-5.svg', 'sort_order' => 5],
            ['title' => 'Periyodik Bakım', 'short_description' => 'Kayıt sistemi ve kamera bakımı.', 'image' => 'service-image-6.jpg', 'icon' => 'icon-service-item-6.svg', 'sort_order' => 6],
        ];

        foreach ($items as $item) {
            Service::firstOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($item['title'])],
                array_merge($item, ['is_active' => true])
            );
        }
    }
}
