<?php

Route::group(['prefix' => 'ymlgenerator', 'middleware' => 'App\Http\Middleware\Privilege:generate'], function () {
    Route::get('/', 'YmlgeneratorController@index')->name('admin.ymlgenerator');
    Route::get('/generate', 'YmlgeneratorController@generate')->name('admin.ymlgenerator.generate');
});
