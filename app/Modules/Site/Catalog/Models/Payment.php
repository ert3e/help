<?php

namespace App\Modules\Site\Catalog\Models;

use App\Models\PaymentBase;
use Illuminate\Database\Eloquent\Builder;

class Payment extends PaymentBase
{
    public $fillable = [''];

    protected static function booted()
    {
        static::addGlobalScope('paid', function (Builder $builder) {
            $builder->wherePaid(true);
        });
    }
}
