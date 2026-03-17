<?php

namespace App\Filament\Clusters\Muhasebe\Pages;

use App\Filament\Clusters\Muhasebe;
use Filament\Pages\Page;

class GidenFatura extends Page
{
    protected static ?string $cluster = Muhasebe::class;
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-up-on-square';
    protected static ?string $navigationLabel = 'Giden Fatura';
    protected static ?string $navigationParentItem = 'Fatura';
    protected static ?int $navigationSort = 1;

    protected static ?string $title = 'Giden Fatura';
    protected static ?string $slug = 'fatura/giden-fatura';

    protected static string $view = 'filament.clusters.muhasebe.pages.giden-fatura';
}

