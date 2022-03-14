<?php

Route::group(['prefix' => 'faq'], function () {
    Route::get('/', 'FaqController@index')->name('faq');
});
