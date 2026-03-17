<?php

namespace App\Filament\Clusters\Web\Pages;

use App\Filament\Clusters\Web;
use Filament\Pages\Page;

class Iletisim extends Page
{
    protected static ?string $cluster = Web::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'İletişim';

    protected static ?string $slug = 'sayfalar/iletisim';

    protected static string $view = 'filament.clusters.web.pages.iletisim';
}
