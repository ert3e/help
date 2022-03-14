<?php

namespace App\Modules\Admin\Attributes\Models;

use App\Models\AttributeBase;

class Attribute extends AttributeBase
{
    public $fillable = ['title', 'postfix', 'type', 'alias', 'position', 'category_id'];

    public static $validateRules = [
        'title'         => 'required|max:40',
        'alias'         => 'max:20',
        'type'          => 'integer',
    ];

    public function updateCategories($request) {
        $this->categories()->delete();

        if ($request->has('categories')) {
            foreach ($request->categories as $category) {
                AttributeCategory::create([
                    'category_id'   => $category,
                    'attribute_id'  => $this->id,
                ]);
            }
        }
    }
}
