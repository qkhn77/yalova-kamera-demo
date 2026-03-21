<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Firma extends Model
{
    use SoftDeletes;

    public const DURUM_BEKLEMEDE = 'beklemede';

    public const DURUM_AKTIF = 'aktif';

    public const DURUM_ASKIDA = 'askida';

    public const DURUM_SURESI_DOLDU = 'suresi_doldu';

    public const DURUM_IPTAL_EDILDI = 'iptal_edildi';

    /** @return array<string, string> */
    public static function durumSecenekleri(): array
    {
        return [
            self::DURUM_BEKLEMEDE => 'Beklemede',
            self::DURUM_AKTIF => 'Aktif',
            self::DURUM_ASKIDA => 'Askıda',
            self::DURUM_SURESI_DOLDU => 'Süresi doldu',
            self::DURUM_IPTAL_EDILDI => 'İptal edildi',
        ];
    }

    protected $table = 'firmalar';

    protected $fillable = [
        'ad',
        'kisa_ad',
        'firma_kodu',
        'vergi_no',
        'telefon',
        'eposta',
        'adres',
        'durum',
        'onaylandi_mi',
        'onaylayan_kullanici_id',
        'onay_tarihi',
    ];

    protected $casts = [
        'onaylandi_mi' => 'boolean',
        'onay_tarihi' => 'datetime',
    ];

    public function onaylayanKullanici(): BelongsTo
    {
        return $this->belongsTo(User::class, 'onaylayan_kullanici_id');
    }

    public function firmaKullanicilari(): HasMany
    {
        return $this->hasMany(FirmaKullanici::class, 'firma_id');
    }

    public function firmaModulleri(): HasMany
    {
        return $this->hasMany(FirmaModulu::class, 'firma_id');
    }

    public function firmaAbonelikleri(): HasMany
    {
        return $this->hasMany(FirmaAboneligi::class, 'firma_id');
    }

    public function denetimKayitlari(): HasMany
    {
        return $this->hasMany(DenetimKayidi::class, 'firma_id');
    }

    public function firmaAyarlari(): HasMany
    {
        return $this->hasMany(FirmaAyari::class, 'firma_id');
    }
}

