<?php

namespace App\Support;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

/**
 * Demo/prod ortamında users tablosunda deleted_at henüz yokken sorguların kırılmaması için.
 * Kolon migration ile eklendikten sonra aynı kod yolu soft delete ile uyumlu çalışır.
 *
 * Not: Önbellek yok; migration sonrası bir sonraki sorguda kolon varlığı yeniden okunur (queue worker’da eski önbellek riski oluşmaz).
 */
final class KullaniciTablosuYardimcisi
{
    public static function usersDeletedAtKolonuVarMi(): bool
    {
        try {
            return Schema::hasColumn((new User)->getTable(), 'deleted_at');
        } catch (\Throwable) {
            return false;
        }
    }

    /**
     * users.deleted_at kolonu varsa silinmemiş kayıt şartını ekler.
     */
    public static function kullaniciSilinmemisFiltresiUygula(Builder $sorgu, ?string $tablo = null): void
    {
        if (! self::usersDeletedAtKolonuVarMi()) {
            return;
        }

        $tablo = $tablo ?? (new User)->getTable();
        $sorgu->whereNull($tablo.'.deleted_at');
    }
}
