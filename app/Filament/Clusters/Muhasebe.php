<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class Muhasebe extends Cluster
{
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = 'heroicon-o-calculator';

    protected static ?int $navigationSort = 1;
    protected static ?string $navigationLabel = 'Muhasebe';

    protected static ?string $slug = 'muhasebe';
}
