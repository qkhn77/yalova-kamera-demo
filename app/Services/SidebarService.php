<?php

namespace App\Services;

use App\Models\User;

class SidebarService
{
    /**
     * Özel sidebar ana bölümleri: `moduller.kod` ve `yetkiler.kod` ile eşleşmeli.
     * Sistem alanı (ör. kullanici) için modül aboneliği kontrol edilmez; yine de yetki gerekir.
     *
     * @return array<string, array{modul: string, yetki: string}>
     */
    public static function sidebarBolumHaritasi(): array
    {
        return [
            'muhasebe' => ['modul' => 'muhasebe', 'yetki' => 'muhasebe.goruntule'],
            'teknik_servis' => ['modul' => 'teknik_servis', 'yetki' => 'teknik_servis.goruntule'],
            'web' => ['modul' => 'web', 'yetki' => 'web.goruntule'],
            'ayarlar' => ['modul' => 'kullanici', 'yetki' => 'kullanici.goruntule'],
        ];
    }

    /**
     * Ana sidebar bölümü (Muhasebe, Teknik Servis, Web, Ayarlar) görünür mü?
     */
    public function sidebarBolumGorunurMu(?User $kullanici, ?int $firmaId, string $bolumAnahtari): bool
    {
        $satir = static::sidebarBolumHaritasi()[$bolumAnahtari] ?? null;
        if ($satir === null) {
            return false;
        }

        return $this->menuGorunurMu($kullanici, $firmaId, $satir['modul'], $satir['yetki']);
    }

    public function __construct(
        protected ModulErisimService $modulErisimService,
        protected YetkiService $yetkiService
    ) {
    }

    public function menuGorunurMu(
        ?User $kullanici,
        ?int $firmaId,
        ?string $modulKodu,
        ?string $yetkiKodu
    ): bool {
        if (! $kullanici) {
            return false;
        }

        if ($this->superAdminMi($kullanici)) {
            return true;
        }

        if (! $firmaId) {
            return false;
        }

        if (! $this->sistemAlaniMi($modulKodu)) {
            if (! $modulKodu || ! $this->modulErisimService->modulErisilebilirMi($firmaId, $modulKodu)) {
                return false;
            }
        }

        // Super admin dışındaki kullanıcılar için yetki kodu tanımsızsa güvenli şekilde gizle.
        if (! $yetkiKodu) {
            return false;
        }

        return $this->yetkiService->yetkiVarMi($kullanici, $firmaId, $yetkiKodu);
    }

    public function sistemAlaniMi(?string $modulKodu): bool
    {
        if ($modulKodu === null || $modulKodu === '') {
            return true;
        }

        return in_array($modulKodu, ['firma', 'kullanici', 'modul', 'panel', 'dashboard'], true);
    }

    protected function superAdminMi(User $kullanici): bool
    {
        return (bool) ($kullanici->super_admin_mi ?? false) || (bool) ($kullanici->is_admin ?? false);
    }
}

