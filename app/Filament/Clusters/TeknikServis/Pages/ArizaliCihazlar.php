<?php

namespace App\Filament\Clusters\TeknikServis\Pages;

use App\Filament\Clusters\TeknikServis;
use Filament\Pages\Page;

class ArizaliCihazlar extends Page
{
    protected static ?string $cluster = TeknikServis::class;
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Arızalı Cihaz Listesi';
    protected static ?string $slug = 'cihaz-kayit/arizali-cihazlar';

    protected static string $view = 'filament.clusters.teknik-servis.pages.arizali-cihazlar';
}
