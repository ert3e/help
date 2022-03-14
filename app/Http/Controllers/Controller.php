<?php

namespace App\Http\Controllers;

use Creitive\Breadcrumbs\Breadcrumbs;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var array сгенерированные хлебные крошки по принципу поиска родителя
     */
    private $bcLinks = [];

    /**
     * Хлебные крошки
     * @var Breadcrumbs
     */
    protected $bc;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        // инициализируем хлебные крошки и по умолчанию добавляем главную страницу
        $this->bc = new Breadcrumbs();
        $this->bc->addCrumb('Главная', route('main'));

        // во все представления передаем хлебные крошки
        View::share('bc', $this->bc);
    }

    public function generateBc($model, $route, $connection = 'parent') {
        $parent = $model->{$connection}();

        if ($parent) {
            $this->addLink($model, $route);
        }

        $this->bcLinks = array_reverse($this->bcLinks, true);

        foreach ($this->bcLinks as $route => $title) {
            $this->bc->addCrumb($title, $route);
        }
    }

    private function addLink($model, $route) {

        $this->bcLinks[route($route, $model->id)] = $model->title ? $model->title : '#'.$model->id;

        if (isset($model->parent)) {
            $this->addLink($model->parent, $route);
        }
    }

}
