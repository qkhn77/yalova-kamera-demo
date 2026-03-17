<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class ModulFaqs extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';
    protected static ?string $navigationGroup = 'Modüller';
    protected static ?int $navigationSort = 9;
    protected static ?string $navigationLabel = 'S.S.S. / F.A.Q.S';
    protected static ?string $title = 'Sıkça Sorulan Sorular (faqs.blade)';
    protected static string $view = 'filament.pages.modul-placeholder';
    protected static string $routePath = 'moduller/faqs';

    public static function getRoutePath(): string
    {
        return static::$routePath;
    }
}
