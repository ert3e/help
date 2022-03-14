<?php

namespace App\Modules\Site\Main\Controllers;

use App\Http\Controllers\Site\SiteController;
use App\Modules\Admin\Services\Models\Service;
use App\Modules\Site\Catalog\Models\Category;
use App\Modules\Site\Catalog\Models\Picking;
use App\Modules\Site\News\Models\News;
use Illuminate\Http\Request;

class MainController extends SiteController
{

    public function index(Request $request) {

        $news = News::take(setting('news.paginate_main'))->get();
        $services = Service::take(setting('services.paginate_main'))->get();

        $pickings = Picking::whereCategoryId(Category::TYPE_NEEDHELP)
            ->take(setting('pickings.paginate_main'))->get();

        $pickingsCompleted = Picking::whereCategoryId(Category::TYPE_HELPED)
            ->take(setting('pickings.paginate_main'))->get();

        return view('main.index', [
            'news'              => $news,
            'services'          => $services,
            'pickings'          => $pickings,
            'pickingsCompleted' => $pickingsCompleted,
        ]);
    }

}
