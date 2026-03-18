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

    protected $appends = ['image_url', 'icon_url'];

    /**
     * Görsel tam URL. storage varsa /storage, tema varsayılan adı (service-image-X.jpg) ise theme.
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
        // Tema varsayılan dosya adları: storage'da yoksa theme'den ver (404 önlenir)
        $basename = basename($path);
        if (preg_match('/^service-image-\d+\.(jpg|jpeg|png|gif|webp)$/i', $basename)) {
            return asset('theme/yalovakamera/images/'.$basename);
        }
        if (! str_starts_with($path, 'services/')) {
            $path = 'services/'.$path;
        }
        return asset('storage/'.$path);
    }

    /**
     * İkon URL. Storage path (services/...) ise storage, sadece dosya adı ise theme.
     */
    public function getIconUrlAttribute(): ?string
    {
        if (! $this->icon) {
            return null;
        }
        $path = str_replace('\\', '/', (string) $this->icon);
        $path = ltrim($path, '/');
        if (str_contains($path, '/') || str_starts_with($path, 'services/')) {
            if (! str_starts_with($path, 'services/')) {
                $path = 'services/'.$path;
            }
            return asset('storage/'.$path);
        }
        return asset('theme/yalovakamera/images/'.$path);
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
            return asset('storage/'.$thumbPath);
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
