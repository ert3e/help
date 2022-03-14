<?php

namespace App\Modules\Admin\News\Controllers;

use App\Modules\Admin\News\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class NewsController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->bc->addCrumb(config('modules.types.Admin.News.title'), route('admin.news'));
    }

    public function index()
    {
        $models = News::applySort()->orderPosition()
            ->paginate(setting('main.paginate'))
            ->appends(\Request::except('page'));

        return view('news.index', [
            'models' => $models,
        ]);
    }

    public function add()
    {
        $this->bc->addCrumb('Добавить');

        return view('news.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, News::$validateRules);

        $model = News::create($request->all());

        if ($model) {
            if ($request->hasFile('image')) {
                $file = $request->file('image');

                $model->uploadImage($file);
            }

            if ($request->has('seo')) {
                $model->updateSeo($request->seo);
            }
        }

        return self::redirect($request['action'], 'admin.news', false, 'Успешно добавлено');
    }

    public function edit($modelId)
    {
        $model = News::findOrFail($modelId);
        $this->bc->addCrumb($model->title);

        return view('news.edit', [
            'model' => $model,
        ]);
    }

    public function update(Request $request, $modelId)
    {
        $this->validate($request, News::$validateRules);

        $model = News::findOrFail($modelId);


        if ($model->update($request->all())) {
            if ($request->hasFile('image')) {
                $file = $request->file('image');

                $model->uploadImage($file);
            }

            if ($request->has('seo')) {
                $model->updateSeo($request->seo);
            }
        }

        return self::redirect($request['action'], 'admin.news', false, 'Успешно изменено');
    }

    public function delete($modelId)
    {
        $model = News::findOrFail($modelId);

        $model->delete();

        return redirect()->back()->with('message_success', 'Успешно удалено');
    }

}
