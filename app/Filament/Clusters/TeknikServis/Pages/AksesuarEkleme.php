<?php

namespace App\Filament\Clusters\TeknikServis\Pages;

use App\Filament\Clusters\TeknikServis;
use Filament\Pages\Page;

class AksesuarEkleme extends Page
{
    protected static ?string $cluster = TeknikServis::class;
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Aksesuar Ekleme';
    protected static ?string $slug = 'ayarlar/aksesuar-ekleme';

    protected static string $view = 'filament.clusters.teknik-servis.pages.aksesuar-ekleme';
}
