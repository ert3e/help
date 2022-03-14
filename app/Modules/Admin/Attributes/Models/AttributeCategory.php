<?php

namespace App\Modules\Admin\Attributes\Models;

use App\Models\AttributeCategoryBase;

class AttributeCategory extends AttributeCategoryBase
{
    public $fillable = ['attribute_id', 'category_id'];

    public static $validateRules = [
        'attribute_id'  => 'required',
        'category_id'   => 'required',
    ];
}
