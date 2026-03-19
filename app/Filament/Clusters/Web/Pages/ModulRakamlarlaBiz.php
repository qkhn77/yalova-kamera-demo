<?php

namespace App\Filament\Clusters\Web\Pages;

class ModulRakamlarlaBiz extends BaseModulSectionEditor
{
    protected static ?string $title = 'Rakamlarla Biz';

    protected static ?string $slug = 'web-moduller/ucuncu-grup/rakamlarla-biz';

    protected static function getSectionFileName(): string
    {
        return 'rakamlarla-biz.blade.php';
    }
}

