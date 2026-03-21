<?php

namespace App\Filament\Resources\FirmaYonetimKaynagi\Pages;

use App\Filament\Resources\FirmaYonetimKaynagi;
use App\Models\Firma;
use App\Support\DenetimYardimcisi;
use Filament\Resources\Pages\EditRecord;

class FirmaDuzenle extends EditRecord
{
    protected static string $resource = FirmaYonetimKaynagi::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function afterSave(): void
    {
        DenetimYardimcisi::kaydet(
            'firma_guncellendi',
            Firma::class,
            (int) $this->record->id,
            (int) $this->record->id,
            null,
            $this->record->only(['ad', 'durum', 'firma_kodu', 'eposta', 'telefon'])
        );
    }
}
