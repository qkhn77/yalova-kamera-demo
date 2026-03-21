<?php

namespace App\Models;

use App\Traits\HasFirma;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FirmaAyari extends Model
{
    use HasFirma;
    use SoftDeletes;

    protected $table = 'firma_ayarlari';

    protected $fillable = [
        'firma_id',
        'anahtar',
        'deger',
    ];

    protected $casts = [
        'deger' => 'array',
    ];

    public function firma(): BelongsTo
    {
        return $this->belongsTo(Firma::class, 'firma_id');
    }
}

