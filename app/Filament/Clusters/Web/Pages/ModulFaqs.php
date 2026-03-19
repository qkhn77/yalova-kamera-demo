<?php

namespace App\Filament\Clusters\Web\Pages;

class ModulFaqs extends BaseModulSectionEditor
{
    protected static ?string $title = 'SSS';

    protected static ?string $slug = 'web-moduller/ucuncu-grup/faqs';

    protected static function getSectionFileName(): string
    {
        return 'faqs.blade.php';
    }
}

