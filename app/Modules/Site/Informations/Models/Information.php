<?php

namespace App\Modules\Site\Informations\Models;

use App\Models\InformationBase;
use Illuminate\Database\Eloquent\Builder;

class Information extends InformationBase
{
    protected static function booted()
    {
        static::addGlobalScope('actived', function (Builder $builder) {
            $builder->actived()->orderPosition();
        });
    }
}
