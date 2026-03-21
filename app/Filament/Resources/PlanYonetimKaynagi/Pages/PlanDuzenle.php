<?php

namespace App\Filament\Resources\PlanYonetimKaynagi\Pages;

use App\Filament\Resources\PlanYonetimKaynagi;
use App\Models\Plan;
use App\Support\DenetimYardimcisi;
use Filament\Resources\Pages\EditRecord;

class PlanDuzenle extends EditRecord
{
    protected static string $resource = PlanYonetimKaynagi::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function afterSave(): void
    {
        DenetimYardimcisi::kaydet(
            'plan_guncellendi',
            Plan::class,
            (int) $this->record->id,
            null,
            null,
            $this->record->only(['ad', 'kod', 'ucret', 'sure_gun', 'aktif_mi'])
        );
    }
}
