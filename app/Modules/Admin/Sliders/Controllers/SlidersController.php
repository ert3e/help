<?php

namespace App\Modules\Admin\Sliders\Controllers;

use App\Modules\Admin\Sliders\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class SlidersController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->bc->addCrumb(config('modules.types.Admin.Sliders.title'), route('admin.sliders'));
    }

    public function index($parent_id = 0)
    {
        $models = Slider::whereParentId($parent_id)
            ->applySort()
            ->orderPosition()
            ->paginate(setting('main.paginate'))
            ->appends(\Request::except('page'));

        if ($parent_id != 0) {
            $model = Slider::findOrFail($parent_id);

            $this->generateBc($model, 'admin.sliders');
        }

        return view('sliders.index', [
            'models'    => $models,
            'parent_id' => $parent_id,
        ]);
    }

    public function add($parent_id = 0)
    {

        if ($parent_id != 0) {
            $model = Slider::findOrFail($parent_id);

            $this->generateBc($model, 'admin.sliders');
        }

        $this->bc->addCrumb('Добавить');

        return view('sliders.add', [
            'parent_id' => $parent_id,
        ]);
    }

    public function store($parent_id = 0, Request $request)
    {
        $this->validate($request, Slider::$validateRules);

        $model = Slider::create($request->all());

        if ($model) {
            if ($request->hasFile('image')) {
                $file = $request->file('image');

                $model->uploadImage($file);
            }
        }

        return self::redirect($request['action'], 'admin.sliders', $parent_id, 'Успешно добавлено');
    }

    public function edit($modelId)
    {
        $model = Slider::findOrFail($modelId);

        $this->generateBc($model, 'admin.sliders');

        return view('sliders.edit', [
            'model' => $model,
        ]);
    }

    public function update(Request $request, $modelId)
    {
        Slider::$validateRules['image'] = 'image';

        $this->validate($request, Slider::$validateRules);

        $model = Slider::findOrFail($modelId);

        if ($model->update($request->all())) {
            if ($request->hasFile('image')) {
                $file = $request->file('image');

                $model->uploadImage($file);
            }
        }

        return self::redirect($request['action'], 'admin.sliders', isset($model->parent) ? $model->parent->id : 0, 'Успешно изменено');
    }

    public function delete($modelId)
    {
        $model = Slider::findOrFail($modelId);

        $model->delete();

        return redirect()->back()->with('message_success', 'Успешно удалено');
    }

}
