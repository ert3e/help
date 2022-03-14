<?php

namespace App\Modules\Site\Informations\Controllers;

use App\Http\Controllers\Site\SiteController;
use App\Modules\Site\Informations\Models\Information;

class InformationsController extends SiteController
{

    public function __construct()
    {
        parent::__construct();
        $this->bc->addCrumb(setting('informations.meta_h1'), route('informations'));
    }

    public function index($parentId = 0)
    {
        $categories = Information::whereCaption('reports')->firstOrFail()->childs;

        if ($parentId == 0) {
            $selectedCategory = $categories->first();
        } else {
            $selectedCategory = Information::whereId($parentId)->first();
        }

        $informations = Information::whereParentId($selectedCategory->id)->paginate(setting('informations.paginate_page'));

        return view('informations.index', [
            'categories'        => $categories,
            'selectedCategory'  => $selectedCategory,
            'informations'      => $informations,
        ]);
    }

}
