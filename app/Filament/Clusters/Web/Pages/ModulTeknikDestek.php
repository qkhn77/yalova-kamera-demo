<?php

namespace App\Filament\Clusters\Web\Pages;

class ModulTeknikDestek extends BaseModulSectionEditor
{
    protected static ?string $title = 'Teknik Destek';

    protected static ?string $slug = 'web-moduller/ucuncu-grup/teknik-destek';

    protected static function getSectionFileName(): string
    {
        return 'teknik-destek.blade.php';
    }
}

