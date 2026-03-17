<?php

namespace App\Filament\Clusters\Muhasebe\Pages;

use App\Filament\Clusters\Muhasebe;
use Filament\Pages\Page;

class BankaSatis extends Page
{
    protected static ?string $cluster = Muhasebe::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Banka Satis';
    protected static ?string $slug = 'satis/banka-satis';

    protected static string $view = 'filament.clusters.muhasebe.pages.banka-satis';
}

