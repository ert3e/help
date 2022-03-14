<?php

namespace App\Modules\Admin\Filemanager\Controllers;

use App\Http\Controllers\Admin\AdminController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;


class FilemanagerController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->bc->addCrumb(config('modules.types.Admin.Filemanager.title'));
    }

    public function index()
    {
        return view('filemanager.index');
    }

    public function files() {
        $files = glob('storage/files/*.{*}', GLOB_BRACE);

        usort($files, function ($a, $b) {
            return filemtime($a) - filemtime($b);
        });

        $files = array_reverse($files);

        $data = [];

        foreach ($files as $file) {

            $fileInfo = pathinfo($file);

            $data[$fileInfo['basename']] = [
                'path'          => $file,
                'extension'     => $fileInfo['extension'],
                'url'           => URL::to($file),
                'size'          => formatSizeUnits(File::size($file)),
                'date'          => Carbon::createFromTimestampUTC(filectime($file))->format('d.m.Y H:i'),
                'association'   => associationExt($file),
                'isImage'       => associationExt($file),
            ];

        }

        return $data;
    }

    public function store(Request $request)
    {

        if ($request->hasAny('images')) {

            $uploaded = 0;
            $countFiles = count($request->images);

            foreach ($request->images as $file) {
                $contents = file_get_contents($file);

                $mime = mime_content_type($file);

                $extension = mimeToExt($mime);

                if ($extension) {
                    $fullPath = 'public/files/' . rand(1111111, 9999999) .'.'. $extension;

                    if (Storage::put($fullPath, $contents)) {
                        $uploaded++;
                    }
                }

            }

            return redirect()
                ->back()
                ->with('message_success', 'Добавлено: '.$uploaded.' из '.$countFiles);
        }

        return redirect()
            ->back()
            ->with('message_error', 'Произошла ошибка');
    }

    public function delete(Request $request)
    {
        if ($request->hasAny('file_items')) {

            foreach ($request->file_items as $key => $fileName) {

                Storage::delete('public/files/'.$fileName);

                $resized = glob('storage/files/resized/*/'.$fileName, GLOB_BRACE);
                foreach($resized as $resize) {
                    unlink($resize);
                }

            }
        }
    }


}
