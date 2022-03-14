<?php

namespace App\Modules\Admin\Navigations\Controllers;

use App\Modules\Admin\Navigations\Models\Navigation;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class NavigationsController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->bc->addCrumb(config('modules.types.Admin.Navigations.title'), route('admin.navigations'));
    }

    public function index($parent_id = 0)
    {
        $models = Navigation::whereParentId($parent_id)->orderPosition()->get();

        if ($parent_id != 0) {
            $model = Navigation::findOrFail($parent_id);

            $this->generateBc($model, 'admin.navigations');
        }

        return view('navigations.index', [
            'models'    => $models,
            'parent_id' => $parent_id
        ]);
    }

    public function add($parent_id = 0)
    {

        if ($parent_id != 0) {
            $model = Navigation::findOrFail($parent_id);

            $this->generateBc($model, 'admin.navigations');
        }

        $this->bc->addCrumb('Добавить');

        return view('navigations.add', [
            'parent_id' => $parent_id
        ]);
    }

    public function store($parent_id = 0, Request $request)
    {
        $this->validate($request, Navigation::$validateRules);

        $model = Navigation::create($request->all());

        return self::redirect($request['action'], 'admin.navigations', $parent_id, 'Успешно добавлено');
    }

    public function edit($modelId)
    {
        $model = Navigation::findOrFail($modelId);

        $this->generateBc($model, 'admin.navigations');

        return view('navigations.edit', [
            'model' => $model,
        ]);
    }

    public function update(Request $request, $modelId)
    {
        $this->validate($request, Navigation::$validateRules);

        $model = Navigation::findOrFail($modelId);

        $model->update($request->all());

        return self::redirect($request['action'], 'admin.navigations', isset($model->parent) ? $model->parent->id : 0, 'Успешно изменено');
    }

    public function delete($modelId)
    {
        $model = Navigation::findOrFail($modelId);

        $model->delete();

        return redirect()->back()->with('message_success', 'Успешно удалено');
    }

}
