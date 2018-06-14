<?php

namespace EmployeeDirectory\Http\Controllers\Admin;

use EmployeeDirectory\Entity\Employee;
use EmployeeDirectory\Entity\Title;
use EmployeeDirectory\Http\Controllers\Controller;
use EmployeeDirectory\Http\Requests\Admin\Employees\EmployeeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $titles = Title::all();

        return view('admin.employees.add', compact('titles'));
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
        $parent = Employee::whereKey($employee['parent_id'])->first();
        $titles = Title::all();

        return view('admin.employees.edit', compact('employee', 'parent', 'titles'));
    }

    public function update(EmployeeRequest $request, Employee $employee)
    {
        $children = $employee->children()->get()->toArray();
        $parent = Employee::whereKey($request['parent'])->get()->toArray();
        if ($this->hasChild($parent, $children)) return redirect()
            ->back()
            ->with('wrongParent', 'Parent should not be a descendant.');

        if (isset($request['new__parent'])) {
            DB::beginTransaction();
            try {
                foreach ($children as $child) {
                    $child->parent_id = $request['new__parent'];
                    $child->save();
                }
            } catch (\Exception $e) {
                DB::rollback();
            }

    	    DB::commit();
        }

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

    public function search(Request $request)
    {
        $employees = Employee::where('full_name', 'like', "%{$request->q}%")->paginate(10);

        $data = [];
        foreach ($employees as $employee) {
            $data[] = ['id' => $employee->id, 'text' => $employee->full_name];
        }
        return response()->json($data);
    }

    public function updateImage(Request $request, Employee $employee)
    {
        $file = $request->file('image');
        if(0 === strpos($file->getMimeType(), 'image')) {
            $path = $file->hashName(public_path() . '/uploads/');
            $path_thumb = $file->hashName(public_path() . '/uploads/thumbnails/');

            $img = Image::make($file);
            $img->save( $path);

            $img_thumb = $img->fit(56, 56);
            $img_thumb->save($path_thumb);

            $employee->image = $file->hashName();
            $employee->save();

            Session::flash('message', 'Image updated');
        } else {
            Session::flash('message', 'Image is not updated, wrong filetype');
        }

        return redirect()->back();
    }

    public function hasChild($a, $b)
    {
        foreach ($b as $k => $v) {
            if ($a[0] === $v) return true;
        }

        return false;
    }
}
