<?php

namespace App\Modules\Site\Catalog\Controllers;

use App\Http\Controllers\Site\SiteController;
use App\Modules\Site\Catalog\Controllers\Traits\ActionsTrait;
use App\Modules\Site\Catalog\Models\Category;
use App\Modules\Site\Catalog\Models\Picking;
use Illuminate\Http\Request;

class CatalogController extends SiteController
{
    use ActionsTrait;

    /**
     * Список сборов в открытой категории
     */
    private $pickings = [];

    /**
     * Открытый сбор
     */
    private $picking = false;

    /**
     * Открытая категория
     */
    private $category = false;

    /**
     * Список категорий в открытой категории
     */
    private $categories = [];

    /**
     * Список главных категорий
     */
    private $mainCategories = false;

    /**
     * Поисковой запрос в каталоге
     */
    private $searchQuery = false;


    public function __construct()
    {
        parent::__construct();
        //$this->bc->addCrumb('Каталог', route('catalog'));
    }

    public function show(Request $request, $path = '') {

        $this->mainCategories = Category::whereParentId(0)->get();
        $this->pickings = Picking::where('price', '>', 0);

        if ($path != '') {

            if ($this->picking = Picking::wherePath($path)->first()) {
                return $this->showPicking();
            }

            $this->category = Category::wherePath($path)->firstOrFail();

            $this->generateBreadcrumbs($this->category->path);

            $this->pickings = $this->pickings
                ->where(function($q) {
                    $q->whereIn('category_id', $this->category->getChildIds())/*
                        ->orWhereHas('additionalCategories', function ($query) {
                            $query->where('category_id', $this->category->id);
                        })*/;
                });

            $this->categories = Category::whereParentId($this->category->id)->get();

        } else {

            /*$this->categories = $this->mainCategories;

            if (isset($_GET['search']) && $_GET['search'] != '') {
                $this->searchQuery = htmlspecialchars(trim($_GET['search']));

                if ($category = Category::whereTitle($this->searchQuery)->first()) {
                    return redirect()->route('catalog', $category->path);
                }

                $this->catalogSearchAction();
            }*/

            return redirect()->route('main');
        }

        $this->pickings = $this->pickings->paginate(setting('catalog.paginate_page'))
            ->appends($request->except('page'));


        return view('catalog.index', [
            'category'          => $this->category,
            'categories'        => $this->categories,
            'pickings'          => $this->pickings,
            'mainCategories'    => $this->mainCategories,
        ]);
    }

    public function showPicking() {

        if ($this->picking->category) {
            $this->generateBreadcrumbs($this->picking->category->path);
        }

        $this->bc->addCrumb($this->picking->title);

        $similar = Picking::whereCategoryId(1)
            ->where('id', '!=', $this->picking->id)
            ->orderByRaw('RAND()')
            ->take(6)
            ->get();

        return view('catalog.picking', [
            'picking'   => $this->picking,
            'similar'   => $similar,
        ]);
    }

    public function generateBreadcrumbs($path) {

        $segments = explode('/', $path);

        foreach($segments as $slug) {
            if ($category = Category::whereSlug($slug)->first()) {
                $this->bc->addCrumb($category->title, route('catalog', $category->path));
            }
        }

    }

}
