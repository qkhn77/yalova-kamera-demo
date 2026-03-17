<?php

namespace App\Filament\Clusters\TeknikServis\Pages;

use App\Filament\Clusters\TeknikServis;
use Filament\Pages\Page;

class KabulFisi extends Page
{
    protected static ?string $cluster = TeknikServis::class;
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $title = 'Kabul Fisi';
    protected static ?string $slug = 'ayarlar/kabul-fisi';

    protected static string $view = 'filament.clusters.teknik-servis.pages.kabul-fisi';
}
