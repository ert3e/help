<?php

namespace App\Modules\Profile\Main\Controllers;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainController extends ProfileController
{

    public function index() {
        return view('dashboard.index');
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
