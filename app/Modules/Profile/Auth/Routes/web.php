<?php

// Login Routes...
Route::get('login', 'LoginController@showLoginForm')->name('login');
Route::post('login', 'LoginController@login');

// Logout Routes...
Route::get('logout', 'LoginController@logout')->name('logout');

