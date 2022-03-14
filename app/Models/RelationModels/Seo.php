<?php

namespace App\Models\RelationModels;

use App\Models\BaseModel;

class Seo extends BaseModel
{

    public $table = 'seo';

    public $fillable = ['meta_h1', 'meta_title', 'meta_keywords', 'meta_description', 'item_type'];

    public $timestamps = false;

    public function seo()
    {
        return $this->morphTo();
    }

}
