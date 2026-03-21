<?php

namespace App\Support;

use App\Providers\Filament\AdminPanelProvider;

/**
 * Tek Filament paneli — firma ve yönetici girişleri sonrası ortak hedef URL.
 */
class PanelYonlendirme
{
    public static function anaSayfaUrl(): string
    {
        return url(AdminPanelProvider::adminPath());
    }
}

