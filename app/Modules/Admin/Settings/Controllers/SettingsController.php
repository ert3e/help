<?php

namespace App\Modules\Admin\Settings\Controllers;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SettingsController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->bc->addCrumb(config('modules.types.Admin.Settings.title'));
    }

    public function index()
    {
        return view('settings.index');
    }

    public function save(Request $request)
    {

        $referer =  $request->headers->get('referer');

        if (stristr($referer, '/settings') !== FALSE) {

            $this->validate($request, [
                'settings.category.miniature'       => 'required|integer|min:10',
                'settings.product.miniature'        => 'required|integer|min:10',
                'settings.photos.miniature'         => 'required|integer|min:10',
                'settings.filemanager.miniature'    => 'required|integer|min:10',
                'settings.images.quality'           => 'required|integer|between:50,100',
                'settings.main.paginate'            => 'required|integer',
                'settings.contacts.email'           => 'required|email',
                'settings.contacts.email_alerts'    => 'required|email',
            ]);
        }

        if (isset($request['settings'])) {
            foreach($request['settings'] as $module => $attributes) {
                foreach($attributes as $attributeName => $value) {
                    $value = $value ?? '';

                    setting()->set($module.'.'.$attributeName, $value);
                    if ($attributeName == 'robots') {
                        File::put(public_path('robots.txt'), $value);
                    }
                }
            }

            setting()->save();

            if (isset($request['files'])) {
                foreach($request->file('files') as $module => $moduleFiles) {
                    foreach ($moduleFiles as $fileNameFolder => $moduleFile) {
                        $folderPath = 'public/files/'.$module.'/'.$fileNameFolder;
                        $files = Storage::allFiles($folderPath);
                        Storage::delete($files);

                        $extension = $moduleFile->extension();
                        $filename = 'file.'.$extension;

                        Storage::putFileAs($folderPath, $moduleFile, $filename);
                    }
                }
            }

        }




        return redirect()
            ->back()
            ->with('message_success', 'Настройки успешно сохранены');
    }

}
