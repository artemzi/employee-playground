<?php

namespace EmployeeDirectory\Http\Controllers\Employee;

use EmployeeDirectory\Entity\Employee;
use Illuminate\Http\Request;
use EmployeeDirectory\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $employees = Employee::defaultOrder()->withDepth()->get();

        return view('home', compact('employees'));
    }
}
