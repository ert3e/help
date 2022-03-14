<?php

namespace App\Models;

class AttributeOptionBase extends BaseModel
{

    public $table = 'attributes_options';

    public $timestamps = false;

    public function parent() {
        return $this->belongsTo('App\Models\AttributeBase', 'attribute_id');
    }
}
