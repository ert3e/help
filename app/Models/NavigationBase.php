<?php

namespace App\Models;

use App\Models\Traits\SortablePosition;
use App\Modules\Admin\Navigations\Models\Navigation;

class NavigationBase extends BaseModel
{
    use SortablePosition;

    public $table = 'navigations';

    public $timestamps = false;

    public function parent() {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function childs() {
        return $this->hasMany(self::class, 'parent_id')->orderPosition();
    }

    public static function getLinksByAlias($alias) {
        $navigation = self::whereAlias($alias)->first();

        if ($navigation) {
            return $navigation->childs;
        }

        return [];
    }

    public static function boot()
    {
        parent::boot();

        self::deleting(function($model){
            $model->childs()->each(function($navigation) {
                $navigation->delete();
            });
        });
    }
}
