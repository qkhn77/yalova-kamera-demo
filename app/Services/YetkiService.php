<?php

namespace App\Services;

use App\Models\FirmaKullanici;
use App\Models\KullaniciYetki;
use App\Models\User;
use App\Models\Yetki;

class YetkiService
{
    public function __construct(
        protected ModulErisimService $modulErisimService
    ) {
    }

    public function etkinYetkiler(User $kullanici, int $firmaId): array
    {
        if ($this->superAdminMi($kullanici)) {
            return Yetki::query()->pluck('kod')->filter()->values()->all();
        }

        $firmaKullanici = FirmaKullanici::query()
            ->withoutGlobalScopes()
            ->where('firma_id', $firmaId)
            ->where('kullanici_id', $kullanici->id)
            ->where('durum', 'aktif')
            ->whereNull('deleted_at')
            ->first();

        if (! $firmaKullanici) {
            return [];
        }

        $rolYetkiKodlari = Yetki::query()
            ->whereHas('roller', function ($q) use ($firmaKullanici): void {
                $q->where('roller.id', $firmaKullanici->rol_id);
            })
            ->pluck('kod')
            ->filter()
            ->values()
            ->all();

        $kodSet = array_fill_keys($rolYetkiKodlari, true);

        $kullaniciYetkiKayitlari = KullaniciYetki::query()
            ->withoutGlobalScopes()
            ->with('yetki:id,kod')
            ->where('firma_id', $firmaId)
            ->where('kullanici_id', $kullanici->id)
            ->get();

        foreach ($kullaniciYetkiKayitlari as $kayit) {
            $kod = $kayit->yetki?->kod;
            if (! $kod) {
                continue;
            }

            if ($kayit->izin_tipi === 'ver') {
                $kodSet[$kod] = true;
                continue;
            }

            if ($kayit->izin_tipi === 'reddet') {
                unset($kodSet[$kod]);
            }
        }

        return array_values(array_keys($kodSet));
    }

    public function yetkiVarMi(User $kullanici, int $firmaId, string $yetkiKodu): bool
    {
        if ($this->superAdminMi($kullanici)) {
            return true;
        }

        $etkinYetkiler = $this->etkinYetkiler($kullanici, $firmaId);
        if (! in_array($yetkiKodu, $etkinYetkiler, true)) {
            return false;
        }

        $yetki = Yetki::query()->where('kod', $yetkiKodu)->first();
        if (! $yetki || ! $yetki->modul_kodu) {
            return true;
        }

        if ($this->sistemAlaniMi((string) $yetki->modul_kodu)) {
            return true;
        }

        return $this->modulErisimService->modulErisilebilirMi($firmaId, (string) $yetki->modul_kodu);
    }

    public function yetkiAtayabilirMi(User $verenKullanici, int $firmaId, string $yetkiKodu): bool
    {
        if ($this->superAdminMi($verenKullanici)) {
            return true;
        }

        $yetki = Yetki::query()->where('kod', $yetkiKodu)->first();
        if (! $yetki) {
            return false;
        }

        if (! $this->yetkiVarMi($verenKullanici, $firmaId, $yetkiKodu)) {
            return false;
        }

        if (! $yetki->modul_kodu) {
            return true;
        }

        if ($this->sistemAlaniMi((string) $yetki->modul_kodu)) {
            return true;
        }

        return $this->modulErisimService->modulErisilebilirMi($firmaId, (string) $yetki->modul_kodu);
    }

    /**
     * Özel yetki (ver/reddet) ekranında listelenebilecek yetkiler.
     *
     * @return \Illuminate\Support\Collection<int, Yetki>
     */
    public function atanabilirYetkiKayitlari(User $verenKullanici, int $firmaId): \Illuminate\Support\Collection
    {
        return Yetki::query()
            ->orderBy('modul_kodu')
            ->orderBy('kod')
            ->get()
            ->filter(fn (Yetki $yetki): bool => $this->yetkiAtayabilirMi($verenKullanici, $firmaId, (string) $yetki->kod));
    }

    protected function superAdminMi(User $kullanici): bool
    {
        return (bool) ($kullanici->super_admin_mi ?? false) || (bool) ($kullanici->is_admin ?? false);
    }

    protected function sistemAlaniMi(string $modulKodu): bool
    {
        return in_array($modulKodu, ['firma', 'kullanici', 'modul'], true);
    }
}

