<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Services\ThumbnailService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
        'post_category_id',
        'title',
        'slug',
        'excerpt',
        'meta_keywords',
        'content',
        'image',
        'og_title',
        'og_description',
        'og_image',
        'meta_robots',
        'published_at',
        'is_published',
        'sort_order',
    ];

    protected $attributes = [
        'meta_robots' => 'index,follow',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected $appends = ['image_url', 'image_thumb_url', 'og_image_url'];

    /**
     * Görsel tam URL. Filament "posts/dosya.jpg" veya "dosya.jpg" kaydeder.
     * public/storage -> storage/app/public link gerekli (php artisan storage:link).
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
        if (! str_starts_with($path, 'posts/')) {
            $path = 'posts/'.$path;
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
        $thumbPath = app(ThumbnailService::class)->getThumbPath('posts', $path);
        if ($thumbPath) {
            return asset('public_storage/'.$thumbPath);
        }
        return $this->image_url;
    }

    /**
     * OG görsel tam URL (sosyal medya paylaşım).
     */
    public function getOgImageUrlAttribute(): ?string
    {
        if (! $this->og_image) {
            return $this->image_url;
        }
        $path = str_replace('\\', '/', (string) $this->og_image);
        $path = ltrim($path, '/');
        if (! str_starts_with($path, 'posts/')) {
            $path = 'posts/'.$path;
        }
        return asset('public_storage/'.$path);
    }

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('sitemap_xml'));
        static::deleted(fn () => Cache::forget('sitemap_xml'));
        static::creating(function (Post $post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
        static::updating(function (Post $post) {
            if ($post->isDirty('title') && ! $post->isDirty('slug')) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }
}
