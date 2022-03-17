<?php

use Illuminate\Support\Facades\Route;
Route::group(['middleware' => 'App\Http\Middleware\Check2FA', 'prefix' => 'profile'], function () {



Route::get('/', 'MainController@index')->name('profile.main');

Route::post('/sortable/{model}', 'MainController@sortable')->name('profile.sortable');


});
