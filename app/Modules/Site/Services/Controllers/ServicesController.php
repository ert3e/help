<?php

namespace App\Modules\Site\Services\Controllers;

use App\Http\Controllers\Site\SiteController;
use App\Modules\Site\Employees\Models\Employee;
use App\Modules\Site\Employees\Models\EmployeeService;
use App\Modules\Site\Services\Models\Service;

class ServicesController extends SiteController
{

    public function __construct()
    {
        parent::__construct();
        $this->bc->addCrumb(setting('services.meta_h1'), route('services'));
    }

    public function index()
    {
        $models = Service::orderPosition()
            ->paginate(setting('services.paginate_page'));

        return view('services.index', [
            'models' => $models,
        ]);
    }

    public function show($path)
    {
        $slug = $this->getSlugFromPath($path, Service::class);

        $model = Service::whereSlug($slug)->firstOrFail();

        $similar = Service::where('id', '!=', $model->id)->orderByRaw('RAND()')->take(4)->get();

        $this->generateBc($model, 'services.show');

        return view('services.show', [
            'model'     => $model,
            'similar'   => $similar,
        ]);
    }

}
