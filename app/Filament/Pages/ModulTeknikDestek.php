<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class ModulTeknikDestek extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-lifebuoy';
    protected static ?string $navigationGroup = 'Modüller';
    protected static ?int $navigationSort = 7;
    protected static ?string $navigationLabel = 'Teknik Destek';
    protected static ?string $title = 'Teknik Destek Bölümü (teknik-destek.blade)';
    protected static string $view = 'filament.pages.modul-placeholder';
    protected static string $routePath = 'moduller/teknik-destek';

    public static function getRoutePath(): string
    {
        return static::$routePath;
    }
}
