<?php

namespace App\Modules\Admin\Informations\Controllers;

use App\Models\RelationModels\Image;
use App\Modules\Admin\Informations\Models\Information;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class InformationsController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->bc->addCrumb(config('modules.types.Admin.Informations.title'), route('admin.informations'));
    }

    public function index($parent_id = 0)
    {
        $models = Information::whereParentId($parent_id)
            ->applySort()
            ->orderPosition()
            ->get();

        if ($parent_id != 0) {
            $model = Information::findOrFail($parent_id);

            $this->generateBc($model, 'admin.informations');
        }

        return view('informations.index', [
            'models'    => $models,
            'parent_id' => $parent_id,
        ]);
    }

    public function add($parent_id = 0)
    {
        $parent = null;

        if ($parent_id != 0) {
            $parent = Information::findOrFail($parent_id);

            $this->generateBc($parent, 'admin.informations');
        }

        $this->bc->addCrumb('Добавить');

        return view('informations.add', [
            'parent_id' => $parent_id,
            'parent'    => $parent,
        ]);
    }

    public function store($parent_id = 0, Request $request)
    {
        $model = Information::findOrFail($parent_id);

        $rules = Information::$validateRules;

        if ($model->parent_id != 0) {
            $rules['file'] = 'required';
        }

        $this->validate($request, $rules);

        $model = Information::create($request->all());

        if ($model) {

            if ($request->hasFile('file')) {
                $file = $request->file('file');

                $model->uploadFile($file, 'files');
            }

        }

        return self::redirect($request['action'], 'admin.informations', $parent_id, 'Успешно добавлено');
    }

    public function edit($modelId)
    {
        $model = Information::findOrFail($modelId);
        $parent = $model->parent ?? null;

        $this->generateBc($model, 'admin.informations');

        return view('informations.edit', [
            'model' => $model,
            'parent' => $parent,
        ]);
    }

    public function update(Request $request, $modelId)
    {
        $this->validate($request, Information::$validateRules);

        $model = Information::findOrFail($modelId);

        if ($model->update($request->all())) {

            if ($request->hasFile('file')) {
                $file = $request->file('file');

                $model->uploadFile($file, 'files');
            }
        }

        return self::redirect($request['action'], 'admin.informations', isset($model->parent) ? $model->parent->id : 0, 'Успешно изменено');
    }

    public function delete($modelId)
    {
        $model = Information::findOrFail($modelId);

        $model->delete();

        return redirect()->back()->with('message_success', 'Успешно удалено');
    }

    public function deleteImage($modelId, $imageId) {
        $model = Information::findOrFail($modelId);

        $image = Image::find($imageId);

        if ($image) {
            $model->removeImage($image);
        }

        return ['result' => true];
    }

    public function sortableImages($modelId, Request $request) {

        $items = json_decode($request['items'], true);

        $newPositions = [];
        foreach($items as $old => $new) {
            $newItem = Image::find($new);

            $newPositions[$old] = $newItem['position'];
        }

        foreach($newPositions as $item => $position) {
            $model = Image::find($item);
            $model->update([
                'position'  => $position,
            ]);
        }


        return $newPositions;
    }

}
