<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuItem extends Model
{
    protected $fillable = [
        'parent_id',
        'type',
        'label',
        'url',
        'link_id',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('sort_order');
    }

    public function getHrefAttribute(): string
    {
        return match ($this->type) {
            'home' => route('home'),
            'contact' => route('contact'),
            'custom' => $this->resolveCustomUrl(),
            'page' => $this->resolvePageUrl(),
            'services' => route('services.index'),
            'service_category' => $this->resolveServiceCategoryUrl(),
            'projects' => route('projects.index'),
            'project_category' => $this->resolveProjectCategoryUrl(),
            'blog' => route('blog.index'),
            'post_category' => $this->resolvePostCategoryUrl(),
            default => '#',
        };
    }

    /** Custom URL'yi uygulama base URL ile birleştirir (alt dizinde çalışınca linkler bozulmasın). */
    protected function resolveCustomUrl(): string
    {
        $url = $this->url ?? '';
        if ($url === '' || $url === '#') {
            return '#';
        }
        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://')) {
            return $url;
        }
        return url($url);
    }

    protected function resolvePageUrl(): string
    {
        $page = Page::find($this->link_id);
        return $page ? url('/sayfa/' . $page->slug) : '#';
    }

    protected function resolveServiceCategoryUrl(): string
    {
        $cat = ServiceCategory::find($this->link_id);
        return $cat ? route('services.index.category', ['categorySlug' => $cat->slug]) : route('services.index');
    }

    protected function resolveProjectCategoryUrl(): string
    {
        $cat = ProjectCategory::find($this->link_id);
        return $cat ? route('projects.index.category', ['categorySlug' => $cat->slug]) : route('projects.index');
    }

    protected function resolvePostCategoryUrl(): string
    {
        $cat = PostCategory::find($this->link_id);
        return $cat ? route('blog.index.category', ['categorySlug' => $cat->slug]) : route('blog.index');
    }

    public static function getTree(): \Illuminate\Database\Eloquent\Collection
    {
        return static::whereNull('parent_id')
            ->where('is_active', true)
            ->with(['children' => fn ($q) => $q->where('is_active', true)])
            ->orderBy('sort_order')
            ->get();
    }

    /** Admin formu için tüm öğeleri (aktif/pasif) parent-children ağacı olarak döndürür. */
    public static function getTreeForAdmin(): array
    {
        $roots = static::whereNull('parent_id')->orderBy('sort_order')->with('children')->get();
        return $roots->map(fn (MenuItem $item) => static::itemToArray($item))->all();
    }

    protected static function itemToArray(MenuItem $item): array
    {
        $arr = [
            'type' => $item->type,
            'label' => $item->label,
            'url' => $item->url,
            'link_id' => $item->link_id,
            'is_active' => $item->is_active,
            'children' => $item->children->map(fn (MenuItem $c) => static::itemToArray($c))->values()->all(),
        ];
        return $arr;
    }

    /** Repeater state'inden menu_items tablosunu doldurur. */
    public static function syncFromArray(array $items): void
    {
        static::query()->delete();
        $sort = 0;
        foreach ($items as $item) {
            static::createFromArray($item, null, $sort++);
        }
    }

    protected static function createFromArray(array $item, ?int $parentId, int $sortOrder): void
    {
        $linkId = isset($item['link_id']) && $item['link_id'] !== '' ? (int) $item['link_id'] : null;
        $model = static::create([
            'parent_id' => $parentId,
            'type' => $item['type'] ?? 'custom',
            'label' => $item['label'] ?? '',
            'url' => $item['url'] ?? null,
            'link_id' => $linkId,
            'sort_order' => $sortOrder,
            'is_active' => (bool) ($item['is_active'] ?? true),
        ]);
        $childSort = 0;
        foreach ($item['children'] ?? [] as $child) {
            static::createFromArray($child, $model->id, $childSort++);
        }
    }
}
