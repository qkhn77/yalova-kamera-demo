<?php

namespace App\Http\Middleware;

use App\Services\TenantContextService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class FilamentTenantContextMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $kullanici = Auth::user();
        if (! $kullanici) {
            return $next($request);
        }

        $superAdminMi = (bool) ($kullanici->super_admin_mi ?? false) || (bool) ($kullanici->is_admin ?? false);
        if ($superAdminMi) {
            return $next($request);
        }

        $tenantContext = app(TenantContextService::class);
        if ($tenantContext->hasAktifFirma()) {
            return $next($request);
        }

        $tenantContext->temizle();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('tenant.login')
            ->withErrors(['firma' => 'Panel erişimi için aktif firma seçimi gereklidir.']);
    }
}

