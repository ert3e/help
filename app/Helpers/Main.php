<?php

use Intervention\Image\ImageManager;
// сжимаем изображение, сохраняем и возвращаем путь
function resizeImage($filepath, $width, $height = false) {

    $height = !$height ? $width : $height;

    $manager = new ImageManager();

    list(, $module, $filename) = explode('/', $filepath);

    $folder = 'storage/'.$module.'/resized/'.$width.'x'.$height;
    $newFile = $folder.'/'.$filename;

    if (is_file($newFile)) {
        return $newFile;
    }

    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    $image = $manager->make($filepath)->resize($width, $height, function ($constraint) {
        $constraint->aspectRatio();
    })->save($newFile, setting('images.quality'));

    return $newFile;
}

function getImage($filePath) {
    $image = glob('storage/'.$filePath.'/*');

    if (isset($image[0])) {
        return '/'.$image[0];
    }

    return '/images/default/default-image.png';
}


function getFile($filePath, $linkText = false, $class = '') {
    $file = glob('storage/'.$filePath.'/*');

    if (isset($file[0])) {

        if ($linkText) {
            return '<a href="/'.$file[0].'" class="'.$class.'">'.$linkText.'</a>';
        }

        return '/'.$file[0];
    }

    return false;
}

// удаляем все символы с номера телефона
function formattedLinkTelephone($telephone) {
    $telephone = preg_replace('/[^\d]/', '', $telephone);

    return $telephone;
}

function formattedPrice($price) {
    $price = (int)str_replace(' ', '', trim($price));
    if (!$price) {
        $price = 0;
    }
    $price = number_format($price, '0', '', ' ');
    $price.= ' '.setting('catalog.currency');

    return $price;
}

// проверяет свойство объекта. Если есть - выводим
function issetValue($object, $value) {
    if ($object != null && isset($value) && $value != '')
        return $object->{$value};

    return null;
}

// перевод байты в кб/мб/гб
function formatSizeUnits($bytes)
{
    if ($bytes >= 1073741824)
    {
        $bytes = number_format($bytes / 1073741824, 2) . 'Гб,';
    }
    elseif ($bytes >= 1048576)
    {
        $bytes = number_format($bytes / 1048576, 2) . ' Мб';
    }
    elseif ($bytes >= 1024)
    {
        $bytes = number_format($bytes / 1024, 2) . ' Кб';
    }
    elseif ($bytes >= 1)
    {
        $bytes = $bytes . ' байт';
    }
    else
    {
        $bytes = '0 байт';
    }

    return $bytes;
}

// вывод обрезанного текста
function output($string, $limit = '0') {
    $text = strip_tags($string);

    if ($limit != 0) {
        $text = \Str::limit($text, $limit);
    }

    return $text;
}

// lcfirst в utf-8
function lcfirstUtf8($str)
{
    return mb_substr(mb_strtolower($str, 'utf-8'), 0, 1, 'utf-8') . mb_substr($str, 1, mb_strlen($str)-1, 'utf-8');
}

// генерация ссылок для фильтрации
function addGetParam(array $param = []) {
    return http_build_query(array_merge($_GET, $param));
}

function reverseOpposite($key, $value) {

    if (isset($_GET[$key]) && $_GET[$key] == $value) {
        $value = '-'.$value;
    }

    return $value;
}

function isGetSelected($key, $value) {

    if (isset($_GET[$key]) && in_array($_GET[$key], [$value, '-'.$value])) {
        return true;
    }

    return false;
}

function removedGetFilter($data, $category, $value = false) {
    if ($value) {
        unset($data['filter'][$category][$value]);
    } else {
        unset($data['filter'][$category]);
    }

    return $data;
}


class DateManager {

    public static $months = [
        '1' => 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
    ];

    public static function getDays() {
        $range = range(1, 31);

        return array_combine($range, $range);
    }

    public static function getMonths() {
        return self::$months;
    }

    public static function getFormattedMonths() {
        $formattedMonths = [];

        foreach (self::$months as $k => $month) {
            $formattedMonths[$k] = substr_replace($month, 'я', -1);
        }

        return $formattedMonths;
    }

    public static function getYears() {

        $range = array_reverse(range(1960, date('Y') - 4));

        return array_combine($range, $range);
    }
}

class StringManager {
    public static function formattedVideos(string $text): string {

        preg_match_all('/<iframe(.*?)src=("|\'|)(.*?)("|\'| )(.*?)><\/iframe>/s', $text, $iframes);

        foreach ($iframes[0] as $key => $iframe) {
            $url = $iframes[3][$key];
            $segments = explode('/', $url);
            $code = end($segments);

            $text = str_replace($iframe,
                '<div class="video-block video-preview">
                    <div class="video-block-player">
                        <img src="https://img.youtube.com/vi/'.$code.'/maxresdefault.jpg">
                        <div class="video-preview__play"></div>
                    </div>
                    <div class="video-block-frame" style="display: none;">
                        '.$iframe.'
                    </div>
                </div>',
                $text);
        }


        return $text;
    }
}
