<?php

namespace App\Models;

use App\Models\Traits\ImageManager;
use App\Models\Traits\Payment;
use App\Models\Traits\SeoManager;
use App\Models\Traits\SortablePosition;

class ServiceBase extends BaseModel
{
    use SortablePosition, ImageManager, SeoManager, Payment;

    public $table = 'services';

    public static $mediaFolder = 'services';

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
            $model->childs()->each(function($service) {
                $service->delete();
            });
        });
    }
}
