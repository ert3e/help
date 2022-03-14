<?php

namespace App\Modules\Admin\Catalog\Controllers;

use App\Modules\Admin\Catalog\Models\Category;
use App\Modules\Admin\Catalog\Models\Picking;
use Illuminate\Http\Request;

class CategoriesController extends CatalogController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index($parent_id = 0)
    {
        $models = Category::orderPosition()
            ->whereParentId($parent_id)
            ->get();


        $pickings = Picking::applySort()->orderPosition()
            ->whereCategoryId($parent_id)
            ->get();


        if ($parent_id != 0) {
            $model = Category::findOrFail($parent_id);

            $this->generateBc($model, 'admin.catalog');
        }

        return view('catalog.categories.index', [
            'models'    => $models,
            'pickings'  => $pickings,
            'parent_id' => $parent_id
        ]);
    }

    public function pickings()
    {
        $pickings = Picking::applySort()->orderPosition()
            ->paginate(setting('main.paginate'))
            ->appends(\Request::except('page'));

        $this->bc->addCrumb('Все сборы');

        return view('catalog.categories.pickings', [
            'pickings'  => $pickings,
        ]);
    }

    public function add($parent_id)
    {
        if ($parent_id != 0) {
            $model = Category::findOrFail($parent_id);

            $this->generateBc($model, 'admin.catalog');
        }

        $this->bc->addCrumb('Добавить категорию');

        return view('catalog.categories.add', [
            'parent_id' => $parent_id
        ]);
    }

    public function store($parent_id = 0, Request $request)
    {
        $this->validate($request, Category::$validateRules);

        $model = Category::create($request->all());

        if ($model) {
            if ($request->hasFile('image')) {
                $file = $request->file('image');

                $model->uploadImage($file);
            }

            if ($request->has('seo')) {
                $model->updateSeo($request->seo);
            }
        }

        return self::redirect($request['action'], 'admin.catalog', $parent_id, 'Успешно добавлено');
    }

    public function edit($modelId)
    {
        $model = Category::findOrFail($modelId);

        $this->generateBc($model, 'admin.catalog');

        return view('catalog.categories.edit', [
            'model' => $model,
        ]);
    }

    public function update(Request $request, $modelId)
    {
        $this->validate($request, Category::$validateRules);

        $model = Category::findOrFail($modelId);


        if ($model->update($request->all())) {
            if ($request->hasFile('image')) {
                $file = $request->file('image');

                $model->uploadImage($file);
            }

            if ($request->has('seo')) {
                $model->updateSeo($request->seo);
            }
        }

        return self::redirect($request['action'], 'admin.catalog', isset($model->parent) ? $model->parent->id : 0, 'Успешно изменено');
    }

    public function delete($modelId)
    {
        $model = Category::findOrFail($modelId);

        $model->delete();

        return redirect()->back()->with('message_success', 'Успешно удалено');
    }

}
