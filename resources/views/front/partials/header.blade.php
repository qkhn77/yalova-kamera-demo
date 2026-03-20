@php
    $menuItems = app(\App\Services\Menu\MenuService::class)->getMenuTree('primary');
    $hasProductRoutes = \Illuminate\Support\Facades\Route::has('products.index') && \Illuminate\Support\Facades\Route::has('products.category');
    $productCategories = collect();
    if ($hasProductRoutes && \Illuminate\Support\Facades\Schema::hasTable('product_categories')) {
        try {
            $productCategories = \App\Models\ProductCategory::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('name')
                ->limit(12)
                ->get();
        } catch (\Throwable $e) {
            $productCategories = collect();
        }
    }
    $productsIndexUrl = $hasProductRoutes ? rtrim(route('products.index'), '/') : null;
    $hasProductsInDynamicMenu = $productsIndexUrl ? $menuItems->contains(function ($item) use ($productsIndexUrl) {
        $href = rtrim((string) $item->href, '/');
        return $href === $productsIndexUrl;
    }) : false;
    $hasProductsMenuConfigured = false;
    if ($hasProductRoutes && \Illuminate\Support\Facades\Schema::hasTable('menu_items')) {
        try {
            $hasProductsMenuConfigured = \App\Models\MenuItem::query()
                ->whereNull('parent_id')
                ->where(function ($query): void {
                    $query->where('route_name', 'products.index')
                        ->orWhere('url', '/urunler')
                        ->orWhere('url', 'urunler')
                        ->orWhere('title', 'Ürünler')
                        ->orWhere('label', 'Ürünler');
                })
                ->exists();
        } catch (\Throwable $e) {
            $hasProductsMenuConfigured = false;
        }
    }
    $menuBg = \App\Models\Setting::get('menu_bg_color', '');
    $menuText = \App\Models\Setting::get('menu_text_color', '');
    $menuHoverBg = \App\Models\Setting::get('menu_hover_bg', '');
    $menuHoverText = \App\Models\Setting::get('menu_hover_text', '');
    $menuActiveBg = \App\Models\Setting::get('menu_active_bg', '');
    $menuActiveText = \App\Models\Setting::get('menu_active_text', '');
    $currentUrl = rtrim(request()->url(), '/');
@endphp
@if ($menuBg || $menuText || $menuHoverText || $menuActiveText)
<style>
    .main-header .navbar { @if($menuBg) background-color: {{ $menuBg }} !important; @endif }
    .main-header .navbar .nav-link { @if($menuText) color: {{ $menuText }} !important; @endif }
    @if($menuHoverBg) .main-header .navbar .nav-link:hover { background-color: {{ $menuHoverBg }} !important; } @endif
    @if($menuHoverText) .main-header .navbar .nav-link:hover { color: {{ $menuHoverText }} !important; } @endif
    @if($menuActiveBg) .main-header .navbar .nav-item.active .nav-link { background-color: {{ $menuActiveBg }} !important; } @endif
    @if($menuActiveText) .main-header .navbar .nav-item.active .nav-link { color: {{ $menuActiveText }} !important; } @endif
    @if($menuHoverText) .main-header .navbar .dropdown-menu .dropdown-item:hover { color: {{ $menuHoverText }}; } @endif
</style>
@endif
<style>
    /* Ürünler alt kategori listesi çok uzarsa hem desktop hem mobilde kullanılabilir kalsın */
    .main-header .navbar .dropdown-menu {
        max-height: 60vh;
        overflow-y: auto;
    }
    @media (max-width: 991px) {
        .responsive-menu .dropdown-menu,
        .slicknav_nav .dropdown-menu {
            max-height: 45vh;
            overflow-y: auto;
        }
    }
</style>
<header class="main-header">
    <div class="header-sticky">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                
                @php
                    $headerLogo = \App\Models\Setting::get('site_logo');
                    $headerLogoUrl = $headerLogo
                        ? (str_starts_with($headerLogo, 'settings/') ? asset('uploads/' . ltrim($headerLogo, '/')) : asset($headerLogo))
                        : asset('theme/yalovakamera/images/yalova_kamera.png');
                @endphp
                <a class="navbar-brand site-logo" href="{{ route('home') }}">
                  <img src="{{ $headerLogoUrl }}" alt="{{ \App\Models\Setting::get('site_title', config('app.name')) }} Logo">
                </a>

                <div class="collapse navbar-collapse main-menu">
                    <div class="nav-menu-wrapper">
                        <ul class="navbar-nav mr-auto" id="menu">
                            @forelse($menuItems as $item)
                                @php
                                    $href = $item->href;
                                    $isActive = $currentUrl === rtrim($href, '/') || request()->fullUrlIs(rtrim($href, '/') . '*');
                                    $hasChildren = $item->children->isNotEmpty();
                                    $isProductsMenuItem = $productsIndexUrl && rtrim($href, '/') === $productsIndexUrl;
                                    $useProductsDropdown = $isProductsMenuItem && $productCategories->isNotEmpty();
                                @endphp
                                @if ($hasChildren || $useProductsDropdown)
                                    <li class="nav-item dropdown {{ $isActive ? 'active' : '' }} {{ $item->css_class }}">
                                        <a class="nav-link dropdown-toggle" href="{{ $href }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" target="{{ $item->target }}" @if($item->should_use_noopener) rel="noopener noreferrer" @endif>
                                            {{ $item->label }}
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ $href }}" target="{{ $item->target }}" @if($item->should_use_noopener) rel="noopener noreferrer" @endif>{{ $item->label }} (Tümü)</a></li>
                                            @if($hasChildren)
                                                @foreach($item->children as $child)
                                                    @php
                                                        $childHref = $child->href;
                                                        $childActive = $currentUrl === rtrim($childHref, '/');
                                                    @endphp
                                                    <li><a class="dropdown-item {{ $childActive ? 'active' : '' }} {{ $child->css_class }}" href="{{ $childHref }}" target="{{ $child->target }}" @if($child->should_use_noopener) rel="noopener noreferrer" @endif>{{ $child->label }}</a></li>
                                                @endforeach
                                            @elseif($useProductsDropdown)
                                                @foreach($productCategories as $cat)
                                                    <li><a class="dropdown-item" href="{{ route('products.category', $cat->slug) }}">{{ $cat->name }}</a></li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </li>
                                @else
                                    <li class="nav-item {{ $isActive ? 'active' : '' }} {{ $item->css_class }}">
                                        <a class="nav-link" href="{{ $href }}" target="{{ $item->target }}" @if($item->should_use_noopener) rel="noopener noreferrer" @endif>{{ $item->label }}</a>
                                    </li>
                                @endif
                            @empty
                                {{-- Menü boşsa varsayılan sabit menü --}}
                                <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('home') }}">Anasayfa</a>
                                </li>
                                <li class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('about') }}">Hakkımızda</a>
                                </li>
                                <li class="nav-item {{ request()->routeIs('services*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('services.index') }}">Servisler</a>
                                </li>
                                <li class="nav-item {{ request()->routeIs('projects*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('projects.index') }}">Projeler</a>
                                </li>
                                @if($hasProductRoutes)
                                    <li class="nav-item dropdown {{ request()->routeIs('products*') ? 'active' : '' }}">
                                        <a class="nav-link dropdown-toggle" href="{{ route('products.index') }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Ürünler
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('products.index') }}">Tüm Ürünler</a></li>
                                            @foreach($productCategories as $cat)
                                                <li><a class="dropdown-item" href="{{ route('products.category', $cat->slug) }}">{{ $cat->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                                <li class="nav-item {{ request()->routeIs('blog*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('blog.index') }}">Blog</a>
                                </li>
                                <li class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('contact') }}">İletişim</a>
                                </li>
                            @endforelse
                            @if($hasProductRoutes && $menuItems->isNotEmpty() && !$hasProductsInDynamicMenu && !$hasProductsMenuConfigured)
                                <li class="nav-item dropdown {{ request()->routeIs('products*') ? 'active' : '' }}">
                                    <a class="nav-link dropdown-toggle" href="{{ route('products.index') }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ürünler
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('products.index') }}">Tüm Ürünler</a></li>
                                        @foreach($productCategories as $cat)
                                            <li><a class="dropdown-item" href="{{ route('products.category', $cat->slug) }}">{{ $cat->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </div>

                    <div class="header-btn">
                        <a href="tel:+902263520724" class="btn-default">0 (226) 352 07 24</a>
                    </div>
                </div>

                <div class="navbar-toggle"></div>
            </div>
        </nav>

        <div class="responsive-menu"></div>
    </div>
</header>
