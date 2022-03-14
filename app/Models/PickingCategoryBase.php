<?php

namespace App\Models;

class PickingCategoryBase extends BaseModel
{

    public $table = 'pickings_categories';

    public $fillable = ['picking_id', 'category_id'];

    public $timestamps = false;

}
