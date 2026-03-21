<?php

namespace App\Support;

use App\Models\FirmaKullanici;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class FirmaIciRolKisitlayici
{
    /**
     * Atanabilir sistem rolleri. Firma sahibi dışındakiler «Firma Sahibi» rolünü atayamaz.
     */
    public static function atanabilirRollerSorgusu(User $veren, int $firmaId): Builder
    {
        $sorgu = Rol::query()->where('sistem_rolu_mu', true)->orderBy('ad');

        if ((bool) ($veren->super_admin_mi ?? false) || (bool) ($veren->is_admin ?? false)) {
            return $sorgu;
        }

        $baglanti = FirmaKullanici::query()
            ->withoutGlobalScopes()
            ->where('firma_id', $firmaId)
            ->where('kullanici_id', $veren->id)
            ->where('durum', 'aktif')
            ->whereNull('deleted_at')
            ->with('rol')
            ->first();

        $rolKodu = $baglanti?->rol?->kod;

        if ($rolKodu !== 'firma_sahibi') {
            $sorgu->where('kod', '!=', 'firma_sahibi');
        }

        return $sorgu;
    }
}
