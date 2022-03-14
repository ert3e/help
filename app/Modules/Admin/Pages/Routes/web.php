<?php

Route::group(['prefix' => 'pages', 'middleware' => 'App\Http\Middleware\Privilege:pages'], function () {
    Route::get('/', 'PagesController@index')->name('admin.pages');
    Route::get('/add', 'PagesController@add')->name('admin.pages.add');
    Route::post('/add/store', 'PagesController@store')->name('admin.pages.store');
    Route::get('/{id}', 'PagesController@edit')->name('admin.pages.edit');
    Route::post('/{id}/update', 'PagesController@update')->name('admin.pages.update');
    Route::get('/{id}/delete', 'PagesController@delete')->name('admin.pages.delete');
});
