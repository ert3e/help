<?php

namespace App\Modules\Admin\Services\Models;

use App\Models\ServiceBase;

class Service extends ServiceBase
{
    public $fillable = ['parent_id', 'title', 'slug', 'caption', 'description', 'price', 'price_to', 'active', 'position'];

    public static $validateRules = [
        'title'     => 'required',
        'active'    => 'boolean',
        'price'     => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
        'price_to'  => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
    ];

    public function getImagesComponent($size = 200) {
        $data = [];

        foreach($this->images as $image) {
            $data[] = [
                'key'           => $image['id'],
                'url'           => $this->resize($image, $size),
                'routeDelete'   => route('admin.services.edit.deleteImage', [$this->id, $image->id]),
            ];
        }

        return json_encode($data);
    }
}
