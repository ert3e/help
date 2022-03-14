<?php

namespace App\Modules\Admin\Informations\Models;

use App\Models\InformationBase;

class Information extends InformationBase
{
    public $fillable = ['parent_id', 'title', 'slug', 'caption', 'description', 'active', 'position'];

    public static $validateRules = [
        'title'     => 'required',
        'active'    => 'boolean',
    ];


    public function uploadFile($file) {

        $itemFileFolder = 'storage/'.self::$mediaFolder.'/'.$this->id;

        $itemFileFolderSystem = 'public/'.self::$mediaFolder.'/'.$this->id;


        foreach (glob($itemFileFolder.'/*') as $oldFile) {
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }

        $extension = $file->extension();

        $filename = uniqid().'.'.$extension;

        \Storage::putFileAs($itemFileFolderSystem, $file, $filename);
    }

}
