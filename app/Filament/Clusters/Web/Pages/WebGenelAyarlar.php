<?php

namespace App\Filament\Clusters\Web\Pages;

use App\Filament\Clusters\Web;
use Filament\Pages\Page;

class WebGenelAyarlar extends Page
{
    protected static ?string $cluster = Web::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Genel Ayarlar';
    protected static ?string $slug = 'web-ayarlar/web-genel-ayarlar';

    protected static string $view = 'filament.clusters.web.pages.web-genel-ayarlar';
}
