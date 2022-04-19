<?php

namespace App\Modules\Profile\Main\Controllers;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Profile\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\RelationModels\Image;
use Illuminate\Support\Facades\View;

class MainController extends ProfileController
{

    public function index() {
        $this->bc->addCrumb('Личный кабинет');
        View::share('title', 'Анкета');
        return view('dashboard.index');
    }

    public function uploadAvatar(Request $request)
    {
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' .$avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('uploads/avatars/'. $filename));

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }
        return view('dashboard.index');
    }

    public function updateUser(Request $request)
    {
        //validation rules

        $request->validate([
            'name' =>'required|min:4|string|max:255',
            'email'=>'required|email|string|max:255',
            'address'=>'required|string|max:255'
        ]);

        $user = Auth::user();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->address = $request['address'];
        $user->save();
        return back()->with('message','Profile Updated');

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
