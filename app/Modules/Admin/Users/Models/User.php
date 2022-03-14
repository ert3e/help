<?php

namespace App\Modules\Admin\Users\Models;

use App\Models\UserBase;

class User extends UserBase
{
    public $fillable = [
        'name',
        'last_name',
        'telephone',
        'address',
        'email',
        'password',
        'position_id',
        'price_id'
    ];

    public static $validateRules = [
        'title'                 => 'max:60',
        'last_name'             => 'max:60',
        'telephone'             => 'max:60',
        'address'               => 'max:60',
        'email'                 => 'required|max:60',
        'password'              => 'nullable|min:6',
    ];
}
