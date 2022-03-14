<?php

Route::group(['prefix' => 'settings', 'middleware' => 'App\Http\Middleware\Privilege:settings'], function () {
    Route::get('/', 'SettingsController@index')->name('admin.settings');
    Route::post('/save', 'SettingsController@save')->name('admin.settings.save');
});
