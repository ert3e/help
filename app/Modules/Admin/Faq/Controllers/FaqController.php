<?php

namespace App\Modules\Admin\Faq\Controllers;

use App\Modules\Admin\Faq\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class FaqController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->bc->addCrumb(config('modules.types.Admin.Faq.title'), route('admin.faq'));
    }

    public function index()
    {
        $models = Faq::applySort()->orderPosition()
            ->paginate(setting('main.paginate'))
            ->appends(\Request::except('page'));

        return view('faq.index', [
            'models' => $models,
        ]);
    }

    public function add()
    {
        $this->bc->addCrumb('Добавить');

        return view('faq.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, Faq::$validateRules);

        $model = Faq::create($request->all());

        return self::redirect($request['action'], 'admin.faq', false, 'Успешно добавлено');
    }

    public function edit($modelId)
    {
        $model = Faq::findOrFail($modelId);
        $this->bc->addCrumb($model->question);

        return view('faq.edit', [
            'model' => $model,
        ]);
    }

    public function update(Request $request, $modelId)
    {
        $this->validate($request, Faq::$validateRules);

        $model = Faq::findOrFail($modelId);

        $model->update($request->all());

        return self::redirect($request['action'], 'admin.faq', false, 'Успешно изменено');
    }

    public function delete($modelId)
    {
        $model = Faq::findOrFail($modelId);

        $model->delete();

        return redirect()->back()->with('message_success', 'Успешно удалено');
    }

}
