<?php

namespace App\Models\RelationModels;

use App\Models\BaseModel;

class Image extends BaseModel
{

    public $fillable = ['filename', 'position', 'item_type'];

    public $timestamps = false;

    public function images()
    {
        return $this->morphTo();
    }

}
