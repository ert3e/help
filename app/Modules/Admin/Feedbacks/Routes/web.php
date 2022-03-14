<?php

Route::group(['prefix' => 'feedbacks', 'middleware' => 'App\Http\Middleware\Privilege:feedback'], function () {
    Route::get('/', 'FeedbacksController@index')->name('admin.feedbacks');
    Route::get('/{id}/delete', 'FeedbacksController@delete')->name('admin.feedbacks.delete');
});
