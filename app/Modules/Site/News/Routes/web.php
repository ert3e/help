<?php

Route::group(['prefix' => 'news'], function () {
    Route::get('/', 'NewsController@index')->name('news');
    Route::get('/{slug}', 'NewsController@show')->name('news.show')->where('path', '(.*)');
});
