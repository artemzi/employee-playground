<?php


Auth::routes();

Route::group([
    'namespace' => 'Employee',
], function() {
    Route::get('/', 'HomeController@index')->name('home');

    Route::post('tree', 'HomeController@tree')->name('tree');
});

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
], function() {
    Route::resource('employee', 'EmployeeController')->names([
        'create' => 'employees.create',
        'edit' => 'employees.edit',
        'update' => 'employees.update',
        'destroy' => 'employees.destroy',
    ]);

    Route::get('employees', 'DatatablesController@index')->name('table');
    Route::post('employees/data', 'DatatablesController@data')->name('datatables.data');
});

