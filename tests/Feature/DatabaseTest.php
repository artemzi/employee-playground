<?php

namespace Tests\Feature;

use Carbon\Carbon;
use EmployeeDirectory\Entity\Employee;
use EmployeeDirectory\Entity\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class DatabaseTest extends TestCase
{
    use DatabaseMigrations;

    protected $employee;

    protected function setUp()
    {
        parent::setUp();
        $this->actingAs(factory(User::class)->create());
        $this->employee = factory(Employee::class)->create();
    }

    /**
     * @test
     */
    public function canStoreEmployee()
    {
        $employee = factory(Employee::class)->create([
            'full_name' => 'Mike Doe',
            'title_id' => 1,
            'salary' => 150000,
            'image' => 'default.png',
            'load_on_demand' => 1
        ]);

        $this->post('/employee/create', $employee->toArray());
        $this->assertDatabaseHas(
            'employees',
            [
                'full_name' => 'Mike Doe',
                'title_id' => 1,
                'salary' => 150000,
                'image' => 'default.png',
                'load_on_demand' => 1
            ]
        );
    }

    /**
     * @test
     */
    public function canUpdateEmployee()
    {
        $this->employee->update([
            'salary' => 10
        ]);

        $this->assertDatabaseHas(
            'employees',
            [
                'id' => $this->employee->id,
                'salary' => 10
            ]
        );
    }

    /**
     * @test
     */
    public function employeeWasCreated(): void
    {
        $this->assertDatabaseHas('employees', [
            'id' => $this->employee->id,
            'full_name' => $this->employee->full_name,
            'salary' => $this->employee->salary,
            'load_on_demand' => $this->employee->load_on_demand,
            'parent_id' => $this->employee->parent_id,
            'hire_date' => Carbon::parse($this->employee->hire_date)->toDateTimeString(),
            'image' => $this->employee->image,
            '_lft' => $this->employee->_lft,
            '_rgt' => $this->employee->_rgt
        ]);
    }
}
