<?php

namespace App\Models\Traits;


use App\Models\ReviewBase;

trait Reviewing {

    public function reviews()
    {
        return $this->morphMany(ReviewBase::class, 'item');
    }

    // при удалении модели
    public static function bootReviewing()
    {
        self::deleting(function($model){
            // удаляем записи отзывов с базы данных
            $model->reviews()->delete();
        });
    }

}
