<?php

namespace EmployeeDirectory\Http\Controllers\Admin;

use Carbon\Carbon;
use DataTables;
use EmployeeDirectory\Entity\Employee;
use EmployeeDirectory\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DatatablesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        return view('admin.employees.index');
    }

    public function data(): JsonResponse
    {
        if (request()->ajax()) {
            $employees = Employee::join(
                'titles', 'employees.title_id', '=', 'titles.id'
            )->select(
            'employees.id',
            'employees.full_name',
            'employees.hire_date',
            'employees.salary',
            'titles.name as title');

            return DataTables::eloquent($employees)
                ->editColumn('salary', function(Employee $employee) {
                    return number_format($employee->salary, 2, ',', ' ');
                })
                ->editColumn('hire_date', function(Employee $employee) {
                    return Carbon::parse($employee->hire_date)->format('d.m.Y');
                })
                ->make(true);
        }
        return new JsonResponse([
            'code' => 403,
            'message' => 'direct view not allowed'
        ]);
    }
}
