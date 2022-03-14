<?php

namespace App\Modules\Admin\Partners\Models;

use App\Models\PartnerBase;

class Partner extends PartnerBase
{
    public $fillable = ['title', 'url', 'active', 'position'];

    public static $validateRules = [
        //'title'         => 'required|max:255',
        //'url'           => 'required',
        'image'         => 'image',
        'active'        => 'boolean',
    ];
}
