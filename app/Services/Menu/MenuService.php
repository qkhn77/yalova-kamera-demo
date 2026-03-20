<?php

namespace App\Services\Menu;

use App\Models\MenuItem;
use Illuminate\Database\Eloquent\Collection;

class MenuService
{
    public function getMenuTree(string $location = 'primary'): Collection
    {
        return MenuItem::query()
            ->active()
            ->root()
            ->location($location)
            ->with([
                'children' => fn ($query) => $query
                    ->active()
                    ->location($location)
                    ->orderBy('sort_order')
                    ->orderBy('id'),
            ])
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();
    }
}

