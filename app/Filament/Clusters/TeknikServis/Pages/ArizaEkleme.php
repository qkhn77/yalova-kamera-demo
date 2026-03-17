<?php

namespace App\Filament\Clusters\TeknikServis\Pages;

use App\Filament\Clusters\TeknikServis;
use Filament\Pages\Page;

class ArizaEkleme extends Page
{
    protected static ?string $cluster = TeknikServis::class;
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Arıza Ekleme';
    protected static ?string $slug = 'ayarlar/ariza-ekleme';

    protected static string $view = 'filament.clusters.teknik-servis.pages.ariza-ekleme';
}
