<?php

namespace App\Filament\Pages;

use App\Filament\Resources\RoleResource;
use Filament\Pages\Page;
protected static bool $shouldRegisterNavigation = false;
class GrupEkle extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-plus-circle';
    protected static ?string $navigationGroup = 'Kullanıcılar';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationLabel = 'Grup Ekle';
    protected static ?string $title = 'Yeni Grup / Yetki';
    protected static string $view = 'filament.pages.redirect-placeholder';
    protected static string $routePath = 'kullanicilar/grup/ekle';

    public function mount(): void
    {
        $this->redirect(RoleResource::getUrl('create'));
    }

    public static function getRoutePath(): string
    {
        return static::$routePath;
    }
}
