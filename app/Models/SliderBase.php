<?php

namespace App\Models;

use App\Models\Traits\ImageManager;
use App\Models\Traits\SortablePosition;

class SliderBase extends BaseModel
{
    use ImageManager, SortablePosition;

    public $table = 'sliders';

    public static $mediaFolder = 'sliders';

    public function parent() {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function childs() {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function picking() {
        return $this->belongsTo(PickingBase::class, 'picking_id');
    }

    public function getMorphClass()
    {
        return self::class;
    }
}
