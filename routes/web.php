<?php

Route::group([
    'namespace' => 'Employee',
], function() {
    Route::get('/', 'EmployeeController@index')->name('home');
    Route::post('/tree', 'EmployeeController@tree')->name('tree');

    Route::get('/employees', 'DatatablesController@index');
    Route::get('/employees/data', 'DatatablesController@data')->name('datatables.data');
});
