<?php

namespace App\Modules\Admin\Positions\Controllers;

use App\Models\UserBase;
use App\Modules\Admin\Positions\Models\Position;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class PositionsController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->bc->addCrumb(config('modules.types.Admin.Positions.title'), route('admin.positions'));
    }

    public function index()
    {
        $models = Position::applySort()->orderBy('id', 'DESC')
            ->paginate(setting('main.paginate'))
            ->appends(\Request::except('page'));

        return view('positions.index', [
            'models' => $models,
        ]);
    }

    public function add()
    {
        $this->bc->addCrumb('Добавить');

        return view('positions.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, Position::$validateRules);

        $model = Position::create($request->all());

        if ($model) {
            if (isset($request['privileges'])) {
                $model->updatePrivileges($request['privileges']);
            }
        }

        return self::redirect($request['action'], 'admin.positions', false, 'Успешно добавлено');
    }

    public function edit($modelId)
    {
        $model = Position::findOrFail($modelId);
        $this->bc->addCrumb($model->title);

        return view('positions.edit', [
            'model' => $model,
        ]);
    }

    public function update(Request $request, $modelId)
    {
        $this->validate($request, Position::$validateRules);

        $model = Position::findOrFail($modelId);


        if ($model->update($request->all())) {
            $model->privileges()->delete();

            if (isset($request['privileges'])) {
                $model->updatePrivileges($request['privileges']);
            }
        }

        return self::redirect($request['action'], 'admin.positions', false, 'Успешно изменено');
    }

    public function delete($modelId)
    {
        $model = Position::findOrFail($modelId);

        if (!in_array($model->id, [UserBase::ROOT, UserBase::USER]))
            $model->delete();

        return redirect()->back()->with('message_success', 'Успешно удалено');
    }

}
