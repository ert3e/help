<?php

namespace App\Modules\Site\Partners\Controllers;

use App\Http\Controllers\Site\SiteController;
use App\Modules\Site\Partners\Models\Partner;

class PartnersController extends SiteController
{

    public function __construct()
    {
        parent::__construct();
        $this->bc->addCrumb(setting('partners.meta_h1'), route('partners'));
    }

    public function index()
    {
        $partners = Partner::all();

        return view('partners.index', [
            'partners'  => $partners,
        ]);
    }

}
