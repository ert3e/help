<?php

Route::group(['prefix' => 'reports'], function () {
    Route::get('/{id?}', 'InformationsController@index')->name('informations');
});
