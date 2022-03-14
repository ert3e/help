<?php

namespace App\Modules\Admin\Attributes\Controllers;

use App\Modules\Admin\Attributes\Models\Attribute;
use App\Modules\Admin\Attributes\Models\AttributeOption;
use Illuminate\Http\Request;

class AttributesOptionsController extends AttributesController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function options($modelId)
    {
        $attribute = Attribute::findOrFail($modelId);

        return view('attributes.options', [
            'attribute' => $attribute,
        ]);
    }

    public function storeOption($modelId, Request $request) {

        $attribute = Attribute::findOrFail($modelId);

        $this->validate($request, AttributeOption::$validateRules);

        $data = $request->all();
        $data['attribute_id'] = $attribute->id;

        AttributeOption::create($data);

        return redirect()->back()->with('message_success', 'Успешно добавлено');
    }

    public function editOption($modelId, $optionId) {
        $model = AttributeOption::findOrFail($optionId);

        $this->bc->addCrumb($model->parent->title, route('admin.attributes.options', $model->parent->id));
        $this->bc->addCrumb($model->title);

        return view('attributes.optionsEdit', [
            'model' => $model,
        ]);
    }

    public function updateOption($modelId, $optionId, Request $request) {

        $option = AttributeOption::findOrFail($optionId);

        $this->validate($request, AttributeOption::$validateRules);

        $option->update($request->all());

        return redirect()->route('admin.attributes.options', $modelId)->with('message_success', 'Успешно изменено');
    }

    public function storeDelete($modelId, $optionId) {
        $model = AttributeOption::findOrFail($optionId);

        $model->delete();

        return redirect()->back()->with('message_success', 'Успешно удалено');
    }

}
