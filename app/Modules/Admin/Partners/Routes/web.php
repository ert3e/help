<?php

Route::group(['prefix' => 'partners', 'middleware' => 'App\Http\Middleware\Privilege:partners'], function () {
    Route::get('/', 'PartnersController@index')->name('admin.partners');
    Route::get('/add', 'PartnersController@add')->name('admin.partners.add');
    Route::post('/add/store', 'PartnersController@store')->name('admin.partners.store');
    Route::get('/{id}', 'PartnersController@edit')->name('admin.partners.edit');
    Route::post('/{id}/update', 'PartnersController@update')->name('admin.partners.update');
    Route::get('/{id}/delete', 'PartnersController@delete')->name('admin.partners.delete');
});
