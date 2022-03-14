<?php

Route::group(['prefix' => 'users', 'middleware' => 'App\Http\Middleware\Privilege:users'], function () {
    Route::get('/', 'UsersController@index')->name('admin.users');
    Route::get('/add', 'UsersController@add')->name('admin.users.add');
    Route::post('/add/store', 'UsersController@store')->name('admin.users.store');
    Route::get('/{id}', 'UsersController@edit')->name('admin.users.edit');
    Route::post('/{id}/update', 'UsersController@update')->name('admin.users.update');
    Route::get('/{id}/delete', 'UsersController@delete')->name('admin.users.delete');
});
