<?php

namespace App\Filament\Clusters\Web\Pages;

use App\Filament\Clusters\Web;
use Filament\Pages\Page;

class BilgiSayfalari extends Page
{
    protected static ?string $cluster = Web::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Bilgi Sayfaları';

    protected static ?string $slug = 'sayfalar/bilgi-sayfalari';

    protected static string $view = 'filament.clusters.web.pages.bilgi-sayfalari';
}
