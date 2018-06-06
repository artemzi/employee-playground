<?php

namespace EmployeeDirectory\Http\Controllers\Employee;

use EmployeeDirectory\Entity\Employee;
use EmployeeDirectory\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $boss = Employee::whereId(1)->first();
        return view('home', compact('boss'));
    }

    public function tree(Request $request)
    {
        if ($request->ajax()) {
            // do not show root node. This is a Boss, not employee
            $employees = Employee::withoutRoot()->get(['id', 'full_name as label', 'title_id', '_lft', '_rgt', 'parent_id']);
            foreach ($employees as $empl) {
                $empl['title'] = $empl->title->name;
            }
            return $employees->toTree();
        }
        return redirect('home');
    }
}
