<?php

namespace App\Http\Middleware;

use Filament\Http\Middleware\Authenticate as Middleware;

/**
 * Filament panelinde yerleşik login yok; kimlik doğrulanmamış istekler yönlendirilir.
 *
 * Çift giriş:
 * - Firma kullanıcıları: `/giris` (tenant.login). Panel sonrası TenantContextMiddleware aktif firma ister.
 * - Süper admin: `/yonetici-giris` (yonetici.login); giriş formunda firma girişine link vardır.
 * Misafir `/admin` isteği önce buraya düşer; Laravel AuthenticationException ile `url.intended` saklanır.
 */
class FilamentAuthenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        return route('tenant.login');
    }
}
