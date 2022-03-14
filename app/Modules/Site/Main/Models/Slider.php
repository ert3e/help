<?php

namespace App\Modules\Site\Main\Models;

use App\Models\SliderBase;
use App\Modules\Site\Catalog\Models\Picking;

class Slider extends SliderBase
{

    public function childs()
    {
        return $this->hasMany(self::class, 'parent_id')->orderPosition()->actived();
    }


    public function getConvertYoutubeUrl() {
        return preg_replace(
            "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
            "//www.youtube.com/embed/$2",
            $this->youtube_url
        );
    }

}
