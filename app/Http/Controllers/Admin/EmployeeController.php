<?php

namespace EmployeeDirectory\Http\Controllers\Admin;

use EmployeeDirectory\Entity\Employee;
use EmployeeDirectory\Entity\Title;
use EmployeeDirectory\Http\Controllers\Controller;
use EmployeeDirectory\Http\Requests\Admin\Employees\EmployeeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class EmployeeController extends Controller
{
    public function index()
    {
        return redirect()->route('home');
    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);

        return view('admin.employees.show', compact('employee'));
    }

    public function create()
    {
        $parents = Employee::defaultOrder()->withDepth()->get();
        $titles = Title::all();

        return view('admin.employees.add', compact('parents', 'titles'));
    }

    public function store(EmployeeRequest $request)
    {
        $employee = Employee::create([
            'full_name' => $request['full_name'],
            'title_id' => $request['title'],
            'hire_date' => $request['hire_date'],
            'salary' => (int) $request['salary'],
            'parent_id' => $request['parent']
        ]);

        return redirect()->route('employee.show', $employee->id);
    }

    public function edit(Employee $employee)
    {
        $parents = Employee::defaultOrder()->withDepth()->get();
        $titles = Title::all();

        return view('admin.employees.edit', compact('employee', 'parents', 'titles'));
    }

    public function update(EmployeeRequest $request, Employee $employee)
    {
        $employee->update([
            'full_name' => $request['full_name'],
            'title_id' => $request['title'],
            'hire_date' => $request['hire_date'],
            'salary' => (int) $request['salary'],
            'parent_id' => $request['parent']
        ]);

        return redirect()->route('employee.show', $employee->id);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('table');
    }

    public function updateImage(Request $request, Employee $employee)
    {
        $file = $request->file('image');
        if(0 === strpos($file->getMimeType(), 'image')) {
            $path = $file->hashName(public_path() . '/uploads/');

            $img = Image::make($file);
            $img->save( $path);

            $employee->image = $file->hashName();
            $employee->save();

            Session::flash('message', 'Image updated');
        } else {
            Session::flash('message', 'Image is not updated, wrong filetype');
        }

        return redirect()->back();
    }
}
