<?php

namespace App\Filament\Clusters\Muhasebe\Pages;

use App\Filament\Clusters\Muhasebe;
use Filament\Pages\Page;

class KasaSatis extends Page
{
    protected static ?string $cluster = Muhasebe::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Kasa Satis';
    protected static ?string $slug = 'satis/kasa-satis';

    protected static string $view = 'filament.clusters.muhasebe.pages.kasa-satis';
}

