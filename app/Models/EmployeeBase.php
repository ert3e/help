<?php

namespace App\Models;

use App\Models\Traits\ImageManager;
use App\Models\Traits\SeoManager;
use App\Models\Traits\SortablePosition;

class EmployeeBase extends BaseModel
{
    use SortablePosition, ImageManager, SeoManager;

    public $table = 'employees';

    public static $mediaFolder = 'employees';

    public function services() {
        return $this->hasMany(EmployeeServiceBase::class, 'employee_id');
    }

    public function getMorphClass()
    {
        return self::class;
    }

}
