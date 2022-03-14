<?php

Route::group(['prefix' => 'attributes', 'middleware' => 'App\Http\Middleware\Privilege:attributes'], function () {
    Route::get('/', 'AttributesController@index')->name('admin.attributes');
    Route::get('/add', 'AttributesController@add')->name('admin.attributes.add');
    Route::post('/add/store', 'AttributesController@store')->name('admin.attributes.store');
    Route::get('/{id}', 'AttributesController@edit')->name('admin.attributes.edit');
    Route::post('/{id}/update', 'AttributesController@update')->name('admin.attributes.update');
    Route::get('/{id}/delete', 'AttributesController@delete')->name('admin.attributes.delete');

    Route::get('/{id}/options', 'AttributesOptionsController@options')->name('admin.attributes.options');
    Route::post('/{id}/options/store', 'AttributesOptionsController@storeOption')->name('admin.attributes.options.store');
    Route::get('/{id}/options/{option_id}', 'AttributesOptionsController@editOption')->name('admin.attributes.options.edit');
    Route::post('/{id}/options/{option_id}/update', 'AttributesOptionsController@updateOption')->name('admin.attributes.options.update');
    Route::get('/{id}/options/{option_id}/delete', 'AttributesOptionsController@storeDelete')->name('admin.attributes.options.delete');

});
