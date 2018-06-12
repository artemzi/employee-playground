<?php

namespace EmployeeDirectory\Http\Controllers\Employee;

use EmployeeDirectory\Entity\Employee;
use Illuminate\Http\Request;
use EmployeeDirectory\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $boss = Employee::whereTitle_id(1)->first();
        $total = Employee::count();
        return view('home', compact('boss', 'total'));
    }

    public function tree(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            // do not show root node. This is a Boss, not employee
            $employees = Employee::withoutRoot()->get(
                ['id', 'full_name as label', 'title_id', '_lft', '_rgt', 'parent_id']
            );
        } else {
            $employees = Employee::where('parent_id', '=', $request['node'])->get(
                ['id', 'full_name as label', 'title_id', '_lft', '_rgt', 'parent_id']
            );
        }

        foreach ($employees as $empl) {
            $empl['title'] = $empl->title->name;
            // do not use lazy load for first two levels
            // TODO: check logic
            if (\count($empl->descendants) === 0 || \count($empl->ancestors) < 3) continue;
            $empl['load_on_demand'] = true;
        }

        return $employees->toTree();
    }
}
