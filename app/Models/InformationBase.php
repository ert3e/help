<?php

namespace App\Models;

use App\Models\Traits\ImageManager;
use App\Models\Traits\SortablePosition;

class InformationBase extends BaseModel
{
    use SortablePosition, ImageManager;

    public $table = 'informations';

    public static $mediaFolder = 'informations';

    public function getMorphClass()
    {
        return self::class;
    }

    public function parent() {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function childs() {
        return $this->hasMany(self::class, 'parent_id')->orderPosition();
    }

    public function generateUrl($url = '') {

        if ($this->parent) {
            $url.= $this->parent->generateUrl().'/';
        }

        $url.= $this->slug;

        return $url;
    }

    public static function boot()
    {
        parent::boot();

        self::deleting(function($model){
            $model->childs()->each(function($information) {
                $information->delete();
            });
        });
    }
}
