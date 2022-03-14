<?php

namespace App\Modules\Admin\News\Models;

use App\Models\NewsBase;

class News extends NewsBase
{

    public $fillable = ['title', 'slug', 'description', 'description_short', 'active', 'position'];

    public static $validateRules = [
        'title'                 => 'required|max:255',
        'slug'                  => 'required|max:100|regex:/^[a-zA-Z0-9-]+$/u',
        'description'           => 'required',
        //'description_short'   => 'max:255',
        'image'                 => 'image',
        'active'                => 'boolean',
    ];

}
