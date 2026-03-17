<?php

namespace App\Filament\Clusters\Muhasebe\Pages;

use App\Filament\Clusters\Muhasebe;
use Filament\Pages\Page;

class Kasalar extends Page
{
    protected static ?string $cluster = Muhasebe::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Kasalar';
    protected static ?string $slug = 'finans/kasalar';

    protected static string $view = 'filament.clusters.muhasebe.pages.kasalar';
}

