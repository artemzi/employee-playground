<?php


Auth::routes();

Route::group([
    'namespace' => 'Employee',
], function() {
    Route::get('/', 'HomeController@index')->name('home');

    Route::post('tree', 'HomeController@tree')->name('tree');
    Route::get('tree', 'HomeController@tree')->name('tree');
    Route::post('tree/move', 'HomeController@move');
});

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
], function() {
    Route::resource('employee', 'EmployeeController')->names([
        'create' => 'employees.create',
        'edit' => 'employees.edit',
        'update' => 'employees.update',
        'destroy' => 'employees.destroy'
    ]);

    Route::get('employees', 'DatatablesController@index')->name('table');
    Route::post('employees/data', 'DatatablesController@data')->name('datatables.data');
    Route::post('employees/image/{employee}', 'EmployeeController@updateImage')->name('image');

    Route::resource('titles', 'TitleController');
});

