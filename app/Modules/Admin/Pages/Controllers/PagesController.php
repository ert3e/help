<?php

namespace App\Modules\Admin\Pages\Controllers;

use App\Modules\Admin\Pages\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class PagesController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->bc->addCrumb('Статические страницы', route('admin.pages'));
    }

    public function index()
    {
        $models = Page::applySort()->orderBy('id', 'DESC')
            ->paginate(setting('main.paginate'))
            ->appends(\Request::except('page'));

        return view('pages.index', [
            'models' => $models,
        ]);
    }

    public function add()
    {
        $this->bc->addCrumb('Добавить');

        return view('pages.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, Page::$validateRules);

        $model = Page::create($request->all());

        if ($model) {
            if ($request->has('seo')) {
                $model->updateSeo($request->seo);
            }
        }

        return self::redirect($request['action'], 'admin.pages', false, 'Успешно добавлено');
    }

    public function edit($modelId)
    {
        $model = Page::findOrFail($modelId);
        $this->bc->addCrumb($model->title);

        return view('pages.edit', [
            'model' => $model,
        ]);
    }

    public function update(Request $request, $modelId)
    {
        $this->validate($request, Page::$validateRules);

        $model = Page::findOrFail($modelId);

        if ($model->update($request->all())) {
            if ($request->has('seo')) {
                $model->updateSeo($request->seo);
            }
        }

        return self::redirect($request['action'], 'admin.pages', false, 'Успешно изменено');
    }

    public function delete($modelId)
    {
        $model = Page::findOrFail($modelId);

        $model->delete();

        return redirect()->back()->with('message_success', 'Успешно удалено');
    }

}
