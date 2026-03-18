<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Sistem ana dizinden çalışıyor; public dizini kullanılmıyor. CSS, JS, Filament asset'leri root'ta.
        $this->app->bind('path.public', fn () => base_path());
    }

    public function boot(): void
    {
        // Proje hem HTTP hem HTTPS ile açılabilir; şema zorlanmaz, mevcut isteğe göre ayarlanır.
        // Proxy arkasında X-Forwarded-Proto da kontrol edilir (shared host SSL).
        if (! app()->runningInConsole() && request()) {
            $scheme = 'http';
            if (request()->secure()) {
                $scheme = 'https';
            } elseif (strtolower((string) request()->header('X-Forwarded-Proto')) === 'https') {
                $scheme = 'https';
            } elseif (strtolower((string) request()->header('X-Forwarded-Scheme')) === 'https') {
                $scheme = 'https';
            }
            URL::forceScheme($scheme);

            $host = request()->getHost();
            $path = parse_url(config('app.url'), PHP_URL_PATH);
            config(['app.url' => $scheme . '://' . $host . ($path ? rtrim($path, '/') : '')]);

            try {
                $url = \App\Models\Setting::get('site_url');
                if (! empty($url) && is_string($url)) {
                    $url = rtrim($url, '/');
                    $host = parse_url($url, PHP_URL_HOST) ?: $host;
                    $path = parse_url($url, PHP_URL_PATH);
                    config(['app.url' => $scheme . '://' . $host . ($path ? rtrim($path, '/') : '')]);
                }
            } catch (\Throwable $e) {
                // migrations / first install; app.url zaten yukarıda şema ile set edildi
            }
            config(['filesystems.disks.public.url' => rtrim(config('app.url'), '/') . '/storage']);
        }

        try {
            if (!app()->runningInConsole()) {

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
