<?php

namespace App\Modules\Admin\Catalog\Controllers;


use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\View;

class CatalogController extends AdminController
{

    protected $moduleItems;

    public function __construct()
    {
        parent::__construct();
        $this->bc->addCrumb(config('modules.types.Admin.Catalog.title'), route('admin.catalog'));

        $this->moduleItems = config('modules.types.Admin.Catalog.items');
        View::share('moduleItems', $this->moduleItems);
    }

}
