<?php

Route::group(['prefix' => 'feedback'], function () {
    Route::post('/default', 'FeedbackController@default')->name('feedback.default');
    Route::post('/help', 'FeedbackController@help')->name('feedback.help');
    Route::post('/volunteer', 'FeedbackController@volunteer')->name('feedback.volunteer');
});
