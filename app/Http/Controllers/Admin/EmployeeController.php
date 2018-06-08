<?php

namespace EmployeeDirectory\Http\Controllers\Admin;

use EmployeeDirectory\Entity\Employee;
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
        return view('admin.employees.add');
    }

    public function store(CreateRequest $request)
    {
        dd($request);
    }
}
