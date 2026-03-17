<?php

namespace App\Filament\Clusters\TeknikServis\Pages;

use App\Filament\Clusters\TeknikServis;
use Filament\Pages\Page;

class ServisDashboard extends Page
{
    protected static ?string $cluster = TeknikServis::class;
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Servis Dashboard';
    protected static ?string $slug = 'servis-dashboard';

    protected static string $view = 'filament.clusters.teknik-servis.pages.servis-dashboard';
}
