<?php

Route::group(['prefix' => 'informations', 'middleware' => 'App\Http\Middleware\Privilege:informations'], function () {
    Route::get('/{parent_id?}', 'InformationsController@index')->name('admin.informations');
    Route::get('/{parent_id?}/add', 'InformationsController@add')->name('admin.informations.add');
    Route::post('/{parent_id?}/add/store', 'InformationsController@store')->name('admin.informations.store');
    Route::get('/{id}/edit', 'InformationsController@edit')->name('admin.informations.edit');
    Route::post('/{id}/edit/update', 'InformationsController@update')->name('admin.informations.update');
    Route::get('/{id}/delete', 'InformationsController@delete')->name('admin.informations.delete');

    Route::get('/{id}/edit/{image_id}/deleteImage', 'InformationsController@deleteImage')->name('admin.informations.edit.deleteImage');
    Route::post('/{id}/edit/sortableImages', 'InformationsController@sortableImages')->name('admin.informations.edit.sortableImages');
});
