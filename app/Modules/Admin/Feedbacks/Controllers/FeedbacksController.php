<?php

namespace App\Modules\Admin\Feedbacks\Controllers;

use App\Modules\Admin\Feedbacks\Models\Feedback;
use App\Http\Controllers\Admin\AdminController;

class FeedbacksController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->bc->addCrumb(config('modules.types.Admin.Feedbacks.title'), route('admin.feedbacks'));
    }

    public function index()
    {
        $feedbacks = Feedback::applySort();

        if (isset($_GET['type']) && array_key_exists($_GET['type'], Feedback::getTypes())) {
            $feedbacks = $feedbacks->whereType($_GET['type']);
        }

        $feedbacks = $feedbacks->orderBy('id', 'DESC')->paginate(setting('main.paginate'))
            ->appends(\Request::except('page'));


        return view('feedbacks.index', [
            'feedbacks' => $feedbacks
        ]);
    }

    public function delete($modelId)
    {
        $model = Feedback::findOrFail($modelId);

        $model->delete();

        return redirect()->back()->with('message_success', 'Успешно удалено');
    }

}
