<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'MainController@index')->name('main');

Route::get('/sitemap', 'SitemapController@generate')->name('sitemap');

Route::match(['GET', 'POST'], '/payments/update', 'PaymentsController@update')->name('payments.update');
