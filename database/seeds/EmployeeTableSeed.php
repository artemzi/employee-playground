<?php

use EmployeeDirectory\Entity\Employee;
use Illuminate\Database\Seeder;

class EmployeeTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    { // TODO seed with more data
        factory(Employee::class, 1)->create(
            [
                'title_id' => 1,
            ]
        )->each(function(Employee $employee) {
            $employee->children()->saveMany(factory(Employee::class, 5)->create(
                [
                    'title_id' => 2,
                ]
            )->each(function(Employee $employee) {
                $employee->children()->saveMany(factory(Employee::class, 10)->create(
                    [
                        'title_id' => 3,
                    ]
                )->each(function(Employee $employee) {
                    $employee->children()->saveMany(factory(Employee::class, 10)->create(
                        [
                            'title_id' => 4,
                        ]
                    )->each(function(Employee $employee) {
                        $employee->children()->saveMany(factory(Employee::class, 10)->create(
                            [
                                'title_id' => 5,
                            ]
                        )->each(function(Employee $employee) {
                            $employee->children()->saveMany(factory(Employee::class, 10)->create(
                                [
                                    'title_id' => 6,
                                ]
                            ));
                        }));
                    }));
                }));
            }));
        });
    }
}
