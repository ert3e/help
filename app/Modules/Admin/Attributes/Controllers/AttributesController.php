<?php

namespace App\Modules\Admin\Attributes\Controllers;

use App\Modules\Admin\Attributes\Models\Attribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class AttributesController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->bc->addCrumb(config('modules.types.Admin.Attributes.title'), route('admin.attributes'));
    }

    public function index()
    {
        $models = Attribute::applySort()->orderPosition()
            ->paginate(setting('main.paginate'))
            ->appends(\Request::except('page'));

        return view('attributes.index', [
            'models' => $models,
        ]);
    }

    public function add()
    {
        $this->bc->addCrumb('Добавить');

        return view('attributes.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, Attribute::$validateRules);

        $model = Attribute::create($request->all());

        if ($model) {
            $model->updateCategories($request);
        }

        return self::redirect($request['action'], 'admin.attributes', false, 'Успешно добавлено');
    }

    public function edit($modelId)
    {
        $model = Attribute::findOrFail($modelId);
        $this->bc->addCrumb($model->title);

        return view('attributes.edit', [
            'model' => $model,
        ]);
    }

    public function update(Request $request, $modelId)
    {
        $this->validate($request, Attribute::$validateRules);

        $model = Attribute::findOrFail($modelId);

        if ($model->update($request->all())) {
            $model->updateCategories($request);
        }

        return self::redirect($request['action'], 'admin.attributes', false, 'Успешно изменено');
    }

    public function delete($modelId)
    {
        $model = Attribute::findOrFail($modelId);

        $model->delete();

        return redirect()->back()->with('message_success', 'Успешно удалено');
    }

}
