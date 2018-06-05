<?php

Route::group([
    'namespace' => 'Employee',
], function() {
    Route::get('/', 'EmployeeController@index')->name('home');
});
