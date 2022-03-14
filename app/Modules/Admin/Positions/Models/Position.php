<?php

namespace App\Modules\Admin\Positions\Models;

use App\Models\PositionBase;

class Position extends PositionBase
{
    public $fillable = ['title'];

    public static $validateRules = [
        'title' => 'required'
    ];

    public function updatePrivileges(array $privileges) {
        foreach($privileges as $privilege => $value) {
            PositionPrivilege::create([
                'position_id'   => $this->id,
                'privilege_id'  => $privilege,
            ]);
        }
    }
}
