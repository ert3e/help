<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;


class UserBase extends Authenticatable
{
    // ID позиции обычного пользователя по умолчанию
    const USER = 1;

    // ID позиции главного администратора по умолчанию
    const ROOT = 2;

    public $table = 'users';

}
