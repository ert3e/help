<?php

namespace App\Models;

class AttributeCategoryBase extends BaseModel
{
    public $table = 'attributes_categories';

    public $timestamps = false;

    public function category() {
        return $this->belongsTo('App\Models\CategoryBase', 'category_id');
    }

}
