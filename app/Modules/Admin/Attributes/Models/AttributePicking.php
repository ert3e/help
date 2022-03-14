<?php

namespace App\Modules\Admin\Attributes\Models;

use App\Models\AttributePickingBase;

class AttributePicking extends AttributePickingBase
{
    public $fillable = ['attribute_id', 'product_id', 'option_id', 'value'];

    public static $validateRules = [
        'attribute_id'  => 'required',
        'product_id'    => 'required',
    ];
}
