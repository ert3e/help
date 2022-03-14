<?php

namespace App\Modules\Admin\Sliders\Models;

use App\Models\SliderBase;

class Slider extends SliderBase
{
    public $fillable = ['parent_id', 'product_id', 'title', 'alias', 'description', 'url', 'youtube_url', 'button_text', 'active', 'position'];

    public static $validateRules = [
        'slider_id'             => 'integer',
        'title'                 => 'max:255',
        'description'           => 'max:1000',
        'button_text'           => 'max:40',
        'url'                   => 'max:400',
        'active'                => 'boolean',
        'image'                 => 'required_unless:parent_id,0|image',
    ];
}
