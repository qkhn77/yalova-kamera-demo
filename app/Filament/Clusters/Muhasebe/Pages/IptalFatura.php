<?php

namespace App\Filament\Clusters\Muhasebe\Pages;

use App\Filament\Clusters\Muhasebe;
use Filament\Pages\Page;

class IptalFatura extends Page
{
    protected static ?string $cluster = Muhasebe::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Iptal Fatura';
    protected static ?string $slug = 'fatura/iptal-fatura';

    protected static string $view = 'filament.clusters.muhasebe.pages.iptal-fatura';
}

