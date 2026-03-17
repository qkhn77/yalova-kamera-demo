<?php

namespace App\Filament\Clusters\Muhasebe\Pages;

use App\Filament\Clusters\Muhasebe;
use Filament\Pages\Page;

class Bankalar extends Page
{
    protected static ?string $cluster = Muhasebe::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Bankalar';
    protected static ?string $slug = 'finans/bankalar';

    protected static string $view = 'filament.clusters.muhasebe.pages.bankalar';
}

