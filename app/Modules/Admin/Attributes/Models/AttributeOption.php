<?php

namespace App\Modules\Admin\Attributes\Models;

use App\Models\AttributeOptionBase;

class AttributeOption extends AttributeOptionBase
{
    public $fillable = ['title', 'attribute_id'];

    public static $validateRules = [
        'title'         => 'required',
    ];
}
