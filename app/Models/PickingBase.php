<?php

namespace App\Models;

use App\Models\Traits\ImageManager;
use App\Models\Traits\Payment;
use App\Models\Traits\SeoManager;
use App\Models\Traits\Sluggable;
use App\Models\Traits\SortablePosition;

class PickingBase extends BaseModel
{
    use SortablePosition, ImageManager, SeoManager, Sluggable, Payment;

    public $table = 'pickings';

    public $fillable = ['category_id'];

    public static $mediaFolder = 'pickings';

    public function getMorphClass()
    {
        return self::class;
    }

    public function category() {
        return $this->belongsTo(CategoryBase::class, 'category_id');
    }

    public function attributes() {
        return $this->hasMany(AttributePickingBase::class);
    }

    public function additionalCategories() {
        return $this->hasMany(CategoryBase::class);
    }

    public function attribute($alias, $default = '', $getParentName = false) {

        foreach($this->attributes()->where('value', '!=', '')->get() as $attr) {

            if (in_array($alias, [$attr->attribute_id, $attr->parent->alias])) {
                return $attr;
            }
        }

        return $default;
    }

    public function attributeById($attribute_id) {
        return AttributePickingBase::wherePickingId($this->id)
            ->whereAttributeId($attribute_id)
            ->first();
    }

    public function templateAttributesSeo() {
        return array_merge(SeoManager::defaultTemplateAttributesSeo(), [
            'price'     => 'подставит сумму сбора',
            'attr_ID'   => 'подставит атрибут с указанным ID. Вместо ID необходимо указать номер атрибута, который указан в списке атрибутов.',
        ]);
    }

    public static function boot()
    {
        parent::boot();

        self::deleting(function($model){

        });

        self::saving(function($model){
            if (isset($model->category)) {
                $model->path = $model->category->path.'/';
            } else {
                $model->path = '';
            }

            $model->path.= $model->slug;

        });
    }
}
