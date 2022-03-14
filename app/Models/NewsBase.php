<?php

namespace App\Models;

use App\Models\Traits\ImageManager;
use App\Models\Traits\SeoManager;
use App\Models\Traits\Sluggable;
use App\Models\Traits\SortablePosition;

class NewsBase extends BaseModel
{
    use ImageManager, SeoManager, SortablePosition, Sluggable;

    public $table = 'news';

    public static $mediaFolder = 'news';

    public function getMorphClass()
    {
        return self::class;
    }

}
