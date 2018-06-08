<?php


Auth::routes();

Route::group([
    'namespace' => 'Employee',
], function() {
    Route::get('/', 'EmployeeController@index')->name('home');
    Route::resource('employee', 'EmployeeController')->except([
        'index'
    ]);

    Route::post('tree', 'EmployeeController@tree')->name('tree');
});

Route::group([
    'namespace' => 'Admin',
], function() {
    Route::get('employees', 'DatatablesController@index')->name('table');
    Route::post('employees/data', 'DatatablesController@data')->name('datatables.data');
});

