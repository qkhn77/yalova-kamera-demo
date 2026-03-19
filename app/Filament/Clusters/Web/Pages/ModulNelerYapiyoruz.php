<?php

namespace App\Filament\Clusters\Web\Pages;

class ModulNelerYapiyoruz extends BaseModulSectionEditor
{
    protected static ?string $title = 'Neler Yapıyoruz';

    protected static ?string $slug = 'web-moduller/ucuncu-grup/neler-yapiyoruz';

    protected static function getSectionFileName(): string
    {
        return 'neler-yapiyoruz.blade.php';
    }
}

