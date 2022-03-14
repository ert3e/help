<?php

namespace App\Modules\Site\News\Models;

use App\Models\NewsBase;
use Illuminate\Database\Eloquent\Builder;

class News extends NewsBase
{


    protected static function booted()
    {
        static::addGlobalScope('actived', function (Builder $builder) {
            $builder->actived()->orderPosition();
        });
    }
}
