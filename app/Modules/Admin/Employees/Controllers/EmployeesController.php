<?php

namespace App\Modules\Admin\Employees\Controllers;

use App\Modules\Admin\Employees\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class EmployeesController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->bc->addCrumb(config('modules.types.Admin.Employees.title'), route('admin.employees'));
    }

    public function index()
    {
        $models = Employee::applySort()->orderPosition()
            ->paginate(setting('main.paginate'))
            ->appends(\Request::except('page'));

        return view('employees.index', [
            'models' => $models,
        ]);
    }

    public function add()
    {
        $this->bc->addCrumb('Добавить');

        return view('employees.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, Employee::$validateRules);

        $model = Employee::create($request->all());

        if ($model) {
            if ($request->hasFile('image')) {
                $file = $request->file('image');

                $model->uploadImage($file);
            }
        }

        return self::redirect($request['action'], 'admin.employees', false, 'Успешно добавлено');
    }

    public function edit($modelId)
    {
        $model = Employee::findOrFail($modelId);
        $this->bc->addCrumb($model->fio);

        return view('employees.edit', [
            'model' => $model,
        ]);
    }

    public function update(Request $request, $modelId)
    {
        $this->validate($request, Employee::$validateRules);

        $model = Employee::findOrFail($modelId);


        if ($model->update($request->all())) {
            if ($request->hasFile('image')) {
                $file = $request->file('image');

                $model->uploadImage($file);
            }
        }

        return self::redirect($request['action'], 'admin.employees', false, 'Успешно изменено');
    }

    public function delete($modelId)
    {
        $model = Employee::findOrFail($modelId);

        $model->delete();

        return redirect()->back()->with('message_success', 'Успешно удалено');
    }

}
