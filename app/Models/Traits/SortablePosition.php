<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait SortablePosition {

    public function scopeOrderPosition($query)
    {
        return $query->orderBy('position', 'DESC')
            ->orderBy('id', 'DESC');
    }

    public static function bootSortablePosition()
    {
        self::creating(function($model){
            $model->position = (get_called_class()::max('position') + 1);
        });
    }

}
