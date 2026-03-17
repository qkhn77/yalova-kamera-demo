<?php

namespace App\Filament\Clusters\TeknikServis\Pages;

use App\Filament\Clusters\TeknikServis;
use Filament\Pages\Page;

class ServisEkle extends Page
{
    protected static ?string $cluster = TeknikServis::class;
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Servis Ekle';
    protected static ?string $slug = 'servis-kayit/servis-ekle';

    protected static string $view = 'filament.clusters.teknik-servis.pages.servis-ekle';
}
