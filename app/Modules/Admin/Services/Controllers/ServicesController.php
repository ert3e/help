<?php

namespace App\Modules\Admin\Services\Controllers;

use App\Models\RelationModels\Image;
use App\Modules\Admin\Services\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class ServicesController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->bc->addCrumb(config('modules.types.Admin.Services.title'), route('admin.services'));
    }

    public function index($parent_id = 0)
    {
        $models = Service::whereParentId($parent_id)
            ->applySort()
            ->orderPosition()
            ->get();

        if ($parent_id != 0) {
            $model = Service::findOrFail($parent_id);

            $this->generateBc($model, 'admin.services');
        }

        return view('services.index', [
            'models'    => $models,
            'parent_id' => $parent_id,
        ]);
    }

    public function add($parent_id = 0)
    {
        if ($parent_id != 0) {
            $model = Service::findOrFail($parent_id);

            $this->generateBc($model, 'admin.services');
        }

        $this->bc->addCrumb('Добавить');

        return view('services.add', [
            'parent_id' => $parent_id
        ]);
    }

    public function store($parent_id = 0, Request $request)
    {
        $this->validate($request, Service::$validateRules);

        $model = Service::create($request->all());

        if ($model) {
            if ($request->hasAny('images')) {
                $model->uploadImagesBase64($request->images);
            }

            if ($request->hasFile('image')) {
                $file = $request->file('image');

                $model->uploadAdditionalImage($file, 'image');
            }

            if ($request->has('seo')) {
                $model->updateSeo($request->seo);
            }
        }

        return self::redirect($request['action'], 'admin.services', $parent_id, 'Успешно добавлено');
    }

    public function edit($modelId)
    {
        $model = Service::findOrFail($modelId);

        $this->generateBc($model, 'admin.services');

        return view('services.edit', [
            'model' => $model,
        ]);
    }

    public function update(Request $request, $modelId)
    {
        $this->validate($request, Service::$validateRules);

        $model = Service::findOrFail($modelId);

        if ($model->update($request->all())) {
            if ($request->hasAny('images')) {
                $model->uploadImagesBase64($request->images);
            }

            if ($request->hasFile('image')) {
                $file = $request->file('image');

                $model->uploadAdditionalImage($file, 'image');
            }

            if ($request->has('seo')) {
                $model->updateSeo($request->seo);
            }
        }

        return self::redirect($request['action'], 'admin.services', isset($model->parent) ? $model->parent->id : 0, 'Успешно изменено');
    }

    public function delete($modelId)
    {
        $model = Service::findOrFail($modelId);

        $model->delete();

        return redirect()->back()->with('message_success', 'Успешно удалено');
    }

    public function deleteImage($modelId, $imageId) {
        $model = Service::findOrFail($modelId);

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
