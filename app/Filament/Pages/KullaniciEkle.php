<?php

namespace App\Filament\Pages;
protected static bool $shouldRegisterNavigation = false;
use App\Filament\Resources\UserResource;
use Filament\Pages\Page;

class KullaniciEkle extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-plus-circle';
    protected static ?string $navigationGroup = 'Kullanıcılar';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Kullanıcı Ekle';
    protected static ?string $title = 'Yeni Kullanıcı';
    protected static string $view = 'filament.pages.redirect-placeholder';
    protected static string $routePath = 'kullanicilar/ekle';

    public function mount(): void
    {
        $this->redirect(UserResource::getUrl('create'));
    }

    public static function getRoutePath(): string
    {
        return static::$routePath;
    }
}
