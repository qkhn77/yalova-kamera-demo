<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class ModulNedenBiz extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationGroup = 'Modüller';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Neden Biz';
    protected static ?string $title = 'Neden Biz Bölümü (neden-biz.blade)';
    protected static string $view = 'filament.pages.modul-placeholder';
    protected static string $routePath = 'moduller/neden-biz';

    public static function getRoutePath(): string
    {
        return static::$routePath;
    }
}
