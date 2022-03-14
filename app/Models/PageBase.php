<?php

namespace App\Models;

use App\Models\Traits\SeoManager;

class PageBase extends BaseModel
{
    use SeoManager;

    public $table = 'pages';

    public function getMorphClass()
    {
        return self::class;
    }
}
