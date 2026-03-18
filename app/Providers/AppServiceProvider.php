<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        // Site URL from Genel Ayarlar (admin) — sitemap, canonical, vb. için
        try {
            if (!app()->runningInConsole()) {
                $url = \App\Models\Setting::get('site_url');
                if (!empty($url) && is_string($url)) {
                    config(['app.url' => rtrim($url, '/')]);
                }

                // Mail ayarları (Site Ayarları → Mail Ayarları) — SMTP ve alıcı adres
                $mailActive = (bool) \App\Models\Setting::get('mail_active', true);
                if ($mailActive) {
                    $host = \App\Models\Setting::get('mail_host');
                    if (!empty($host)) {
                        config([
                            'mail.default' => 'smtp',
                            'mail.mailers.smtp' => array_merge(config('mail.mailers.smtp', []), [
                                'host' => $host,
                                'port' => (int) \App\Models\Setting::get('mail_port', 587),
                                'encryption' => \App\Models\Setting::get('mail_encryption') ?: 'tls',
                                'username' => \App\Models\Setting::get('mail_username'),
                                'password' => \App\Models\Setting::get('mail_password'),
                            ]),
                            'mail.from' => [
                                'address' => \App\Models\Setting::get('mail_username') ?: config('mail.from.address'),
                                'name' => config('mail.from.name'),
                            ],
                        ]);
                    }
                } else {
                    config(['mail.default' => 'log']);
                }
            }
        } catch (\Throwable $e) {
            // migrations / first install
        }
    }
}
