<?php

namespace App\Models;

use App\Models\Traits\ImageManager;
use App\Models\Traits\SortablePosition;

class PartnerBase extends BaseModel
{
    use SortablePosition, ImageManager;

    public $table = 'partners';

    public static $mediaFolder = 'partners';

    public function getMorphClass()
    {
        return self::class;
    }
}
