<?php

Route::group(['prefix' => 'services', 'middleware' => 'App\Http\Middleware\Privilege:services'], function () {
    Route::get('/{parent_id?}', 'ServicesController@index')->name('admin.services');
    Route::get('/{parent_id?}/add', 'ServicesController@add')->name('admin.services.add');
    Route::post('/{parent_id?}/add/store', 'ServicesController@store')->name('admin.services.store');
    Route::get('/{id}/edit', 'ServicesController@edit')->name('admin.services.edit');
    Route::post('/{id}/edit/update', 'ServicesController@update')->name('admin.services.update');
    Route::get('/{id}/delete', 'ServicesController@delete')->name('admin.services.delete');

    Route::get('/{id}/edit/{image_id}/deleteImage', 'ServicesController@deleteImage')->name('admin.services.edit.deleteImage');
    Route::post('/{id}/edit/sortableImages', 'ServicesController@sortableImages')->name('admin.services.edit.sortableImages');
});
