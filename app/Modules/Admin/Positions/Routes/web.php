<?php

Route::group(['prefix' => 'positions', 'middleware' => 'App\Http\Middleware\Privilege:positions'], function () {
    Route::get('/', 'PositionsController@index')->name('admin.positions');
    Route::get('/add', 'PositionsController@add')->name('admin.positions.add');
    Route::post('/add/store', 'PositionsController@store')->name('admin.positions.store');
    Route::get('/{id}', 'PositionsController@edit')->name('admin.positions.edit');
    Route::post('/{id}/update', 'PositionsController@update')->name('admin.positions.update');
    Route::get('/{id}/delete', 'PositionsController@delete')->name('admin.positions.delete');
});
