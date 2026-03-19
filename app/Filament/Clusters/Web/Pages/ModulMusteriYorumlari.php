<?php

namespace App\Filament\Clusters\Web\Pages;

class ModulMusteriYorumlari extends BaseModulSectionEditor
{
    protected static ?string $title = 'Müşteri Yorumları';

    protected static ?string $slug = 'web-moduller/ucuncu-grup/musteri-yorumlari';

    protected static function getSectionFileName(): string
    {
        return 'musteri-yorumlari.blade.php';
    }
}

