<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\View\FileViewFinder;

class SiteController extends Controller
{

    /**
     * Почта - отправитель уведомлений
     * @var string
     */
    public $emailSender;

    /**
     * Почта - для получения уведомлений
     * @var string
     */
    public $emailAlerts;

    /**
     * Название сайта
     * @var string
     */
    public $siteName;

    public function __construct()
    {
        parent::__construct();
        $this->bc->setDivider(null);
        $this->bc->setCssClasses('');
        $this->bc->setListItemCssClass('breadcrumbs__item');
        if (php_sapi_name() === 'cli' OR defined('STDIN')) {
            $this->emailSender = 'info@' . setting('contacts.email_alerts');
        } else {
            $this->emailSender = 'info@' . $_SERVER['SERVER_NAME'];
        }

        $this->emailAlerts = setting('contacts.email_alerts');

        $this->siteName = setting('main.title');

        if ((!\Auth::user() && !session()->get('cart')) || (\Auth::user() && session()->get('cart'))) {
            session(['cart' => []]);
        }

        $finder = new FileViewFinder(app()['files'], [resource_path().'/views/site']);
        View::setFinder($finder);
    }

    public function getSlugFromPath($path, $class = false) {
        $segments = explode('/', $path);

        if ($class) {
            foreach($segments as $segment) {
                if (!$class::whereSlug($segment)->exists()) {
                    abort(404);
                }
            }
        }

        if (count($segments) > 0) {
            return end($segments);
        }

        return;
    }
}
