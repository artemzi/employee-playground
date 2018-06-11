<?php

use EmployeeDirectory\Entity\Employee;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(Employee::class, function (Faker $faker) {

    return [
        'full_name' => $faker->unique()->name,
        'image' => 'default.png',
        'title_id' =>  null,
        'parent_id' => null,
        'hire_date' => Carbon::now(),
        'salary' => $faker->numberBetween($min = 20000, $max = 150000),
    ];
});
