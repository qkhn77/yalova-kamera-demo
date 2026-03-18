<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\SitemapController;
use App\Models\BilgiSayfa;
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
Route::get('/bilgi/{slug}', function ($slug) {
    $bilgiSayfa = BilgiSayfa::where('slug', $slug)
        ->where('is_active', true)
        ->firstOrFail();

    return view('front.pages.bilgi-show', compact('bilgiSayfa'));
})->name('bilgi.show');

// Google SEO: Dinamik sitemap ve robots.txt (Filament’ten eklenen içerik otomatik dahil)
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', [SitemapController::class, 'robots'])->name('robots');

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

// Kullanıcı oluştur (geçici) — /create-admin




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

