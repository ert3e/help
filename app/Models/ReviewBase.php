<?php

namespace App\Models;

use App\Models\Traits\ImageManager;
use Illuminate\Database\Eloquent\Model;

class ReviewBase extends BaseModel
{
    use ImageManager;

    public $table = 'reviews';

    public static $mediaFolder = 'reviews';

    public static $ratingList = [
        1 => 1,
        2,
        3,
        4,
        5,
    ];

    public function getMorphClass()
    {
        return self::class;
    }

    public function item()
    {
        return $this->morphTo();
    }

    public function updateRelation($model) {
        $this->update([
            'item_id' => $model->id,
            'item_type' => get_class($model),
        ]);
    }
}
