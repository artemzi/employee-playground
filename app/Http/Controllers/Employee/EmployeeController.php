<?php

namespace EmployeeDirectory\Http\Controllers\Employee;

use EmployeeDirectory\Entity\Employee;
use Illuminate\Http\Request;
use EmployeeDirectory\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        return view('home');
    }

    public function tree(Request $request)
    {
        if ($request->ajax()) {
            return Employee::defaultOrder()->get(['id', 'full_name as label', 'title_id', '_lft', '_rgt', 'parent_id'])->toTree();
        }
        return redirect('home');
    }
}
