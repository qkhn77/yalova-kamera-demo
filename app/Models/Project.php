<?php

namespace App\Models;

use App\Services\ThumbnailService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'project_category_id',
        'title',
        'slug',
        'short_description',
        'description',
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

    protected $appends = ['image_url', 'image_thumb_url'];

    /**
     * Görsel tam URL. storage/app/public/projects
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
        if (! str_starts_with($path, 'projects/')) {
            $path = 'projects/'.$path;
        }
        return asset('public_storage/'.$path);
    }

    /**
     * Tablo için küçük görsel URL.
     */
    public function getImageThumbUrlAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }
        $path = str_replace('\\', '/', (string) $this->image);
        $thumbPath = app(ThumbnailService::class)->getThumbPath('projects', $path);
        if ($thumbPath) {
            return asset('public_storage/'.$thumbPath);
        }
        return $this->image_url;
    }

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('sitemap_xml'));
        static::deleted(fn () => Cache::forget('sitemap_xml'));
        static::creating(function (Project $project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });
        static::updating(function (Project $project) {
            if ($project->isDirty('title') && ! $project->isDirty('slug')) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProjectCategory::class, 'project_category_id');
    }
}
