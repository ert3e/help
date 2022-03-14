<?php

Route::group(['prefix' => 'employees', 'middleware' => 'App\Http\Middleware\Privilege:employees'], function () {
    Route::get('/', 'EmployeesController@index')->name('admin.employees');
    Route::get('/add', 'EmployeesController@add')->name('admin.employees.add');
    Route::post('/add/store', 'EmployeesController@store')->name('admin.employees.store');
    Route::get('/{id}', 'EmployeesController@edit')->name('admin.employees.edit');
    Route::post('/{id}/update', 'EmployeesController@update')->name('admin.employees.update');
    Route::get('/{id}/delete', 'EmployeesController@delete')->name('admin.employees.delete');
});
