<?php

namespace App\Filament\Clusters\TeknikServis\Pages;

use App\Filament\Clusters\TeknikServis;
use Filament\Pages\Page;

class CihazMarkaModelEkleme extends Page
{
    protected static ?string $cluster = TeknikServis::class;
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Cihaz / Marka / Model Ekleme';
    protected static ?string $slug = 'ayarlar/cihaz-marka-model-ekleme';

    protected static string $view = 'filament.clusters.teknik-servis.pages.cihaz-marka-model-ekleme';
}
