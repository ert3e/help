<?php

namespace App\Modules\Site\Main\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Site\Catalog\Models\Category;
use App\Modules\Site\Catalog\Models\Picking;
use App\Modules\Site\News\Models\Employee;
use App\Modules\Site\News\Models\News;
use App\Modules\Site\Pages\Models\Page;
use Illuminate\Support\Facades\URL;
use Spatie\Crawler\Crawler;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;

class SitemapController extends Controller
{

    // генерируем sitemap.xml и отдаем его пользователю
    public function generate() {
        $sitemapPath = 'sitemap.xml';

        $sitemap = Sitemap::create();

        // СТРАНИЦЫ
        $sitemap->add(route('main'));

        foreach(Page::all() as $item) {
            $sitemap->add(route('pages', $item->slug));
        }
        ////

        // СБОРЫ
        $sitemap->add(route('catalog'));

        foreach(Picking::all() as $item) {
            $sitemap->add(route('catalog', $item->path));
        }
        ////

        // НОВОСТИ
        $sitemap->add(route('news'));

        foreach(News::all() as $item) {
            $sitemap->add(route('news.show', $item->slug));
        }
        ////

        $sitemap->writeToFile($sitemapPath);

        header('Content-Type: application/xml');
        header('Content-Length: ' . filesize($sitemapPath));

        readfile($sitemapPath);
        exit();
    }

}
