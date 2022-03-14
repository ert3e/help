<?php

Route::group(['prefix' => 'catalog', 'middleware' => 'App\Http\Middleware\Privilege:catalog'], function () {
    Route::get('/pickings', 'CategoriesController@pickings')->name('admin.catalog.pickings');

    Route::get('/{parent_id?}', 'CategoriesController@index')->name('admin.catalog');
    Route::get('/{parent_id?}/add/category', 'CategoriesController@add')->name('admin.catalog.add.category');
    Route::post('/{parent_id?}/store/category', 'CategoriesController@store')->name('admin.catalog.store.category');
    Route::get('/{id}/edit/category', 'CategoriesController@edit')->name('admin.catalog.edit.category');
    Route::post('/{id}/update/category', 'CategoriesController@update')->name('admin.catalog.update.category');
    Route::get('/{id}/delete/category', 'CategoriesController@delete')->name('admin.catalog.delete.category');

    Route::get('/{parent_id?}/add/picking', 'PickingsController@add')->name('admin.catalog.add.picking');
    Route::post('/{parent_id?}/store/picking', 'PickingsController@store')->name('admin.catalog.store.picking');
    Route::get('/{id}/edit/picking', 'PickingsController@edit')->name('admin.catalog.edit.picking');
    Route::post('/{id}/update/picking', 'PickingsController@update')->name('admin.catalog.update.picking');
    Route::get('/{id}/delete/picking', 'PickingsController@delete')->name('admin.catalog.delete.picking');

    Route::get('/{id}/edit/picking/{image_id}/deleteImage', 'PickingsController@deleteImage')->name('admin.catalog.edit.picking.deleteImage');
    Route::post('/{id}/edit/picking/sortableImages', 'PickingsController@sortableImages')->name('admin.catalog.edit.picking.sortableImages');
});
