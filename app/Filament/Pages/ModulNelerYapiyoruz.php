<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class ModulNelerYapiyoruz extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';
    protected static ?string $navigationGroup = 'Modüller';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationLabel = 'Neler Yapıyoruz';
    protected static ?string $title = 'Neler Yapıyoruz Bölümü (neler-yapiyoruz.blade)';
    protected static string $view = 'filament.pages.modul-placeholder';
    protected static string $routePath = 'moduller/neler-yapiyoruz';

    public static function getRoutePath(): string
    {
        return static::$routePath;
    }
}
