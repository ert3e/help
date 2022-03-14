<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManager;

class BaseModel extends Model
{

    // TODO allow only for models with SortablePosition trait
    public $fillable = ['position'];

    public static $statuses = [
        0 => 'нет',
        1 => 'да',
    ];

    public function activeStatus() {
        return self::$statuses[$this->active];
    }

    public function createdDate($value = false) {
        if (!$value) {
            $value = $this->created_at;
        }

        return date('d.m.Y', strtotime($value));
    }

    public function createdTime($value = false) {
        if (!$value) {
            $value = $this->created_at;
        }

        return date('H:i', strtotime($value));
    }

    public function getCountInside($type = 'childs') {
        $count = $this->{$type}->count();

        if ($this->{$type}) {
            $this->recursiveIncrements($count, $this->childs, $type);
        }

        return $count;
    }

    public function recursiveIncrements(&$count, $relationModels, $type) {

        foreach ($relationModels as $relationModel) {
            $count+= $relationModel->{$type}->count();

            if ($relationModel->childs) {
                $this->recursiveIncrements($count, $relationModel->childs, $type);
            }
        }

        return $count;
    }

    protected function scopeActived($query)
    {
        return $query->where('active', 1);
    }

    protected function scopeApplySort($query)
    {
        if (isset($_GET['search'])) {
            foreach ($_GET['search'] as $attribute => $request) {
                if ($request == '') continue;

                if ($attribute == 'active') {
                    if (in_array($request, self::$statuses)) {
                        $request = array_search($request, self::$statuses);
                    }
                }

                $query->where($attribute, 'like', '%'.$request.'%');
            }
        }

        if (isset($_GET['sort'])) {
            foreach ($_GET['sort'] as $attribute => $type) {
                $query->orderBy($attribute, $type);
            }
        }

        return $query;
    }

}
