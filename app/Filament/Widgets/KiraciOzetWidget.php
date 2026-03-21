<?php

namespace App\Filament\Widgets;

use App\Models\Firma;
use App\Models\FirmaAboneligi;
use App\Models\FirmaKullanici;
use App\Models\Modul;
use App\Services\ModulErisimService;
use App\Services\TenantContextService;
use Carbon\Carbon;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class KiraciOzetWidget extends Widget
{
    protected static string $view = 'filament.widgets.kiraci-ozet-widget';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = -10;

    /**
     * Panel keşfi kapalı; yalnızca kiracı dashboard’ına eklenir.
     */
    protected static bool $isDiscovered = false;

    public static function canView(): bool
    {
        $kullanici = Auth::user();
        if (! $kullanici) {
            return false;
        }

        if ((bool) ($kullanici->super_admin_mi ?? false) || (bool) ($kullanici->is_admin ?? false)) {
            return false;
        }

        return app(TenantContextService::class)->aktifFirmaId() !== null;
    }

    /**
     * @return array<string, mixed>
     */
    protected function getViewData(): array
    {
        $fid = (int) (app(TenantContextService::class)->aktifFirmaId() ?? 0);
        if ($fid <= 0) {
            return ['satirlar' => []];
        }

        $firma = Firma::query()->find($fid);
        $servis = app(ModulErisimService::class);

        $aktifModuller = [];
        $saltOkunurModuller = [];
        $kapaliModuller = [];

        foreach (Modul::query()->where('aktif_mi', true)->orderBy('siralama')->get() as $modul) {
            $kod = (string) $modul->kod;
            $durum = $servis->modulDurumu($fid, $kod);
            if ($durum === 'aktif') {
                $aktifModuller[] = $modul->ad;
            } elseif ($durum === 'salt_okunur') {
                $saltOkunurModuller[] = $modul->ad;
            } else {
                $kapaliModuller[] = $modul->ad;
            }
        }

        $kullaniciSayisi = FirmaKullanici::query()
            ->withoutGlobalScopes()
            ->where('firma_id', $fid)
            ->whereNull('deleted_at')
            ->count();

        $bugun = Carbon::today()->toDateString();
        $abonelik = FirmaAboneligi::query()
            ->withoutGlobalScopes()
            ->where('firma_id', $fid)
            ->where('durum', 'aktif')
            ->whereDate('baslangic_tarihi', '<=', $bugun)
            ->where(function ($sorgu) use ($bugun): void {
                $sorgu->whereNull('bitis_tarihi')
                    ->orWhereDate('bitis_tarihi', '>=', $bugun);
            })
            ->with('plan')
            ->first();

        return [
            'firma' => $firma,
            'aktifModuller' => $aktifModuller,
            'saltOkunurModuller' => $saltOkunurModuller,
            'kapaliModuller' => $kapaliModuller,
            'kullaniciSayisi' => $kullaniciSayisi,
            'abonelik' => $abonelik,
        ];
    }
}
