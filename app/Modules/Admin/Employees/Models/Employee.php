<?php

namespace App\Modules\Admin\Employees\Models;

use App\Models\EmployeeBase;

class Employee extends EmployeeBase
{
    public $fillable = ['fio', 'profession', 'active', 'position'];

    public static $validateRules = [
        'fio'       => 'required|max:255',
        'image'     => 'image',
        'active'    => 'boolean',
    ];
}
