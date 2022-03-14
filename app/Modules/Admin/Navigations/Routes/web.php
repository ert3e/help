<?php

Route::group(['prefix' => 'navigations', 'middleware' => 'App\Http\Middleware\Privilege:navigations'], function () {
    Route::get('/{parent_id?}', 'NavigationsController@index')->name('admin.navigations');
    Route::get('/{parent_id?}/add', 'NavigationsController@add')->name('admin.navigations.add');
    Route::post('/{parent_id?}/add/store', 'NavigationsController@store')->name('admin.navigations.store');
    Route::get('/{id}/edit', 'NavigationsController@edit')->name('admin.navigations.edit');
    Route::post('/{id}/edit/update', 'NavigationsController@update')->name('admin.navigations.update');
    Route::get('/{id}/delete', 'NavigationsController@delete')->name('admin.navigations.delete');
});
