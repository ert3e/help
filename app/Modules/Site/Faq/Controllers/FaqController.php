<?php

namespace App\Modules\Site\Faq\Controllers;

use App\Modules\Site\Faq\Models\Faq;
use App\Http\Controllers\Site\SiteController;

class FaqController extends SiteController
{

    public function __construct()
    {
        parent::__construct();
        $this->bc->addCrumb('Часто задаваемые вопросы');
    }

    public function index()
    {
        $models = Faq::orderPosition()
            ->get();

        return view('faq.index', [
            'models' => $models,
        ]);
    }

}
