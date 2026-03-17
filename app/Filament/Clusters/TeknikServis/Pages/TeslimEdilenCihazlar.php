<?php

namespace App\Filament\Clusters\TeknikServis\Pages;

use App\Filament\Clusters\TeknikServis;
use Filament\Pages\Page;

class TeslimEdilenCihazlar extends Page
{
    protected static ?string $cluster = TeknikServis::class;
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Teslim Edilen Cihazlar';
    protected static ?string $slug = 'cihaz-kayit/teslim-edilen-cihazlar';

    protected static string $view = 'filament.clusters.teknik-servis.pages.teslim-edilen-cihazlar';
}
