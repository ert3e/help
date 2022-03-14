<?php

Route::group(['prefix' => 'pages'], function () {
    Route::get('/integration', 'PagesController@integration')->name('integration');

    Route::get('/{slug}', 'PagesController@show')->name('pages');
});

// Дополнительные нестандартные страницы
Route::get('/search', 'PagesController@search')->name('search');
Route::get('/need-help', 'PagesController@needHelp')->name('need.help');
Route::match(['GET', 'POST'], '/want-help', 'PagesController@wantHelp')->name('want.help');
Route::post('/donation', 'PagesController@donation')->name('donation');
Route::get('/webapp', 'PagesController@webapp')->name('webapp');
Route::get('/accaunt', 'PagesController@accaunt')->name('accaunt');

