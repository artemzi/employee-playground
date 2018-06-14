<?php

namespace EmployeeDirectory\Http\Controllers\Employee;

use EmployeeDirectory\Entity\Employee;
use Illuminate\Http\Request;
use EmployeeDirectory\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $total = Employee::count();
        return view('home', compact('total'));
    }

    public function tree(Request $request)
    {
        if ($request->ajax()) {
            $employees = Employee::defaultOrder()->where('parent_id', '=', $request['node'])
                ->join('titles', 'employees.title_id', '=', 'titles.id')
                ->select(
                'employees.id',
                'full_name as label',
                'titles.name as title',
                'load_on_demand',
                '_lft',
                '_rgt',
                'parent_id'
            )->get();
        }

        return $employees->toTree();
    }

    public function move()
    {
        if (Auth::guest()) return redirect('/login');
    	// start transaction
    	DB::beginTransaction();
    	switch(request()->action) {
			case 'moveCategory':
				// get source/target categories from DB
				$sourceEmployee = Employee::find(request()->id);
				$targetEmployee = Employee::find(request()->to);
				// check for data consistency (can also do a try&catch instead)
				if ($sourceEmployee && $targetEmployee) {
					switch (request()->direction) {
						case 'inside' :
							$status = $sourceEmployee->prependToNode($targetEmployee)->save();
							break;
						case 'before' :
							$status = $sourceEmployee->beforeNode($targetEmployee)->save();
							break;
						case 'after' :
							$status = $sourceEmployee->afterNode($targetEmployee)->save();
							break;
					}
				}
				break;
	   	}
    	if ($status === null) { DB::rollback(); \App::abort(400); }
    	DB::commit();
    }
}
