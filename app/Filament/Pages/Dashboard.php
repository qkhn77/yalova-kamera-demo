<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\KiraciOzetWidget;
use Filament\Facades\Filament;
use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Support\Facades\Auth;

class Dashboard extends BaseDashboard
{
    protected static bool $shouldRegisterNavigation = false;

    /**
     * Kiracı: özet widget; süper admin: panelde tanımlı varsayılan widget’lar.
     *
     * @return array<class-string<\Filament\Widgets\Widget>|\Filament\Widgets\WidgetConfiguration>
     */
    public function getWidgets(): array
    {
        $kullanici = Auth::user();
        $kiraciMi = $kullanici
            && ! ((bool) ($kullanici->super_admin_mi ?? false) || (bool) ($kullanici->is_admin ?? false));

        if ($kiraciMi) {
            return [
                KiraciOzetWidget::class,
            ];
        }

        return Filament::getWidgets();
    }
}
