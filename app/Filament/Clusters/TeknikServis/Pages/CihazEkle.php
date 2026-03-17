<?php

namespace App\Filament\Clusters\TeknikServis\Pages;

use App\Filament\Clusters\TeknikServis;
use Filament\Pages\Page;

class CihazEkle extends Page
{
    protected static ?string $cluster = TeknikServis::class;
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Cihaz Ekle';
    protected static ?string $slug = 'cihaz-kayit/cihaz-ekle';

    protected static string $view = 'filament.clusters.teknik-servis.pages.cihaz-ekle';
}
