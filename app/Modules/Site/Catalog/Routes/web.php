<?php

Route::group(['prefix' => 'pickings'], function () {
    Route::match(['GET', 'POST'], '/{path?}', ['as' => 'catalog', 'uses' => 'CatalogController@show'])
        ->where('path', '(.*)');
});
