<?php

namespace EmployeeDirectory\Http\Controllers\Employee;

use EmployeeDirectory\Entity\Employee;
use EmployeeDirectory\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $boss = Employee::whereTitle_id(1)->first();
        $total = Employee::count();
        return view('home', compact('boss', 'total'));
    }

    public function tree(Request $request)
    {
        if ($request->ajax()) {
            // do not show root node. This is a Boss, not employee
            $employees = Employee::withoutRoot()->get(
                ['id', 'full_name as label', 'title_id', '_lft', '_rgt', 'parent_id']
            );
            foreach ($employees as $empl) {
                $empl['title'] = $empl->title->name;
            }
            return $employees->toTree();
        }
        return redirect('home');
    }
}
