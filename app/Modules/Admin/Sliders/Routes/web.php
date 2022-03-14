<?php

Route::group(['prefix' => 'sliders', 'middleware' => 'App\Http\Middleware\Privilege:sliders'], function () {
    Route::get('/{parent_id?}', 'SlidersController@index')->name('admin.sliders');
    Route::get('/{parent_id?}/add', 'SlidersController@add')->name('admin.sliders.add');
    Route::post('/{parent_id?}/add/store', 'SlidersController@store')->name('admin.sliders.store');
    Route::get('/{id}/edit', 'SlidersController@edit')->name('admin.sliders.edit');
    Route::post('/{id}/edit/update', 'SlidersController@update')->name('admin.sliders.update');
    Route::get('/{id}/delete', 'SlidersController@delete')->name('admin.sliders.delete');
});
