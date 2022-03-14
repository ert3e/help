<?php

Route::group(['prefix' => 'partners'], function () {
    Route::get('/', 'PartnersController@index')->name('partners');
});
