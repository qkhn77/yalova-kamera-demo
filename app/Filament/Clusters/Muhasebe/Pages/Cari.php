<?php

namespace App\Filament\Clusters\Muhasebe\Pages;

use App\Filament\Clusters\Muhasebe;
use Filament\Pages\Page;

class Cari extends Page
{
    protected static ?string $cluster = Muhasebe::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Cari';
    protected static ?string $slug = 'cari';

    protected static string $view = 'filament.clusters.muhasebe.pages.cari';
}

