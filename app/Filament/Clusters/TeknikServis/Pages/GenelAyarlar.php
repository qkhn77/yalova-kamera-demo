<?php

namespace App\Filament\Clusters\TeknikServis\Pages;

use App\Filament\Clusters\TeknikServis;
use Filament\Pages\Page;

class GenelAyarlar extends Page
{
    protected static ?string $cluster = TeknikServis::class;
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Genel Ayarlar';
    protected static ?string $slug = 'ayarlar/genel-ayarlar';

    protected static string $view = 'filament.clusters.teknik-servis.pages.genel-ayarlar';
}
