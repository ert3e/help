<?php

namespace App\Modules\Site\Feedbacks\Models;

use App\Models\FeedbackBase;
use Illuminate\Support\Facades\Storage;

class Feedback extends FeedbackBase
{

    public $fillable = ['name', 'telephone', 'email', 'description', 'info', 'type'];


    public function uploadFile($file) {
        $itemFileFolder = 'public/feedbacks/'.$this->id;

        $files = Storage::allFiles($itemFileFolder);
        Storage::delete($files);

        $extension = $file->extension();
        $filename = uniqid().'.'.$extension;
        \Storage::putFileAs($itemFileFolder, $file, $filename);
    }

}
