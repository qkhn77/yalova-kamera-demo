<?php

namespace App\Filament\Clusters\Muhasebe\Pages;

use App\Filament\Clusters\Muhasebe;
use Filament\Pages\Page;

class PosSatis extends Page
{
    protected static ?string $cluster = Muhasebe::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Pos Satis';
    protected static ?string $slug = 'satis/pos-satis';

    protected static string $view = 'filament.clusters.muhasebe.pages.pos-satis';
}

