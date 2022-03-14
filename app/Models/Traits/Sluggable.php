<?php

namespace App\Models\Traits;

trait Sluggable {

    public static function bootSluggable()
    {
        self::created(function($model){
            $model->save();
        });

        self::saving(function($model){
            if ($model->exists) {
                $model->slug = $model->id . '_' . getSlug($model->slug);
            }
        });

    }

}
