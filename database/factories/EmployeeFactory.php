<?php

use EmployeeDirectory\Entity\Employee;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(Employee::class, function (Faker $faker) {

    return [
        'full_name' => $faker->unique()->name,
        'title_id' =>  null,
        'parent_id' => null,
        'hire_date' => $faker->unixTime($max = 'now'),
        'salary' => $faker->numberBetween($min = 20000, $max = 150000),
    ];
});
