<?php

namespace App\Modules\Admin\Main\Controllers;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainController extends AdminController
{

    public function index() {
        return view('dashboard.index');
    }

    public function auth(Request $request) {

        if ($request->post()) {

            if (isset($request['password']) && $request['password'] == env('ADMIN_PASSWORD')) {
                /*
                 * если пароль верный - сохраняем в сессию сам пароль для того, чтобы
                 * если вдруг пароль от админки изменится, мы сбросили сессию админки
                 */
                Session::put('admin', $request['password']);

                return redirect()->route('admin.main');
            } else {

                return redirect()->back()->with('message_error', 'Ошибка! Неверный пароль');
            }

        }

        return view('auth.index');
    }

    public function sortable($model, Request $request) {

        $modelPath = '\App\\Models\\'.$model.'Base';

        $items = json_decode($request['items'], true);

        $newPositions = [];
        foreach($items as $old => $new) {
            $newItem = $modelPath::find($new);

            $newPositions[$old] = $newItem['position'];
        }

        foreach($newPositions as $item => $position) {
            $model = $modelPath::find($item);
            $model->update([
                'position'  => $position,
            ]);
        }


        return $newPositions;
    }

}
