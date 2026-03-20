<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SitemapController;
use App\Models\BilgiSayfa;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Page;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $services = Service::with('category')
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    $projects = Project::with('category')
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    return view('front.pages.home', compact('services', 'projects'));
})->name('home');

Route::view('/hakkimizda', 'front.pages.about')->name('about');

// SERV力SLER
Route::get('/Servisler', function () {
    $services = Service::with('category')
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    $categories = ServiceCategory::where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    $category = null;

    return view('front.services.index', compact('services', 'categories', 'category'));
})->name('services.index');

Route::get('/Servisler/kategori/{categorySlug}', function ($categorySlug) {
    $category = ServiceCategory::where('slug', $categorySlug)
        ->where('is_active', true)
        ->firstOrFail();

    $services = $category->services()
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    $categories = ServiceCategory::where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    return view('front.services.index', compact('services', 'categories', 'category'));
})->name('services.index.category');

Route::get('/Servisler/{slug}', function ($slug) {
    $service = Service::with('category')
        ->where('slug', $slug)
        ->where('is_active', true)
        ->firstOrFail();

    return view('front.services.show', compact('service'));
})->name('services.show');

// PROJELER
Route::get('/WebProje', function () {
    $projects = Project::with('category')
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    $categories = ProjectCategory::where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    $category = null;

    return view('front.projects.index', compact('projects', 'categories', 'category'));
})->name('projects.index');

Route::get('/WebProje/kategori/{categorySlug}', function ($categorySlug) {
    $category = ProjectCategory::where('slug', $categorySlug)
        ->where('is_active', true)
        ->firstOrFail();

    $projects = $category->projects()
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    $categories = ProjectCategory::where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    return view('front.projects.index', compact('projects', 'categories', 'category'));
})->name('projects.index.category');

Route::get('/WebProje/{slug}', function ($slug) {
    $project = Project::with('category')
        ->where('slug', $slug)
        ->where('is_active', true)
        ->firstOrFail();

    return view('front.projects.show', compact('project'));
})->name('projects.show');

// ÜRÜNLER
Route::get('/urunler', [ProductController::class, 'index'])->name('products.index');
Route::get('/urun-kategori/{slug}', [ProductController::class, 'category'])->name('products.category');
Route::get('/urun/{slug}', [ProductController::class, 'show'])->name('products.show');

// BLOG
Route::get('/blog', function () {
    $posts = Post::with('category')
        ->where('is_published', true)
        ->orderByDesc('published_at')
        ->get();

    $categories = PostCategory::where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    $category = null;

    return view('front.blog.index', compact('posts', 'categories', 'category'));
})->name('blog.index');

Route::get('/blog/kategori/{categorySlug}', function ($categorySlug) {
    $category = PostCategory::where('slug', $categorySlug)
        ->where('is_active', true)
        ->firstOrFail();

    $posts = $category->posts()
        ->where('is_published', true)
        ->orderByDesc('published_at')
        ->get();

    $categories = PostCategory::where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    return view('front.blog.index', compact('posts', 'categories', 'category'));
})->name('blog.index.category');

Route::get('/blog/{slug}', function ($slug) {
    $post = Post::with('category')
        ->where('slug', $slug)
        ->where('is_published', true)
        ->firstOrFail();

    return view('front.blog.show', compact('post'));
})->name('blog.show');

Route::get('/iletisim', fn () => view('front.pages.contact'))->name('contact');
Route::post('/iletisim', [ContactController::class, 'store'])->name('contact.store');

// Dinamik sayfalar
Route::get('/sayfa/{slug}', function ($slug) {
    $page = Page::where('slug', $slug)
        ->where('is_active', true)
        ->firstOrFail();

    return view('front.pages.dynamic', compact('page'));
})->name('page.show');

// Bilgi sayfaları (Filament Bilgi Sayfalarından eklenenler)
Route::get('/bilgi', function () {
    $bilgiSayfalari = BilgiSayfa::query()
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->orderByDesc('published_at')
        ->get();

    return view('front.information.information-index', compact('bilgiSayfalari'));
})->name('information.index');

Route::get('/bilgi/{slug}', function ($slug) {
    $bilgiSayfa = BilgiSayfa::where('slug', $slug)
        ->where('is_active', true)
        ->firstOrFail();

    return view('front.information.information-show', compact('bilgiSayfa'));
})->name('information.show');

// Google SEO: Dinamik sitemap ve robots.txt (Filament’ten eklenen içerik otomatik dahil)
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', [SitemapController::class, 'robots'])->name('robots');

// /storage/* dosyalarını sun (symlink yoksa veya document root public değilse)
// Not: Eğer sunucuda public/storage symlink'i varsa, web server dosyayı zaten direkt servis eder.
Route::get('/storage/{path}', function (string $path) {
    $path = str_replace(['..', '\\'], ['', '/'], $path);
    $path = ltrim($path, '/');

    $disk = Storage::disk('public');
    if (! $disk->exists($path)) {
        // Linux case-sensitive: DB'deki isim farklı case ile kaydedilmiş olabilir.
        $dir = trim(dirname($path), './\\');
        $dir = $dir === '' ? null : $dir;
        $base = basename($path);
        $files = $disk->files($dir);
        $matched = collect($files)->first(
            fn (string $f) => strcasecmp(basename($f), $base) === 0
        );
        if (! $matched) {
            abort(404);
        }
        $path = $matched;
    }

    $fullPath = $disk->path($path);
    if (! is_file($fullPath) || ! is_readable($fullPath)) {
        abort(404);
    }

    return response()->file($fullPath, [
        'Content-Type' => File::mimeType($fullPath) ?: 'application/octet-stream',
        'Cache-Control' => 'public, max-age=31536000, immutable',
    ]);
})->where('path', '.*')->name('storage.serve');

// /uploads/* dosyalarını sun (public disk URL'i)
Route::get('/uploads/{path}', function (string $path) {
    $path = str_replace(['..', '\\'], ['', '/'], $path);
    $path = ltrim($path, '/');

    $disk = Storage::disk('public');
    if (! $disk->exists($path)) {
        // Linux case-sensitive: DB'deki isim farklı case ile kaydedilmiş olabilir.
        $dir = trim(dirname($path), './\\');
        $dir = $dir === '' ? null : $dir;
        $base = basename($path);
        $files = $disk->files($dir);
        $matched = collect($files)->first(
            fn (string $f) => strcasecmp(basename($f), $base) === 0
        );
        if (! $matched) {
            abort(404);
        }
        $path = $matched;
    }

    $fullPath = $disk->path($path);
    if (! is_file($fullPath) || ! is_readable($fullPath)) {
        abort(404);
    }

    return response()->file($fullPath, [
        'Content-Type' => File::mimeType($fullPath) ?: 'application/octet-stream',
        'Cache-Control' => 'public, max-age=31536000, immutable',
    ]);
})->where('path', '.*')->name('uploads.serve');

/*
| SSH/terminal yoksa cache temizlemek için tarayıcıdan bu linki açın:
| https://yalovakamera.com/clear-cache
*/
Route::get('/clear-cache', function () {
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    return response(
        "Cache temizlendi.\n\nview, config, cache, route clear çalıştırıldı.",
        200,
        ['Content-Type' => 'text/plain; charset=utf-8']
    );
})->name('clear-cache');

// Geçici kurulum route'u (SSH yoksa): menu_items tablo kolonlarını günceller.
Route::get('/install-menu-builder-temp', function () {
    if (request('key') !== 'yalova-menu-2026') {
        abort(403);
    }

    if (! \Illuminate\Support\Facades\Schema::hasTable('menu_items')) {
        return response()->json([
            'ok' => false,
            'message' => 'menu_items tablosu bulunamadi.',
        ], 404);
    }

    \Illuminate\Support\Facades\Schema::table('menu_items', function (\Illuminate\Database\Schema\Blueprint $table): void {
        if (! \Illuminate\Support\Facades\Schema::hasColumn('menu_items', 'title')) {
            $table->string('title')->nullable()->after('parent_id');
        }
        if (! \Illuminate\Support\Facades\Schema::hasColumn('menu_items', 'route_name')) {
            $table->string('route_name')->nullable()->after('url');
        }
        if (! \Illuminate\Support\Facades\Schema::hasColumn('menu_items', 'target_type')) {
            $table->string('target_type', 20)->default('same_tab')->after('route_name');
        }
        if (! \Illuminate\Support\Facades\Schema::hasColumn('menu_items', 'icon')) {
            $table->string('icon')->nullable()->after('target_type');
        }
        if (! \Illuminate\Support\Facades\Schema::hasColumn('menu_items', 'css_class')) {
            $table->string('css_class')->nullable()->after('icon');
        }
        if (! \Illuminate\Support\Facades\Schema::hasColumn('menu_items', 'menu_location')) {
            $table->string('menu_location', 30)->default('primary')->after('css_class');
        }
    });

    \Illuminate\Support\Facades\DB::table('menu_items')
        ->whereNull('title')
        ->whereNotNull('label')
        ->update(['title' => \Illuminate\Support\Facades\DB::raw('label')]);

    \Illuminate\Support\Facades\DB::table('menu_items')
        ->whereNull('menu_location')
        ->update(['menu_location' => 'primary']);

    \Illuminate\Support\Facades\DB::table('menu_items')
        ->whereNull('target_type')
        ->update(['target_type' => 'same_tab']);

    return response()->json([
        'ok' => true,
        'database' => \Illuminate\Support\Facades\DB::select('select database() as db')[0]->db ?? null,
        'columns' => [
            'title' => \Illuminate\Support\Facades\Schema::hasColumn('menu_items', 'title'),
            'route_name' => \Illuminate\Support\Facades\Schema::hasColumn('menu_items', 'route_name'),
            'target_type' => \Illuminate\Support\Facades\Schema::hasColumn('menu_items', 'target_type'),
            'icon' => \Illuminate\Support\Facades\Schema::hasColumn('menu_items', 'icon'),
            'css_class' => \Illuminate\Support\Facades\Schema::hasColumn('menu_items', 'css_class'),
            'menu_location' => \Illuminate\Support\Facades\Schema::hasColumn('menu_items', 'menu_location'),
        ],
        'message' => 'Menu builder kolonlari kontrol edildi/eklendi.',
    ]);
});

// use App\Models\User;
// use Illuminate\Support\Facades\Hash;
//
// Route::get('/create-admin', function () {
//
//    User::create([
//        'name' => 'admin',
//        'email' => 'qkhn77@gmail.com',
//        'password' => Hash::make('YbAdmin5546')
//    ]);
//
//    return 'Admin oluşturuldu';
// });

