<?php

namespace App\Models;

use App\Models\Traits\SortablePosition;

class FaqBase extends BaseModel
{
    use SortablePosition;

    public $table = 'faq';
}
