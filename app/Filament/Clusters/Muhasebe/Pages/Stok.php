<?php

namespace App\Filament\Clusters\Muhasebe\Pages;

use App\Filament\Clusters\Muhasebe;
use Filament\Pages\Page;

class Stok extends Page
{
    protected static ?string $cluster = Muhasebe::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Stok';
    protected static ?string $slug = 'stok';

    protected static string $view = 'filament.clusters.muhasebe.pages.stok';
}

