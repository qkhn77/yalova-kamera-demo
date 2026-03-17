<?php

namespace App\Filament\Clusters\Muhasebe\Pages;

use App\Filament\Clusters\Muhasebe;
use Filament\Pages\Page;

class GelenFatura extends Page
{
    protected static ?string $cluster = Muhasebe::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Gelen Fatura';
    protected static ?string $slug = 'fatura/gelen-fatura';

    protected static string $view = 'filament.clusters.muhasebe.pages.gelen-fatura';
}

