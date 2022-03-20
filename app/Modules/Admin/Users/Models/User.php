<?php

namespace App\Modules\Admin\Users\Models;

use App\Models\UserBase;
use App\Modules\Profile\Auth\Models\UserCode;
use CodersStudio\SmsRu\SmsRu;
use Ert3e\PhoneAuth\Casts\PhoneCast;
use Ert3e\PhoneAuth\Models\Traits\PhoneVerification;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends UserBase
{
    use PhoneVerification, HasApiTokens, Notifiable;

    public $fillable = [
        'name',
        'last_name',
        'telephone',
        'phone',
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
        'email'                 => 'max:60',
    ];

    protected $casts = [
        'phone_verified' => 'boolean',
        'phone_verified_at' => 'datetime',
        'phone' => PhoneCast::class
    ];

}
