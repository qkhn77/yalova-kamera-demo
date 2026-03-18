<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\ThumbnailService;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class Service extends Model
{
    protected $fillable = [
        'service_category_id',
        'title',
        'slug',
        'short_description',
        'content',
        'image',
        'icon',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected $appends = ['image_url'];

    /**
     * Görsel tam URL. storage/app/public/services veya services/ dosya adı.
     */
    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }
        $path = str_replace('\\', '/', (string) $this->image);
        $path = ltrim($path, '/');
        if ($path === '') {
            return null;
        }
        if (! str_starts_with($path, 'services/')) {
            $path = 'services/'.$path;
        }
        return asset('public_storage/'.$path);
    }

    /**
     * Tablo/liste için küçük görsel URL. Thumbnail varsa onu, yoksa ana görseli döner.
     */
    public function getImageThumbUrlAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }
        $path = str_replace('\\', '/', (string) $this->image);
        $thumbPath = app(ThumbnailService::class)->getThumbPath('services', $path);
        if ($thumbPath) {
            return asset('public_storage/'.$thumbPath);
        }
        return $this->image_url;
    }

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('sitemap_xml'));
        static::deleted(fn () => Cache::forget('sitemap_xml'));
        static::creating(function (Service $service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->title);
            }
        });
        static::updating(function (Service $service) {
            if ($service->isDirty('title') && ! $service->isDirty('slug')) {
                $service->slug = Str::slug($service->title);
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }
}
