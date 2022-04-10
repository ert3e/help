<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;


Route::get('/donation', 'DonationController@index')->name('donation.main');

Route::post('/sortable/{model}', 'MainController@sortable')->name('donation.sortable');


