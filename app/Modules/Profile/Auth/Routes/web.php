<?php

// Login Routes...
Route::get('login', 'LoginController@showLoginForm')->name('login');
Route::post('login', 'LoginController@login');

// Logout Routes...
Route::post('logout', 'LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'RegisterController@showRegistrationForm')->name('profile.register');
Route::post('register', 'RegisterController@register');

Route::get('2fa', 'TwoFAController@index')->name('2fa.index');
Route::post('2fa', 'TwoFAController@store')->name('2fa.post');
Route::get('2fa/reset', 'TwoFAController@resend')->name('2fa.resend');