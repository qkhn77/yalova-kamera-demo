<?php

namespace App\Support;

use Illuminate\Support\Facades\Schema;

/**
 * Migration eksik ortamlarda Filament SaaS ekranlarının 500 vermemesi için tablo varlığı kontrolleri.
 */
final class SaaSemaYardimcisi
{
    public static function tabloVarMi(string $tabloAdi): bool
    {
        try {
            return Schema::hasTable($tabloAdi);
        } catch (\Throwable) {
            return false;
        }
    }

    public static function firmalarTablosuVarMi(): bool
    {
        return self::tabloVarMi('firmalar');
    }

    public static function planlarTablosuVarMi(): bool
    {
        return self::tabloVarMi('planlar');
    }

    public static function firmaKullanicilariTablosuVarMi(): bool
    {
        return self::tabloVarMi('firma_kullanicilari');
    }

    public static function firmaModulleriTablosuVarMi(): bool
    {
        return self::tabloVarMi('firma_modulleri');
    }

    public static function firmaAbonelikleriTablosuVarMi(): bool
    {
        return self::tabloVarMi('firma_abonelikleri');
    }

    public static function planModulleriTablosuVarMi(): bool
    {
        return self::tabloVarMi('plan_modulleri');
    }

    public static function modullerTablosuVarMi(): bool
    {
        return self::tabloVarMi('moduller');
    }
}
