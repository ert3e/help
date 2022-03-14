<?php

namespace App\Models;

use App\Modules\Admin\Positions\Models\PositionPrivilege;

class PositionBase extends BaseModel
{
    public $table = 'positions';

    public $timestamps = false;

    public function privileges() {
        return $this->hasMany('App\Models\PositionPrivilegeBase', 'position_id', 'id');
    }

    public function hasPrivilege(PrivilegeBase $privilege) {
        return PositionPrivilege::wherePositionId($this->id)
            ->wherePrivilegeId($privilege->id)
            ->exists();
    }

    public static function boot()
    {
        parent::boot();

        self::deleting(function($model){
            $model->privileges()->delete();
        });
    }
}
