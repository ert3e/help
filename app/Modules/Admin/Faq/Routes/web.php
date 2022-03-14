<?php

Route::group(['prefix' => 'faq', 'middleware' => 'App\Http\Middleware\Privilege:faq'], function () {
    Route::get('/', 'FaqController@index')->name('admin.faq');
    Route::get('/add', 'FaqController@add')->name('admin.faq.add');
    Route::post('/add/store', 'FaqController@store')->name('admin.faq.store');
    Route::get('/{id}', 'FaqController@edit')->name('admin.faq.edit');
    Route::post('/{id}/update', 'FaqController@update')->name('admin.faq.update');
    Route::get('/{id}/delete', 'FaqController@delete')->name('admin.faq.delete');
});
