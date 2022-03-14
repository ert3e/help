<?php

namespace App\Modules\Site\Services\Models;

use App\Models\ServiceBase;
use Illuminate\Database\Eloquent\Builder;

class Service extends ServiceBase
{
    protected static function booted()
    {
        static::addGlobalScope('actived', function (Builder $builder) {
            $builder->actived()->orderPosition();
        });
    }
}
