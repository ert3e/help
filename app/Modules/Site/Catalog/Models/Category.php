<?php

namespace App\Modules\Site\Catalog\Models;

use App\Models\CategoryBase;
use Illuminate\Database\Eloquent\Builder;

class Category extends CategoryBase
{

    /**
     * ТИП КАТЕГОРИИ - ИМ НУЖНА ПОМОЩЬ
     */
    const TYPE_NEEDHELP = 1;

    /**
     * ТИП КАТЕГОРИИ - ИМ УЖЕ ПОМОГЛИ
     */
    const TYPE_HELPED = 2;

    protected static function booted()
    {
        static::addGlobalScope('actived', function (Builder $builder) {
            $builder->actived()->orderPosition();
        });
    }
}
