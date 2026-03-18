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
        // HTTP/HTTPS: Üretilen tüm linkler mevcut isteğin şemasına uysun (hem http hem https düzgün çalışsın).
        if (!app()->runningInConsole() && request()) {
            URL::forceScheme(request()->secure() ? 'https' : 'http');
        }

        // Site URL + şema: İstek HTTPS ise tüm asset/url https, HTTP ise http (Mixed Content önlenir).
        try {
            if (!app()->runningInConsole() && request()) {
                $scheme = request()->secure() ? 'https' : 'http';
                $url = \App\Models\Setting::get('site_url');
                if (!empty($url) && is_string($url)) {
                    $url = rtrim($url, '/');
                    $host = parse_url($url, PHP_URL_HOST) ?: request()->getHost();
                    $path = parse_url($url, PHP_URL_PATH);
                    config(['app.url' => $scheme . '://' . $host . ($path ? rtrim($path, '/') : '')]);
                } else {
                    $current = config('app.url');
                    $host = parse_url($current, PHP_URL_HOST) ?: request()->getHost();
                    $path = parse_url($current, PHP_URL_PATH);
                    config(['app.url' => $scheme . '://' . $host . ($path ? rtrim($path, '/') : '')]);
                }
                // Storage::url() (public disk) da aynı şemayı kullansın.
                config(['filesystems.disks.public.url' => rtrim(config('app.url'), '/') . '/public_storage']);
            }
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
