<?php

Route::group(['prefix' => 'programs'], function () {
    Route::get('/', 'ServicesController@index')->name('services');
    Route::get('/{path}', 'ServicesController@show')->name('services.show')->where('path', '(.*)');
});
