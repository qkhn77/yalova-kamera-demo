<?php

namespace App\Http\Controllers;

use App\Models\BilgiSayfa;
use App\Models\Page;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class SitemapController extends Controller
{
    private const CACHE_KEY = 'sitemap_xml';
    private const CACHE_TTL = 3600; // 1 saat — yeni sayfalar en geç 1 saat içinde sitemap'e girer

    /**
     * Google uyumlu dinamik sitemap.
     * Yeni eklenen sayfa/blog/servis/proje/bilgi sayfası otomatik dahil edilir.
     */
    public function index(): Response
    {
        // XML'den önce hiçbir çıktı gitmemeli (XML declaration belgenin ilk karakteri olmalı)
        while (ob_get_level()) {
            ob_end_clean();
        }
        ob_start();

        $xml = Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            $xml = $this->buildSitemapXml();
            $this->pingSearchEngines();
            return $xml;
        });

        $xml = preg_replace('/^\xEF\xBB\xBF/', '', $xml);
        $xml = ltrim($xml, " \t\r\n");
        $start = strpos($xml, '<?xml');
        if ($start !== false && $start > 0) {
            $xml = substr($xml, $start);
        }

        ob_end_clean();

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    private function buildSitemapXml(): string
    {
        $base = rtrim(config('app.url'), '/');
        $urls = [];

        // —— Statik sayfalar ——
        $urls[] = $this->url($base.'/', now(), 'daily', '1.0');
        $urls[] = $this->url($base.'/hakkimizda', now(), 'monthly', '0.9');
        $urls[] = $this->url($base.'/iletisim', now(), 'monthly', '0.8');

        // —— Servisler ——
        $urls[] = $this->url($base.'/Servisler', now(), 'weekly', '0.9');
        ServiceCategory::where('is_active', true)->get()->each(function ($cat) use ($base, &$urls) {
            $urls[] = $this->url($base.'/Servisler/kategori/'.$cat->slug, $cat->updated_at, 'weekly', '0.8');
        });
        Service::where('is_active', true)->get()->each(function ($s) use ($base, &$urls) {
            $urls[] = $this->url($base.'/Servisler/'.$s->slug, $s->updated_at, 'monthly', '0.7');
        });

        // —— Projeler ——
        $urls[] = $this->url($base.'/WebProje', now(), 'weekly', '0.9');
        ProjectCategory::where('is_active', true)->get()->each(function ($cat) use ($base, &$urls) {
            $urls[] = $this->url($base.'/WebProje/kategori/'.$cat->slug, $cat->updated_at, 'weekly', '0.8');
        });

        // —— Ürünler ——
        $urls[] = $this->url($base.'/urunler', now(), 'weekly', '0.9');
        ProductCategory::where('is_active', true)->get()->each(function ($cat) use ($base, &$urls) {
            $urls[] = $this->url($base.'/urun-kategori/'.$cat->slug, $cat->updated_at, 'weekly', '0.8');
        });
        Product::where('is_active', true)->get()->each(function ($product) use ($base, &$urls) {
            $urls[] = $this->url($base.'/urun/'.$product->slug, $product->updated_at, 'weekly', '0.8');
        });
        Project::where('is_active', true)->get()->each(function ($p) use ($base, &$urls) {
            $urls[] = $this->url($base.'/WebProje/'.$p->slug, $p->updated_at, 'monthly', '0.7');
        });

        // —— Blog ——
        $urls[] = $this->url($base.'/blog', now(), 'daily', '0.9');
        PostCategory::where('is_active', true)->get()->each(function ($cat) use ($base, &$urls) {
            $urls[] = $this->url($base.'/blog/kategori/'.$cat->slug, $cat->updated_at, 'weekly', '0.8');
        });
        Post::where('is_published', true)->get()->each(function ($post) use ($base, &$urls) {
            $date = $post->published_at ?? $post->updated_at;
            $urls[] = $this->url($base.'/blog/'.$post->slug, $date, 'weekly', '0.7');
        });

        // —— Bilgi sayfaları (yeni eklenenler otomatik) ——
        BilgiSayfa::where('is_active', true)->get()->each(function ($p) use ($base, &$urls) {
            $date = $p->published_at ?? $p->updated_at;
            $urls[] = $this->url($base.'/bilgi/'.$p->slug, $date, 'monthly', '0.7');
        });

        // —— Dinamik sayfalar (Page model) ——
        Page::where('is_active', true)->get()->each(function ($p) use ($base, &$urls) {
            $urls[] = $this->url($base.'/sayfa/'.$p->slug, $p->updated_at, 'monthly', '0.7');
        });

        return $this->buildXml($urls);
    }

    private function url(string $loc, $lastmod, string $changefreq, string $priority): array
    {
        $date = $lastmod instanceof \DateTimeInterface
            ? $lastmod->format('Y-m-d')
            : (\Carbon\Carbon::parse($lastmod)->format('Y-m-d'));

        return [
            'loc' => $loc,
            'lastmod' => $date,
            'changefreq' => $changefreq,
            'priority' => $priority,
        ];
    }

    private function buildXml(array $urls): string
    {
        $out = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $out .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

        foreach ($urls as $u) {
            $out .= '  <url>'."\n";
            $out .= '    <loc>'.htmlspecialchars($u['loc'], ENT_XML1, 'UTF-8').'</loc>'."\n";
            $out .= '    <lastmod>'.$u['lastmod'].'</lastmod>'."\n";
            $out .= '    <changefreq>'.$u['changefreq'].'</changefreq>'."\n";
            $out .= '    <priority>'.$u['priority'].'</priority>'."\n";
            $out .= '  </url>'."\n";
        }

        $out .= '</urlset>';

        return $out;
    }

    /**
     * Sitemap güncellendiğinde Google ve Bing'e bildirim gönderir (SEO).
     */
    private function pingSearchEngines(): void
    {
        $sitemapUrl = rtrim(config('app.url'), '/').'/sitemap.xml';
        $url = 'https://www.google.com/ping?sitemap='.urlencode($sitemapUrl);
        try {
            Http::timeout(5)->get($url);
        } catch (\Throwable) {
            // Sessizce yoksay; sitemap yine de çalışır
        }
        $bingUrl = 'https://www.bing.com/ping?sitemap='.urlencode($sitemapUrl);
        try {
            Http::timeout(5)->get($bingUrl);
        } catch (\Throwable) {
            //
        }
    }

    /**
     * Dinamik robots.txt — Sitemap URL'i APP_URL ile üretilir.
     */
    public function robots(): Response
    {
        $base = rtrim(config('app.url'), '/');
        $body = "User-agent: *\nAllow: /\n\nSitemap: {$base}/sitemap.xml\n";

        return response($body, 200, [
            'Content-Type' => 'text/plain; charset=UTF-8',
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }
}
