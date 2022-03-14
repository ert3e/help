<?php

Route::group(['prefix' => 'filemanager', 'middleware' => 'App\Http\Middleware\Privilege:filemanager'], function () {
    Route::get('/', 'FilemanagerController@index')->name('admin.filemanager');
    Route::post('/add', 'FilemanagerController@store')->name('admin.filemanager.store');
    Route::post('/delete', 'FilemanagerController@delete')->name('admin.filemanager.delete');

    Route::get('/files', 'FilemanagerController@files')->name('admin.filemanager.files');
});
