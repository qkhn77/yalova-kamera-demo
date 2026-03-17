<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class ModulRakamlarlaBiz extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-calculator';
    protected static ?string $navigationGroup = 'Modüller';
    protected static ?int $navigationSort = 6;
    protected static ?string $navigationLabel = 'Rakamlarla Biz';
    protected static ?string $title = 'Rakamlarla Biz Bölümü (rakamlarla-biz.blade)';
    protected static string $view = 'filament.pages.modul-placeholder';
    protected static string $routePath = 'moduller/rakamlarla-biz';

    public static function getRoutePath(): string
    {
        return static::$routePath;
    }
}
