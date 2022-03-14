<?php

namespace App\Modules\Admin\Catalog\Models;

use App\Models\AttributeBase;
use App\Models\AttributePickingBase;
use App\Models\PickingBase;
use App\Models\PickingCategoryBase;
use App\Models\RelationModels\Payment;

class Picking extends PickingBase
{
    public $fillable = [
        'title', 'slug', 'description', 'price', 'active', 'hit',
        'position', 'category_id', 'path'
    ];

    public static $validateRules = [
        'title'                 => 'required|max:255',
        'slug'                  => 'required|max:100|regex:/^[a-zA-Z0-9-]+$/u',
        'active'                => 'boolean',
        'price'                 => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
    ];

    public function pays() {
        return $this->morphMany(Payment::class, 'item');
    }

    public function getImagesComponent($size = 200) {
        $data = [];

        foreach($this->images as $image) {
            $data[] = [
                'key'           => $image['id'],
                'url'           => $this->resize($image, $size),
                'routeDelete'   => route('admin.catalog.edit.picking.deleteImage', [$this->id, $image->id]),
            ];
        }

        return json_encode($data);
    }

    public function updateAttributes($attributes = []) {
        $this->attributes()->delete();

        foreach($attributes as $attribute_id => $value) {
            $attribute = AttributeBase::find($attribute_id);

            AttributePickingBase::create([
                'attribute_id'  => $attribute->id,
                'picking_id'    => $this->id,
                'option_id'     => $attribute->isSelect() ? $value : 0,
                'value'         => $attribute->isSelect() ? '' : $value,
            ]);
        }
    }


    public function updateAdditionalCategories($categories = []) {
        $this->additionalCategories()->delete();

        foreach($categories as $category_id) {
            PickingCategoryBase::create([
                'category_id'   => $category_id,
                'picking_id'    => $this->id,
            ]);
        }
    }


}
