<?php


Auth::routes();

Route::group([
    'namespace' => 'Employee',
], function() {
    Route::get('/', 'EmployeeController@index')->name('home');
    Route::post('/tree', 'EmployeeController@tree')->name('tree');

    Route::get('/employees', 'DatatablesController@index')->name('table');
    Route::post('/employees/data', 'DatatablesController@data')->name('datatables.data');
});

