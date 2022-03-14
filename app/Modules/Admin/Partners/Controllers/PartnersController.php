<?php

namespace App\Modules\Admin\Partners\Controllers;

use App\Modules\Admin\Partners\Models\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class PartnersController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->bc->addCrumb(config('modules.types.Admin.Partners.title'), route('admin.partners'));
    }

    public function index()
    {
        $models = Partner::applySort()->orderPosition()
            ->paginate(setting('main.paginate'))
            ->appends(\Request::except('page'));

        return view('partners.index', [
            'models' => $models,
        ]);
    }

    public function add()
    {
        $this->bc->addCrumb('Добавить');

        return view('partners.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, Partner::$validateRules);

        $model = Partner::create($request->all());

        if ($model) {
            if ($request->hasFile('image')) {
                $file = $request->file('image');

                $model->uploadImage($file);
            }

            if ($request->has('seo')) {
                $model->updateSeo($request->seo);
            }
        }

        return self::redirect($request['action'], 'admin.partners', false, 'Успешно добавлено');
    }

    public function edit($modelId)
    {
        $model = Partner::findOrFail($modelId);
        $this->bc->addCrumb($model->title ?? 'ID: '.$model->id);

        return view('partners.edit', [
            'model' => $model,
        ]);
    }

    public function update(Request $request, $modelId)
    {
        $this->validate($request, Partner::$validateRules);

        $model = Partner::findOrFail($modelId);


        if ($model->update($request->all())) {
            if ($request->hasFile('image')) {
                $file = $request->file('image');

                $model->uploadImage($file);
            }

            if ($request->has('seo')) {
                $model->updateSeo($request->seo);
            }
        }

        return self::redirect($request['action'], 'admin.partners', false, 'Успешно изменено');
    }

    public function delete($modelId)
    {
        $model = Partner::findOrFail($modelId);

        $model->delete();

        return redirect()->back()->with('message_success', 'Успешно удалено');
    }

}
