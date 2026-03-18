<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Sistem ana dizinden çalışıyor; public dizini kullanılmıyor.
        $this->app->bind('path.public', fn () => base_path());
    }

    public function boot(): void
    {
        if (! app()->runningInConsole()) {

            // 🔥 EN KRİTİK SATIR (admin CSS/JS problemi burada çözülür)
            URL::forceScheme('https');

            // app.url her zaman https olsun
            $host = request()->getHost();
            config(['app.url' => 'https://' . $host]);

            // storage URL düzelt
            config([
                'filesystems.disks.public.url' => 'https://' . $host . '/storage'
            ]);

            try {
                $url = \App\Models\Setting::get('site_url');
                if (! empty($url) && is_string($url)) {
                    $url = rtrim($url, '/');
                    $host = parse_url($url, PHP_URL_HOST) ?: $host;
                    config(['app.url' => 'https://' . $host]);
                }
            } catch (\Throwable $e) {
                // ilk kurulumda hata vermesin
            }

            try {
                // Mail ayarları
                $mailActive = (bool) \App\Models\Setting::get('mail_active', true);

                if ($mailActive) {
                    $hostMail = \App\Models\Setting::get('mail_host');

                    if (! empty($hostMail)) {
                        config([
                            'mail.default' => 'smtp',
                            'mail.mailers.smtp' => array_merge(config('mail.mailers.smtp', []), [
                                'host' => $hostMail,
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

            } catch (\Throwable $e) {
                // ilk kurulumda hata vermesin
            }
        }
    }
}