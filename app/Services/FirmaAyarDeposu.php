<?php

namespace App\Services;

use App\Models\FirmaAyari;

/**
 * firma_ayarlari anahtar/değer (deger JSON) okuma-yazma.
 */
class FirmaAyarDeposu
{
    public function oku(int $firmaId, string $anahtar, mixed $varsayilan = null): mixed
    {
        $kayit = FirmaAyari::query()
            ->withoutGlobalScopes()
            ->where('firma_id', $firmaId)
            ->where('anahtar', $anahtar)
            ->first();

        if (! $kayit || ! is_array($kayit->deger)) {
            return $varsayilan;
        }

        return $kayit->deger['deger'] ?? $varsayilan;
    }

    public function yaz(int $firmaId, string $anahtar, mixed $deger): void
    {
        FirmaAyari::query()->updateOrCreate(
            [
                'firma_id' => $firmaId,
                'anahtar' => $anahtar,
            ],
            [
                'deger' => ['deger' => $deger],
            ]
        );
    }
}
