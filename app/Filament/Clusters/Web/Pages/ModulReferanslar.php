<?php

namespace App\Filament\Clusters\Web\Pages;

class ModulReferanslar extends BaseModulSectionEditor
{
    protected static ?string $title = 'Referanslar';

    protected static ?string $slug = 'web-moduller/ucuncu-grup/referanslar';

    protected static function getSectionFileName(): string
    {
        return 'referanslar.blade.php';
    }
}

