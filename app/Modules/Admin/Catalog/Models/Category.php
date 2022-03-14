<?php

namespace App\Modules\Admin\Catalog\Models;

use App\Models\CategoryBase;

/**
 * Class Category
 * @package App\Modules\Admin\Catalog\Models
 * @filesource App\Modules\Admin\Catalog\Models\Category
 */
class Category extends CategoryBase
{
    public $fillable = ['title', 'slug', 'description', 'description_short', 'active', 'position', 'parent_id', 'path'];

    public static $validateRules = [
        'title'                 => 'required|max:255',
        'slug'                  => 'required|max:100|regex:/^[a-zA-Z0-9-]+$/u',
        'image'                 => 'image',
        'active'                => 'boolean',
    ];

}
