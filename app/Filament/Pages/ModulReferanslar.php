<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class ModulReferanslar extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationGroup = 'Modüller';
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationLabel = 'Referanslar';
    protected static ?string $title = 'Referanslar Bölümü (referanslar.blade)';
    protected static string $view = 'filament.pages.modul-placeholder';
    protected static string $routePath = 'moduller/referanslar';

    public static function getRoutePath(): string
    {
        return static::$routePath;
    }
}
