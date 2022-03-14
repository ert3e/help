<?php

namespace App\Models;

use App\Models\Traits\SortablePosition;

class AttributeBase extends BaseModel
{
    use SortablePosition;

    public $table = 'attributes';

    public $timestamps = false;

    /*
     * Index of text type
     * @const  TEXT
     */
    const TEXT = 0;

    /*
     * Index of textarea type
     * @const  TEXTAREA
     */
    const TEXTAREA = 1;

    /*
     * Index of select type
     * @const  SELECT
     */
    const SELECT = 2;

    /*
     * Index of checkbox type
     * @const  CHECKBOX
     */
    const CHECKBOX = 3;


    static $types = [
        self::TEXT      => 'Текстовый (Text)',
        self::TEXTAREA  => 'Полнотекстовый (Textarea)',
        self::SELECT    => 'Список выбора (Select)',
        self::CHECKBOX  => 'Галочка (CheckBox)',
    ];

    public function options() {
        return $this->hasMany('App\Models\AttributeOptionBase','attribute_id');
    }

    public function categories() {
        return $this->hasMany('App\Models\AttributeCategoryBase', 'attribute_id');
    }

    public function categoriesToArray() {
        return $this->categories()->pluck('category_id')->toArray();
    }

    public function getType() {
        return self::$types[$this->type];
    }

    public function isSelect() {
        return $this->type == self::SELECT;
    }

    public function getOptionsList() {
        $optionsList = ['0' => '-'];

        foreach($this->options as $option) {
            $optionsList[$option['id']] = $option['title'];
        }

        return $optionsList;
    }

}
