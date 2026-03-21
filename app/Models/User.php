<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'ad_soyad',
        'kullanici_adi',
        'email',
        'password',
        'super_admin_mi',
        'son_giris_tarihi',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'super_admin_mi' => 'boolean',
            'son_giris_tarihi' => 'datetime',
        ];
    }

    public function firmaKullanicilari(): HasMany
    {
        return $this->hasMany(FirmaKullanici::class, 'kullanici_id');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
}
