<?php

use App\Modules\Admin\Positions\Models\Privilege;
use Illuminate\Database\Seeder;

class PrivilegesSeeder extends Seeder
{

    public static $privileges = [
        'catalog'       => 'Каталог',
        'news'          => 'Новости',
        'pages'         => 'Статические страницы',
        'slides'        => 'Слайды',
        'filemanager'   => 'Файловый менеджер',
        'settings'      => 'Настройки сайта',
        'positions'     => 'Управление должностями',
        'reviews'       => 'Отзывы',
    ];


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(self::$privileges as $module => $title) {
            Privilege::create([
                'title'     => $title,
                'module'    => $module,
            ]);
        }
    }
}
