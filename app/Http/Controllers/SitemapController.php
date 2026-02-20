<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    public function index()
    {
        // Cache sitemap for 1 day
        $sitemap = Cache::remember('sitemap_xml', 86400, function () {
            return $this->generateSitemap();
        });

        return response($sitemap, 200)
            ->header('Content-Type', 'application/xml');
    }

    private function generateSitemap(): string
    {
        $baseUrl = config('app.url');
        $now = now()->toIso8601String();

        // Start XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . "\n";
        $xml .= '        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . "\n\n";

        // ── STATIC PAGES ────────────────────────────────────
        $staticPages = [
            ['url' => '/',                     'priority' => '1.0', 'changefreq' => 'weekly'],
            // ['url' => '/#features',            'priority' => '0.8', 'changefreq' => 'monthly'],
            // ['url' => '/#calling',             'priority' => '0.8', 'changefreq' => 'monthly'],
            // ['url' => '/#multi-company',       'priority' => '0.8', 'changefreq' => 'monthly'],
            // ['url' => '/#media-library',       'priority' => '0.8', 'changefreq' => 'monthly'],
            // ['url' => '/#reviews',             'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => '/blog',                 'priority' => '0.9', 'changefreq' => 'daily'],
            ['url' => '/privacy-policy',       'priority' => '0.4', 'changefreq' => 'yearly'],
            ['url' => '/terms-and-conditions', 'priority' => '0.4', 'changefreq' => 'yearly'],
        ];

        foreach ($staticPages as $page) {
            $xml .= $this->buildUrl(
                $baseUrl . $page['url'],
                $now,
                $page['changefreq'],
                $page['priority']
            );
        }

        // ── BLOG POSTS (DYNAMIC) ────────────────────────────
        $blogs = Blog::where('status', 'published')

            ->orderBy('published_at', 'desc')
            ->get();

        foreach ($blogs as $blog) {
            $xml .= $this->buildUrl(
                route('blog.show', $blog->slug),
                optional($blog->updated_at)->toIso8601String() ?? $now,
                'monthly',
                '0.7',
                $blog->cover_url ?? null
            );
        }

        // ── BLOG CATEGORIES ─────────────────────────────────
        $categories = Blog::published()
            ->pluck('category')
            ->unique()
            ->filter();

        foreach ($categories as $category) {
            $xml .= $this->buildUrl(
                $baseUrl . '/blog?category=' . urlencode($category),
                $now,
                'weekly',
                '0.6'
            );
        }

        $xml .= "</urlset>\n";

        return $xml;
    }

    private function buildUrl(
        string $loc,
        string $lastmod,
        string $changefreq,
        string $priority,
        ?string $imageUrl = null
    ): string {
        $xml  = "  <url>\n";
        $xml .= "    <loc>" . htmlspecialchars($loc) . "</loc>\n";
        $xml .= "    <lastmod>" . $lastmod . "</lastmod>\n";
        $xml .= "    <changefreq>" . $changefreq . "</changefreq>\n";
        $xml .= "    <priority>" . $priority . "</priority>\n";

        if ($imageUrl) {
            $xml .= "    <image:image>\n";
            $xml .= "      <image:loc>" . htmlspecialchars($imageUrl) . "</image:loc>\n";
            $xml .= "    </image:image>\n";
        }

        $xml .= "  </url>\n\n";

        return $xml;
    }

    // Clear sitemap cache manually
    public function clearCache()
    {
        Cache::forget('sitemap_xml');
        return response()->json(['message' => 'Sitemap cache cleared!']);
    }
}
