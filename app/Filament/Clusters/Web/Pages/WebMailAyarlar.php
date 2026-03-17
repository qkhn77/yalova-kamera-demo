<?php

namespace App\Filament\Clusters\Web\Pages;

use App\Filament\Clusters\Web;
use Filament\Pages\Page;

class WebMailAyarlar extends Page
{
    protected static ?string $cluster = Web::class;

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Mail Ayarlar';
    protected static ?string $slug = 'web-ayarlar/web-mail-ayarlar';

    protected static string $view = 'filament.clusters.web.pages.web-mail-ayarlar';
}
