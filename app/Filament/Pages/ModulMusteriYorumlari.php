<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class ModulMusteriYorumlari extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Modüller';
    protected static ?int $navigationSort = 8;
    protected static ?string $navigationLabel = 'Müşteri Yorumları';
    protected static ?string $title = 'Müşteri Yorumları Bölümü (musteri-yorumlari.blade)';
    protected static string $view = 'filament.pages.modul-placeholder';
    protected static string $routePath = 'moduller/musteri-yorumlari';

    public static function getRoutePath(): string
    {
        return static::$routePath;
    }
}
