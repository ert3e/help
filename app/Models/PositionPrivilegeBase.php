<?php

namespace App\Models;

class PositionPrivilegeBase extends BaseModel
{
    public $table = 'positions_privileges';

    public $fillable = ['position_id', 'privilege_id'];

    public $timestamps = false;
}
