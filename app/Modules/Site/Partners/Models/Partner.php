<?php

namespace App\Modules\Site\Partners\Models;

use App\Models\PartnerBase;
use Illuminate\Database\Eloquent\Builder;

class Partner extends PartnerBase
{
    protected static function booted()
    {
        static::addGlobalScope('actived', function (Builder $builder) {
            $builder->actived()->orderPosition();
        });
    }
}
