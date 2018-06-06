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
        return DataTables::of(Employee::query())->make(true);
    }
}
