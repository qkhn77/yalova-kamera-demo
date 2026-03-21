<?php

namespace App\Filament\Resources\FirmaYonetimKaynagi\Pages;

use App\Filament\Resources\FirmaYonetimKaynagi;
use App\Models\Firma;
use App\Support\DenetimYardimcisi;
use App\Support\FirmaKoduUretici;
use Filament\Resources\Pages\CreateRecord;

class FirmaOlustur extends CreateRecord
{
    protected static string $resource = FirmaYonetimKaynagi::class;

    protected function mutateFormDataBeforeCreate(array $veri): array
    {
        if (empty($veri['firma_kodu'])) {
            $veri['firma_kodu'] = FirmaKoduUretici::birSonraki();
        }

        return $veri;
    }

    protected function afterCreate(): void
    {
        DenetimYardimcisi::kaydet(
            'firma_olusturuldu',
            Firma::class,
            (int) $this->record->id,
            (int) $this->record->id,
            null,
            ['ad' => $this->record->ad, 'firma_kodu' => $this->record->firma_kodu]
        );
    }
}
