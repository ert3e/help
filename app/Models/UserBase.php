<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserBase extends Authenticatable
{
    use HasApiTokens, Notifiable;
    // ID позиции обычного пользователя по умолчанию
    const USER = 1;

    // ID позиции главного администратора по умолчанию
    const ROOT = 2;

    public $table = 'users';

}
