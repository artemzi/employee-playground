<?php

namespace EmployeeDirectory\Http\Controllers\Admin;

use EmployeeDirectory\Entity\Employee;
use EmployeeDirectory\Entity\Title;
use EmployeeDirectory\Http\Controllers\Controller;
use EmployeeDirectory\Http\Requests\Admin\Employees\CreateRequest;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return redirect()->route('home');
    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);

        return view('admin.employees.show', compact('employee'));
    }

    public function create()
    {
        $parents = Employee::defaultOrder()->withDepth()->get();
        $titles = Title::all();

        return view('admin.employees.add', compact('parents', 'titles'));
    }

    public function store(CreateRequest $request)
    {
        $employee = Employee::create([
            'full_name' => $request['full_name'],
            'title_id' => $request['title'],
            'hire_date' => $request['hire_date'],
            'salary' => (int) $request['salary'],
            'parent_id' => $request['parent']
        ]);

        return redirect()->route('employee.show', $employee->id);
    }

    public function edit(Employee $employee)
    {
        $parents = Employee::defaultOrder()->withDepth()->get();
        $titles = Title::all();

        return view('admin.employees.edit', compact('employee', 'parents', 'titles'));
    }

    public function update(CreateRequest $request, Employee $employee)
    {
        $employee->update([
            'full_name' => $request['full_name'],
            'title_id' => $request['title'],
            'hire_date' => $request['hire_date'],
            'salary' => (int) $request['salary'],
            'parent_id' => $request['parent']
        ]);

        return redirect()->route('employee.show', $employee->id);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('table');
    }
}
