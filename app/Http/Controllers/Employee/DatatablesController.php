<?php

namespace EmployeeDirectory\Http\Controllers\Employee;

use DataTables;
use EmployeeDirectory\Entity\Employee;
use EmployeeDirectory\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
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
        $model = Employee::query();
        return DataTables::eloquent($model)
            ->addColumn('title', function(Employee $employee) {
                return $employee->title->name;
            })
            ->editColumn('salary', function(Employee $employee) {
                return number_format($employee->salary, 2, ',', ' ');
            })
            ->make(true);
    }
}
