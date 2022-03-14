<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'MainController@index')->name('admin.main');

Route::match(['get', 'post'], '/auth', 'MainController@auth')->name('admin.auth');

Route::post('/sortable/{model}', 'MainController@sortable')->name('admin.sortable');


