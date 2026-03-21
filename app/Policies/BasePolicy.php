<?php

namespace App\Policies;

use App\Models\User;
use App\Services\ModulErisimService;
use App\Services\TenantContextService;
use App\Services\YetkiService;

class BasePolicy
{
    public function __construct(
        protected TenantContextService $tenantContextService,
        protected YetkiService $yetkiService,
        protected ModulErisimService $modulErisimService
    ) {
    }

    protected function superAdminMi(User $kullanici): bool
    {
        return (bool) ($kullanici->super_admin_mi ?? false) || (bool) ($kullanici->is_admin ?? false);
    }

    protected function aktifFirmaId(): ?int
    {
        return $this->tenantContextService->aktifFirmaId();
    }

    protected function tenantGecerliMi(User $kullanici): bool
    {
        if ($this->superAdminMi($kullanici)) {
            return true;
        }

        $firmaId = $this->aktifFirmaId();
        return $firmaId !== null;
    }

    protected function modulYazmaIzinliMi(int $firmaId, string $modulKodu): bool
    {
        if (! $this->modulErisimService->modulErisilebilirMi($firmaId, $modulKodu)) {
            return false;
        }

        return ! $this->modulErisimService->modulSaltOkunurMu($firmaId, $modulKodu);
    }

    protected function yetkiKontrol(User $kullanici, ?string $yetkiKodu, ?string $modulKodu = null, bool $yazma = false): bool
    {
        if ($this->superAdminMi($kullanici)) {
            return true;
        }

        $firmaId = $this->aktifFirmaId();
        if (! $firmaId) {
            return false;
        }

        if ($modulKodu !== null) {
            if (! $this->sistemAlaniMi($modulKodu)) {
                if (! $this->modulErisimService->modulErisilebilirMi($firmaId, $modulKodu)) {
                    return false;
                }

                if ($yazma && ! $this->modulYazmaIzinliMi($firmaId, $modulKodu)) {
                    return false;
                }
            }
        }

        if ($yetkiKodu === null) {
            return true;
        }

        return $this->yetkiService->yetkiVarMi($kullanici, $firmaId, $yetkiKodu);
    }

    protected function sistemAlaniMi(string $modulKodu): bool
    {
        return in_array($modulKodu, ['firma', 'kullanici', 'modul'], true);
    }
}

