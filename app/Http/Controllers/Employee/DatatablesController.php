<?php

namespace EmployeeDirectory\Http\Controllers\Employee;

use Carbon\Carbon;
use DataTables;
use EmployeeDirectory\Entity\Employee;
use EmployeeDirectory\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DatatablesController extends Controller
{
    /**
     * Displays datatables front end view
     *
     * @return View
     */
    public function index(): View
    {
        return view('employees.index');
    }

    /**
     * Process datatables ajax request.
     *
     * @return JsonResponse
     * @throws \Exception
     */
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
                    return Carbon::parse($employee->hire_date)->format('d M Y');
                })
                ->make(true);
        }
        return new JsonResponse([
            'code' => 403,
            'message' => 'direct view not allowed'
        ]);
    }
}
