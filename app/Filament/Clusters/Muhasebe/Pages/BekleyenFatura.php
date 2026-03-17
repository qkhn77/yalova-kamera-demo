<?php

namespace App\Filament\Clusters\Muhasebe\Pages;

use App\Filament\Clusters\Muhasebe;
use Filament\Pages\Page;

class BekleyenFatura extends Page
{
    protected static ?string $cluster = Muhasebe::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Bekleyen Fatura';
    protected static ?string $slug = 'fatura/bekleyen-fatura';

    protected static string $view = 'filament.clusters.muhasebe.pages.bekleyen-fatura';
}

