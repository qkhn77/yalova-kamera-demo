<?php

namespace App\Services;

use App\Models\FirmaAboneligi;
use App\Models\FirmaModulu;
use App\Models\Modul;
use Carbon\Carbon;

class ModulErisimService
{
    public function modulDurumu(int $firmaId, string $modulKodu): string
    {
        $modul = Modul::query()
            ->where('kod', $modulKodu)
            ->where('aktif_mi', true)
            ->first();

        if (! $modul) {
            return 'kapali';
        }

        $planModuluMu = $this->abonelikPlanindaModulVarMi($firmaId, (int) $modul->id);

        $firmaModulu = FirmaModulu::query()
            ->withoutGlobalScopes()
            ->where('firma_id', $firmaId)
            ->where('modul_id', $modul->id)
            ->first();

        // Final kural:
        // efektif modüller = plan modülleri + manuel eklenenler - kapatılanlar
        if ($firmaModulu) {
            $durum = (string) $firmaModulu->durum;
            if ($durum === 'kapali') {
                return 'kapali';
            }

            if ($durum === 'salt_okunur') {
                return 'salt_okunur';
            }

            if ($durum === 'aktif') {
                return 'aktif';
            }
        }

        // Firma kaydı yoksa, plan modülündeyse erişim ver (faz-1 pratik kural)
        return $planModuluMu ? 'aktif' : 'kapali';
    }

    public function modulErisilebilirMi(int $firmaId, string $modulKodu): bool
    {
        return $this->modulDurumu($firmaId, $modulKodu) !== 'kapali';
    }

    public function modulSaltOkunurMu(int $firmaId, string $modulKodu): bool
    {
        return $this->modulDurumu($firmaId, $modulKodu) === 'salt_okunur';
    }

    protected function abonelikPlanindaModulVarMi(int $firmaId, int $modulId): bool
    {
        $bugun = Carbon::today()->toDateString();

        $aktifAbonelikler = FirmaAboneligi::query()
            ->withoutGlobalScopes()
            ->where('firma_id', $firmaId)
            ->where('durum', 'aktif')
            ->whereDate('baslangic_tarihi', '<=', $bugun)
            ->where(function ($q) use ($bugun): void {
                $q->whereNull('bitis_tarihi')
                    ->orWhereDate('bitis_tarihi', '>=', $bugun);
            })
            ->get(['plan_id']);

        // Faz-1 uyumluluğu: aktif abonelik kaydı henüz yoksa plan kısıtı uygulanmaz.
        if ($aktifAbonelikler->isEmpty()) {
            return true;
        }

        $planIdler = $aktifAbonelikler->pluck('plan_id')->filter()->values();
        if ($planIdler->isEmpty()) {
            return false;
        }

        return \App\Models\PlanModulu::query()
            ->whereIn('plan_id', $planIdler->all())
            ->where('modul_id', $modulId)
            ->exists();
    }
}

