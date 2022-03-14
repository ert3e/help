<?php

namespace App\Modules\Admin\Users\Controllers;

use App\Modules\Admin\Users\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class UsersController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->bc->addCrumb(config('modules.types.Admin.Users.title'), route('admin.users'));
    }

    public function index()
    {
        $models = User::applySort()->orderBy('id', 'DESC')
            ->paginate(setting('main.paginate'))
            ->appends(\Request::except('page'));

        return view('users.index', [
            'models' => $models,
        ]);
    }

    public function add()
    {
        $this->bc->addCrumb('Добавить');

        return view('users.add');
    }

    public function store(Request $request)
    {
        User::$validateRules['password'] = 'required|min:6';

        $this->validate($request, User::$validateRules);

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return self::redirect($request['action'], 'admin.users', false, 'Успешно добавлено');
    }

    public function edit($modelId)
    {
        $model = User::findOrFail($modelId);
        $this->bc->addCrumb('ID: '.$model->id);

        return view('users.edit', [
            'model' => $model,
        ]);
    }

    public function update(Request $request, $modelId)
    {
        $this->validate($request, User::$validateRules);

        $model = User::findOrFail($modelId);

        $data = $request->all();

        if (isset($data['password']) && $data['password'] != '') {
            $data['password'] = bcrypt($data['password']);
        } else {
            $data['password'] = $model->password;
        }

        if ($modelId == 1) {
            $data['position_id'] = $model->position_id;
        }

        $model->update($data);

        return self::redirect($request['action'], 'admin.users', false, 'Успешно изменено');
    }

    public function delete($modelId)
    {
        $model = User::findOrFail($modelId);

        if ($modelId != 1) {
            $model->delete();
        }

        return redirect()->back()->with('message_success', 'Успешно удалено');
    }

}
