<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;


Route::get('/profile', 'MainController@index')->name('profile.main');
Route::post('/profile/update', 'MainController@updateUser')->name('profile.update');
Route::post('/profile/avatar', 'MainController@uploadAvatar')->name('profile.avatar');

Route::post('/sortable/{model}', 'MainController@sortable')->name('profile.sortable');

Route::post('/upload', 'UserController@uplodAvatar');

