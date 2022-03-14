<?php

namespace App\Modules\Admin\Pages\Models;

use App\Models\PageBase;

class Page extends PageBase
{
    public $fillable = ['title', 'slug', 'description', 'description_short', 'link', 'active'];

    public static $validateRules = [
        'title'                 => 'required|max:255',
        'slug'                  => 'required|max:100|regex:/^[a-zA-Z0-9-]+$/u',
        'active'                => 'boolean',
    ];
}
