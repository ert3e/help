<?php

namespace App\Models\Traits;

use App\Models\RelationModels\Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager as ImageManagerClass;

trait ImageManager {

    /**
     * @var string картинка по умолчанию
     */
    protected static $defaultImage = '/images/default/default-image.jpg';

    /**
     * @var string водяной знак
     */
    protected static $watermarkImage = 'images/default/watermark.png';

    /**
     * @var \Intervention\Image\ImageManager
     */
    protected static $instance;

    final public static function getInstance()
    {
        return isset(static::$instance)
            ? static::$instance
            : static::$instance = new ImageManagerClass();
    }


    public function images()
    {
        return $this->morphMany('App\Models\RelationModels\Image', 'item')->orderBy('position', 'ASC');
    }


    public function itemImageFolder(): string
    {
        return 'storage/'.self::$mediaFolder.'/'.$this->id;
    }


    public function itemImageFolderSystem(): string
    {
        return 'public/'.self::$mediaFolder.'/'.$this->id;
    }


    public function uploadImage($file, $multiple = false) {

        $moduleItemFolder = $this->itemImageFolderSystem();

        // если модуль не поддерживает множество изображений - удаляем их
        if (!$multiple) {

            $moduleItemFolderReal = 'storage/'.$moduleItemFolder;

            foreach($this->images as $image) {
                $fullFilePath = $moduleItemFolderReal.'/'.$image->filename;

                if (file_exists($fullFilePath)) {
                    unlink($fullFilePath);
                }
            }

            $this->images()->delete();

        }

        $extension = $file->extension();

        $filename = uniqid().'.'.$extension;

        $image = new Image([
           'filename' => $filename,
           'position' => (Image::max('position') + 1),
        ]);

        $this->images()->save($image);

        \Storage::putFileAs($moduleItemFolder, $file, $filename);
    }


    public function uploadImagesBase64($images) {

        $moduleItemFolder = $this->itemImageFolderSystem();

        foreach ($images as $image) {
            $contents = file_get_contents($image);

            $mime = mime_content_type($image);

            $extension = mimeToExt($mime);

            if ($extension) {
                $filename = uniqid().'.'.$extension;

                $fullPath = $moduleItemFolder.'/'. $filename;

                $image = new Image([
                    'filename' => $filename,
                    'position' => (Image::max('position') + 1),
                ]);

                $this->images()->save($image);

                Storage::put($fullPath, $contents);
            }

        }

    }


    public function uploadAdditionalImage($file, $folder) {

        $moduleItemFolder = $this->itemImageFolderSystem().'/'.$folder;


        foreach (glob($this->itemImageFolder().'/'.$folder.'/*') as $image) {
            if (file_exists($image)) {
                unlink($image);
            }
        }

        $extension = $file->extension();

        $filename = uniqid().'.'.$extension;

        \Storage::putFileAs($moduleItemFolder, $file, $filename);
    }


    public function removeImage(Image $image) {

        $moduleItemFolder = $this->itemImageFolder();
        $moduleItemFolderSystem = $this->itemImageFolderSystem();

        $fullPathSystem = $moduleItemFolderSystem.'/'.$image->filename;

        foreach (glob($moduleItemFolder.'/resized/*/*') as $link) {
            $segments = explode('/', $link);
            $filename = end($segments);

            if ($filename == $image->filename) {
                unlink($link);
            }
        }

        \Storage::delete($fullPathSystem);

        $image->delete();
    }


    public function mainImage($width = false, $height = false, $watermark = false) {
        return $this->selectImage(0, $width, $height, $watermark);
    }

    public function selectImage($position = 0, $width = false, $height = false, $watermark = false) {

        $images = $this->images;
        $itemImageFolder = $this->itemImageFolder();

        if (count($images) > 0 && isset($images[$position])) {
            $mainImage = $itemImageFolder.'/'.$images[$position]->filename;
            if (file_exists($mainImage)) {

                if ($width) {
                    return $this->resize($images[$position], $width, $height, $watermark);
                }

                return $images[$position];
            }
        }


        return self::$defaultImage;
    }


    public function getImageUrl($image) {

        $itemImageFolder = $this->itemImageFolder();

        if ($image) {
            $imageUrl = $itemImageFolder.'/'.$image->filename;

            if (file_exists($imageUrl)) {
                return $imageUrl;
            }
        }

        return false;
    }


    public function getAdditionalImageUrl($folder, $width = false, $height = false) {

        $imagePath = $this->itemImageFolder().'/'.$folder;
        $imageUrl = self::$defaultImage;

        foreach (glob($imagePath.'/*') as $image) {
            if (file_exists($image)) {
                $imageUrl = '/'.$image;
            }
        }

        return $imageUrl;
    }


    public function resize($image, $width = false, $height = false, $watermark = false) {

        ini_set('memory_limit', '-1');

        if (!($image instanceof Image)) {
            return self::$defaultImage;
        }

        $manager = self::getInstance();

        // если не указана ширина - пытаемся найти в настройках сайта (конкретного модуля) админки
        if (!$width) {
            $className = lcfirst((new \ReflectionClass($this))->getShortName());

            $defaultWidth = setting($className.'.miniature');

            // если не находим настройки модуля - выставляем по умолчанию ширину
            $width = $defaultWidth ? $defaultWidth : 400;
        }

        // если высота не указана - выставляем по умолчанию высоту как и ширину
        if (!$height) {
            $height = $width;
        }

        // папка с изображением оригинала
        $itemImageFolder = $this->itemImageFolder();
        $originalFile = $itemImageFolder.'/'.$image->filename;

        // папка с изображением сжатого изображения
        $resizedFolder = $itemImageFolder.'/resized/'.$width.'x'.$height;
        $newFile = $resizedFolder.'/'.$image->filename;

        // если оригинала нет - возвращаем картинку по умолчанию
        if (!is_file($originalFile)) {
            return self::$defaultImage;
        }

        // если файл существует возвращаем его
        if (is_file($newFile)) {
            return '/'.$newFile;
        }

        // если папки нет сжимаемого файла нет - создаем
        if (!is_dir($resizedFolder)) {
            mkdir($resizedFolder, 0777, true);
        }

        // инициализируем оригинал фото и сжимаем в зависимости от параметров
        //if ($height == $width) {
            $image = $manager->make($originalFile)->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        /*} else {
            $image = $manager->make($originalFile)->resize($width, $height);
        }*/

        if ($watermark) {
            // в 5 раз уменьшаем водяной знак
            $watermarkSize = $width/5;
            // инициализируем и сжимаем водяной знак
            $watermark = $manager->make(self::$watermarkImage)->resize($watermarkSize, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            // наносим его на фотографию в правый нижний угол
            $image->insert($watermark, 'bottom-right', 30, 30);
        }

        // сохраняем новый файл и возвращаем к нему путь
        $image->save($newFile, setting('images.quality'));

        return '/'.$newFile;
    }

    // при удалении модели
    public static function bootImageManager()
    {
        self::deleting(function($model){

            // удаляем изображения с файловой системы
            \File::deleteDirectory(public_path('storage/'.self::$mediaFolder.'/'.$model->id));

            // и удаляем изображения с базы данных
            $model->images()->delete();
        });
    }

}
