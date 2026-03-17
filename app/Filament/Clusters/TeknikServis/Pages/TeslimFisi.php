<?php

namespace App\Filament\Clusters\TeknikServis\Pages;

use App\Filament\Clusters\TeknikServis;
use Filament\Pages\Page;

class TeslimFisi extends Page
{
    protected static ?string $cluster = TeknikServis::class;
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Teslim Fişi';
    protected static ?string $slug = 'ayarlar/teslim-fisi';

    protected static string $view = 'filament.clusters.teknik-servis.pages.teslim-fisi';
}
