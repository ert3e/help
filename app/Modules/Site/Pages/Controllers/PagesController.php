<?php

namespace App\Modules\Site\Pages\Controllers;

use App\Http\Controllers\Site\SiteController;
use App\Modules\Admin\Services\Models\Service;
use App\Modules\Site\Catalog\Models\Category;
use App\Modules\Site\Catalog\Models\Picking;
use App\Modules\Site\Main\Models\Payment;
use App\Modules\Site\News\Models\News;
use App\Modules\Site\Pages\Models\Page;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PagesController extends SiteController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function show($slug)
    {
        $model = Page::whereSlug($slug)->firstOrFail();

        $this->bc->addCrumb($model->title);

        return view('pages.show', [
            'model' => $model,
        ]);
    }

    public function search(Request $request) {

        $query = $request->get('q');

        if (!$query) {
            return redirect()->route('main');
        }

        $moduleTitle = 'Результаты поиска';
        $this->bc->addCrumb($moduleTitle);

        $moduleSettings = [
            'meta_title'        => $moduleTitle,
            'meta_description'  => '',
            'meta_keywords'     => '',
        ];

        $news = News::where(function($q) use ($query) {
            $q->where('title', 'LIKE', '%'.$query.'%')
                ->orWhere('description', 'LIKE', '%'.$query.'%');
        })->get();

        $pickings = Picking::where(function($q) use ($query) {
            $q->where('title', 'LIKE', '%'.$query.'%')
                ->orWhere('description', 'LIKE', '%'.$query.'%');
        })->get();

        $services = Service::where(function($q) use ($query) {
            $q->where('title', 'LIKE', '%'.$query.'%')
                ->orWhere('description', 'LIKE', '%'.$query.'%');
        })->get();


        return view('pages.search', [
            'news'              => $news,
            'pickings'          => $pickings,
            'services'          => $services,
            'moduleSettings'    => $moduleSettings,
        ]);
    }

    public function needHelp() {

        $moduleTitle = 'Мне нужна помощь';

        $this->bc->addCrumb($moduleTitle);

        $moduleSettings = [
            'meta_h1'           => $moduleTitle,
            'meta_title'        => $moduleTitle,
            'meta_description'  => '',
            'meta_keywords'     => '',
        ];

        return view('pages.needHelp', [
            'moduleSettings' => $moduleSettings
        ]);
    }

    public function wantHelp(Request $request) {

        $moduleTitle = 'Хочу помочь';

        $this->bc->addCrumb($moduleTitle);

        if ($request->isMethod('post')) {

            $this->validate($request, Payment::validateRules());

            if ($payment = Payment::createPay($request)) {
                return redirect()->to($payment['payment_url']);
            } else {
                return redirect()->back()->with('message_error', 'Произошла ошибка платежа... Попробуйте еще раз');
            }
        }

        $moduleSettings = [
            'meta_h1'           => $moduleTitle,
            'meta_title'        => $moduleTitle,
            'meta_description'  => '',
            'meta_keywords'     => '',
        ];

        $data = Payment::paymentTypes();

        if ($needHelp = Category::find(1)) {
            foreach (Picking::whereCategoryId(Category::TYPE_NEEDHELP)->get() as $picking) {
                $data['needHelp']['list'][$picking->id] = $picking->title;
            }
        }

        foreach (Service::all() as $service) {
            $data['services']['list'][$service->id] = $service->title;
        }

        $selected = [];

        if (isset($_GET['picking']) && $picking = Picking::find($_GET['picking'])) {
            $selected['type'] = 'needHelp';
            $selected['id'] = $picking->id;
        }

        if (isset($_GET['program']) && $program = Service::find($_GET['program'])) {
            $selected['type'] = 'services';
            $selected['id'] = $program->id;
        }

        return view('pages.wantHelp', [
            'moduleSettings'    => $moduleSettings,
            'data'              => $data,
            'selected'          => $selected,
        ]);


      
    }





    public function webapp (Request $request) {

        $moduleTitle = 'Хочу помочь';

        $this->bc->addCrumb($moduleTitle);

        if ($request->isMethod('post')) {

            $this->validate($request, Payment::validateRules());

            if ($payment = Payment::createPay($request)) {
                return redirect()->to($payment['payment_url']);
            } else {
                return redirect()->back()->with('message_error', 'Произошла ошибка платежа... Попробуйте еще раз');
            }
        }

        $moduleSettings = [
            'meta_h1'           => $moduleTitle,
            'meta_title'        => $moduleTitle,
            'meta_description'  => '',
            'meta_keywords'     => '',
        ];

        $data = Payment::paymentTypes();

        if ($needHelp = Category::find(1)) {
            foreach (Picking::whereCategoryId(Category::TYPE_NEEDHELP)->get() as $picking) {
                $data['needHelp']['list'][$picking->id] = $picking->title;
            }
        }

        foreach (Service::all() as $service) {
            $data['services']['list'][$service->id] = $service->title;
        }

        $selected = [];

        $pickings = Picking::whereCategoryId(Category::TYPE_NEEDHELP)
                    ->take(setting('pickings.paginate_main'))->get();

        $pickingsCompleted = Picking::whereCategoryId(Category::TYPE_HELPED)
            ->take(setting('pickings.paginate_main'))->get();

        if (isset($_GET['program']) && $program = Service::find($_GET['program'])) {
            $selected['type'] = 'services';
            $selected['id'] = $program->id;
        }

        return view('pages.webapp', [
            'moduleSettings'    => $moduleSettings,
            'data'              => $data,
            'selected'          => $selected,
            'pickings'          => $pickings,
            'pickingsCompleted' => $pickingsCompleted,
        ]);


      
    }




    public function accaunt (Request $request) {

        $moduleTitle = 'Хочу помочь';

        $this->bc->addCrumb($moduleTitle);

        if ($request->isMethod('post')) {

            $this->validate($request, Payment::validateRules());

            if ($payment = Payment::createPay($request)) {
                return redirect()->to($payment['payment_url']);
            } else {
                return redirect()->back()->with('message_error', 'Произошла ошибка платежа... Попробуйте еще раз');
            }
        }

        $moduleSettings = [
            'meta_h1'           => $moduleTitle,
            'meta_title'        => $moduleTitle,
            'meta_description'  => '',
            'meta_keywords'     => '',
        ];

        $data = Payment::paymentTypes();

        if ($needHelp = Category::find(1)) {
            foreach (Picking::whereCategoryId(Category::TYPE_NEEDHELP)->get() as $picking) {
                $data['needHelp']['list'][$picking->id] = $picking->title;
            }
        }

        foreach (Service::all() as $service) {
            $data['services']['list'][$service->id] = $service->title;
        }

        $selected = [];

        $pickings = Picking::whereCategoryId(Category::TYPE_NEEDHELP)
                    ->take(setting('pickings.paginate_main'))->get();

        $pickingsCompleted = Picking::whereCategoryId(Category::TYPE_HELPED)
            ->take(setting('pickings.paginate_main'))->get();

        if (isset($_GET['program']) && $program = Service::find($_GET['program'])) {
            $selected['type'] = 'services';
            $selected['id'] = $program->id;
        }

        return view('pages.accaunt', [
            'moduleSettings'    => $moduleSettings,
            'data'              => $data,
            'selected'          => $selected,
            'pickings'          => $pickings,
            'pickingsCompleted' => $pickingsCompleted,
        ]);


      
    }












    public function donation(Request $request) {

        $request['donation_type'] = Payment::TYPE_ZAKAT;

        if ($payment = Payment::createPay($request)) {
            return redirect()->to($payment['payment_url']);
        } else {
            return redirect()->back()->with('message_error', 'Произошла ошибка платежа... Попробуйте еще раз');
        }

    }

}
