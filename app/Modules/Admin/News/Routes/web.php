<?php

Route::group(['prefix' => 'news', 'middleware' => 'App\Http\Middleware\Privilege:news'], function () {
    Route::get('/', 'NewsController@index')->name('admin.news');
    Route::get('/add', 'NewsController@add')->name('admin.news.add');
    Route::post('/add/store', 'NewsController@store')->name('admin.news.store');
    Route::get('/{id}', 'NewsController@edit')->name('admin.news.edit');
    Route::post('/{id}/update', 'NewsController@update')->name('admin.news.update');
    Route::get('/{id}/delete', 'NewsController@delete')->name('admin.news.delete');
});
