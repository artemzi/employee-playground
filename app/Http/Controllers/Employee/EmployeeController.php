<?php

namespace EmployeeDirectory\Http\Controllers\Employee;

use EmployeeDirectory\Entity\Employee;
use EmployeeDirectory\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function tree(Request $request)
    {
        if ($request->ajax()) {
            $employees = Employee::defaultOrder()->get(['id', 'full_name as label', 'title_id', '_lft', '_rgt', 'parent_id']);
            foreach ($employees as $empl) {
                $empl['title'] = $empl->title->name;
            }
            return $employees->toTree();
        }
        return redirect('home');
    }
}
