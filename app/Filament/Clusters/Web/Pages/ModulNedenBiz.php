<?php

namespace App\Filament\Clusters\Web\Pages;

class ModulNedenBiz extends BaseModulSectionEditor
{
    protected static ?string $title = 'Neden Biz';

    protected static ?string $slug = 'web-moduller/ucuncu-grup/neden-biz';

    protected static function getSectionFileName(): string
    {
        return 'neden-biz.blade.php';
    }
}

