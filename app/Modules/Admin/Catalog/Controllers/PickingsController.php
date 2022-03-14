<?php

namespace App\Modules\Admin\Catalog\Controllers;

use App\Models\RelationModels\Image;
use App\Modules\Admin\Catalog\Models\Category;
use App\Modules\Admin\Catalog\Models\Picking;
use App\Modules\Site\Main\Models\Payment;
use Illuminate\Http\Request;

class PickingsController extends CatalogController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function add($category_id)
    {
        if ($category_id != 0) {
            $model = Category::findOrFail($category_id);

            $this->generateBc($model, 'admin.catalog');
        }

        $this->bc->addCrumb('Добавить '.lcfirstUtf8($this->moduleItems['singleItem']));

        return view('catalog.pickings.add', [
            'category_id' => $category_id
        ]);
    }

    public function store($category_id = 0, Request $request)
    {
        $this->validate($request, Category::$validateRules);

        $model = Picking::create($request->all());

        if ($model) {
            if ($request->hasAny('images')) {
                $model->uploadImagesBase64($request->images);
            }

            if ($request->has('seo')) {
                $model->updateSeo($request->seo);
            }

            if ($request->hasFile('cover')) {
                $file = $request->file('cover');

                $model->uploadAdditionalImage($file, 'cover');
            }

            //$model->updateAdditionalCategories($request->additional_categories ?? []);
            $model->updateAttributes($request->picking_attributes ?? []);

        }

        return self::redirect($request['action'], 'admin.catalog', $category_id, 'Успешно добавлено');
    }

    public function edit($modelId)
    {
        $model = Picking::findOrFail($modelId);

        if ($model->category_id) {
            $category = Category::findOrFail($model->category_id);
            $this->generateBc($category, 'admin.catalog');
        }

        if (isset($_GET['paymentDelete']) && $payment = Payment::find($_GET['paymentDelete'])) {
            $payment->delete();

            return redirect()->back()->with(['message_success' => 'Успешно удалено']);
        }

        $this->bc->addCrumb($model->title);

        return view('catalog.pickings.edit', [
            'model' => $model,
        ]);
    }

    public function update(Request $request, $modelId)
    {
        $this->validate($request, Category::$validateRules);

        $model = Picking::findOrFail($modelId);

        if ($request->action == 'addPay' && $request->pay_amount > 0) {
            $pay = Payment::create(['paid' => 1, 'amount' => $request->pay_amount, 'donationType' => Payment::TYPE_NEEDHELP]);
            $model->pays()->save($pay);
        } else {
            if ($model->update($request->all())) {
                if ($request->hasAny('images')) {
                    $model->uploadImagesBase64($request->images);
                }

                if ($request->has('seo')) {
                    $model->updateSeo($request->seo);
                }

                if ($request->hasFile('cover')) {
                    $file = $request->file('cover');

                    $model->uploadAdditionalImage($file, 'cover');
                }

                //$model->updateAdditionalCategories($request->additional_categories ?? []);
                $model->updateAttributes($request->picking_attributes ?? []);

            }
        }

        return self::redirect($request['action'], 'admin.catalog', isset($model->category) ? $model->category->id : 0, 'Успешно изменено');
    }

    public function delete($modelId)
    {
        $model = Picking::findOrFail($modelId);

        $model->delete();

        return redirect()->back()->with('message_success', 'Успешно удалено');
    }

    public function deleteImage($modelId, $imageId) {
        $model = Picking::findOrFail($modelId);

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
