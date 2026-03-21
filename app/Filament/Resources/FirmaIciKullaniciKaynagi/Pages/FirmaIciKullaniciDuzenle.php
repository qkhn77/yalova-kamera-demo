<?php

namespace App\Filament\Resources\FirmaIciKullaniciKaynagi\Pages;

use App\Filament\Resources\FirmaIciKullaniciKaynagi;
use App\Models\FirmaKullanici;
use Filament\Resources\Pages\EditRecord;

class FirmaIciKullaniciDuzenle extends EditRecord
{
    protected static string $resource = FirmaIciKullaniciKaynagi::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    /**
     * @param  array<string, mixed>  $veri
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeSave(array $veri): array
    {
        unset($veri['email'], $veri['hedef_firma_id']);

        return $veri;
    }

    /**
     * @param  array<string, mixed>  $veri
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeFill(array $veri): array
    {
        /** @var FirmaKullanici $kayit */
        $kayit = $this->record;
        $kullanici = $kayit->kullanici;
        if ($kullanici) {
            $veri['email'] = $kullanici->email;
            $veri['kullanici_adi'] = $kullanici->kullanici_adi;
            $veri['ad_soyad'] = $kullanici->ad_soyad ?? $kullanici->name;
        }

        return $veri;
    }

    protected function afterSave(): void
    {
        /** @var FirmaKullanici $kayit */
        $kayit = $this->record;
        $kullanici = $kayit->kullanici;
        if (! $kullanici) {
            return;
        }

        $veri = $this->form->getState();
        $guncelle = [
            'kullanici_adi' => $veri['kullanici_adi'] ?? $kullanici->kullanici_adi,
            'ad_soyad' => $veri['ad_soyad'] ?? $kullanici->ad_soyad,
            'name' => $veri['ad_soyad'] ?? $veri['kullanici_adi'] ?? $kullanici->name,
        ];
        if (! empty($veri['password'])) {
            $guncelle['password'] = $veri['password'];
        }
        $kullanici->update($guncelle);
    }
}
