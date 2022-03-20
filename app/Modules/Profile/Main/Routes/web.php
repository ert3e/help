<?php

use Illuminate\Support\Facades\Route;



Route::get('/profile', 'MainController@index')->name('profile.main');

Route::post('/sortable/{model}', 'MainController@sortable')->name('profile.sortable');


