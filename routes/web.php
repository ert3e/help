<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Profile\Auth\Controllers\LoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// подключаем все роуты модулей админки
Route::group(['middleware' => 'App\Http\Middleware\Admin', 'prefix' => 'admin'], function () {
    $adminModules = config('modules.types.Admin');
    if ($adminModules) {
        foreach ($adminModules as $moduleName => $moduleSettings) {
            $routesFile = base_path('app/Modules/Admin/' . $moduleName . '/Routes/web.php');

            if (file_exists($routesFile)) {
                Route::namespace("\\App\\Modules\\Admin\\$moduleName\\Controllers")->group($routesFile);
            }
        }
    }

});


Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

// Logout Routes...
Route::post('logout', 'Model\Profile\LoginController@logout')->name('logout');
Route::group(['middleware' => ['web']], function () {
    $siteModules = config('modules.types.Site');
    if ($siteModules) {
        foreach ($siteModules as $moduleName => $moduleSettings) {
            $routesFile = base_path('app/Modules/Site/' . $moduleName . '/Routes/web.php');

            if (file_exists($routesFile)) {
                Route::namespace("\\App\\Modules\\Site\\$moduleName\\Controllers")->group($routesFile);
            }
        }
    }
});

// подключаем все роуты модулей сайта
Route::group(['middleware' => 'App\Http\Middleware\IsVerified'], function () {

    $siteModules = config('modules.types.Profile');
    if ($siteModules) {
        foreach ($siteModules as $moduleName => $moduleSettings) {
            $routesFile = base_path('app/Modules/Profile/' . $moduleName . '/Routes/web.php');

            if (file_exists($routesFile)) {
                Route::namespace("\\App\\Modules\\Profile\\$moduleName\\Controllers")->middleware('App\Http\Middleware\IsVerified')->group($routesFile);
            }
        }
    }
});


Route::get('/home', 'HomeController@index')->name('home');
