<?php

namespace App\Modules\Site\News\Controllers;

use App\Http\Controllers\Site\SiteController;
use App\Modules\Site\News\Models\News;

class NewsController extends SiteController
{

    public function __construct()
    {
        parent::__construct();
        $this->bc->addCrumb(setting('news.meta_h1'), route('news'));
    }

    public function index()
    {
        $models = News::orderPosition()
            ->paginate(setting('news.paginate_page'));

        return view('news.index', [
            'models' => $models,
        ]);
    }

    public function show($slug)
    {
        $model = News::whereSlug($slug)->firstOrFail();

        $similar = News::where('id', '!=', $model->id)->orderByRaw('RAND()')->take(3)->get();

        $this->bc->addCrumb($model->title);

        $model->increment('views');

        return view('news.show', [
            'model'     => $model,
            'similar'   => $similar,
        ]);
    }

}
