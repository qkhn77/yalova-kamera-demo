<?php

namespace App\Http\Middleware;

use Filament\Http\Middleware\Authenticate as Middleware;

/**
 * Filament panelinde yerleşik login yok; kimlik doğrulanmamış istekler yönlendirilir.
 *
 * Çift giriş: varsayılan hedef firma girişi (`tenant.login`). Sistem yöneticileri
 * doğrudan `/yonetici-giris` üzerinden oturum açar; yine de panel koruması aynı guard ile çalışır.
 */
class FilamentAuthenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        return route('tenant.login');
    }
}
