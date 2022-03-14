<?php

namespace App\Modules\Admin\Navigations\Models;

use App\Models\NavigationBase;

class Navigation extends NavigationBase
{
    public $fillable = ['parent_id', 'title', 'alias', 'url', 'class', 'position'];

    public static $validateRules = [
        'title' => 'required',
    ];
}
