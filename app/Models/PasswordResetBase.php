<?php

namespace App\Models;

class PasswordResetBase extends BaseModel
{

    public $fillable = ['email', 'token', 'created_at'];

    public $table = 'password_resets';

    protected $primaryKey = 'email';

    const UPDATED_AT = null;

}
