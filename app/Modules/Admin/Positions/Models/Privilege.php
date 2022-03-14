<?php

namespace App\Modules\Admin\Positions\Models;

use App\Models\PrivilegeBase;

class Privilege extends PrivilegeBase
{
    public $fillable = ['title', 'module'];
}
