<?php

namespace App\Models;

use App\Models\Traits\ImageManager;
use App\Models\Traits\SeoManager;
use App\Models\Traits\SortablePosition;

class CategoryBase extends BaseModel
{
    use SortablePosition, ImageManager, SeoManager;

    public $table = 'categories';

    public static $mediaFolder = 'categories';

    public function parent() {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function childs() {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function pickings() {
        return $this->hasMany('App\Models\PickingBase', 'category_id');
    }

    public function attributesCategories() {
        return $this->hasMany('App\Models\AttributeCategoryBase', 'category_id');
    }

    public function getMorphClass()
    {
        return self::class;
    }

    public function getChildIds(&$ids = []) {
        $ids[] = $this->id;

        if (count($this->childs) > 0) {
            foreach($this->childs as $category) {
                $ids = array_merge($ids, $category->getChildIds());
            }
        }

        return $ids;
    }

    public static function getParents($category, &$list = []) {
        $list[] = $category->id;

        if (isset($category->parent)) {
            self::getParents($category->parent, $list);
        }

        return $list;
    }

    public static function treeOfCategories($category = 0, $excluded = [], &$categories = [], $step = 1, $char = '–') {

        foreach(self::whereParentId($category)->orderPosition()->get() as $category) {

            if (!in_array($category->id, $excluded)) {
                $categories[$category->id] = str_repeat($char, $step).' '.$category->title;
            }

            if ($category->childs()) {
                self::treeOfCategories($category->id, $excluded, $categories, $step + 1, $char);
            }
        }

        return $categories;
    }

    public static function boot()
    {
        parent::boot();

        self::deleting(function($model){
            $model->attributesCategories()->delete();

            $model->pickings()->each(function($picking) {
                $picking->delete();
            });

            $model->childs()->each(function($category) {
                $category->delete();
            });
        });

        self::saving(function($model){

            if (isset($model->parent)) {
                $model->path = $model->parent->path.'/';
            } else {
                $model->path = '';
            }

            $model->path.= $model->slug;
        });

        self::saved(function($model) {
            // после сохранения категории, если у категории изменен slug или изменена родительская категория - обновляем данные

            if (($model->slug != $model->getOriginal('slug')) || ($model->parent_id != $model->getOriginal('parent_id'))) {
                // обновляем путь у всех дочерних категорий
                $model->childs()->each(function($category) {
                    $category->save();
                });

                // тоже самое делаем и с товарами
                $model->pickings()->each(function($picking) {
                    $picking->save();
                });
            }

        });
    }
}
