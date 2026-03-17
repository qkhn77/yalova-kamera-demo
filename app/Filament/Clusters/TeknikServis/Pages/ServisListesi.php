<?php

namespace App\Filament\Clusters\TeknikServis\Pages;

use App\Filament\Clusters\TeknikServis;
use Filament\Pages\Page;

class ServisListesi extends Page
{
    protected static ?string $cluster = TeknikServis::class;
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Servis Listesi';
    protected static ?string $slug = 'servis-kayit/servis-listesi';

    protected static string $view = 'filament.clusters.teknik-servis.pages.servis-listesi';
}
