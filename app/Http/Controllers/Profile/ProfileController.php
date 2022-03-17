<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\View\FileViewFinder;

class ProfileController extends Controller
{

    /**
    * @const Событие возврата
    */
    const ROUTE_BACK = 'exit';

    public function __construct()
    {
        parent::__construct();

        $finder = new FileViewFinder(app()['files'], [resource_path().'/views/profile']);
        View::setFinder($finder);
    }

    public static function redirect($action, $route, $params, $message = false) {

        if ($action != self::ROUTE_BACK) {
            $redirectUrl = redirect()
                ->back()
                ->with('message_success', $message);
        } else {
            $redirectUrl = redirect()
                ->route($route, $params)
                ->with('message_success', $message);
        }

        return $redirectUrl;
    }

}
