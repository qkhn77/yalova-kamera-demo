<?php

namespace App\Filament\Clusters\TeknikServis\Pages;

use App\Filament\Clusters\TeknikServis;
use Filament\Pages\Page;

class TamamlananServisler extends Page
{
    protected static ?string $cluster = TeknikServis::class;
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Tamamlanan Servisler';
    protected static ?string $slug = 'servis-kayit/tamamlanan-servisler';

    protected static string $view = 'filament.clusters.teknik-servis.pages.tamamlanan-servisler';
}
