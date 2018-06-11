<?php

namespace EmployeeDirectory\Http\Controllers\Admin;

use EmployeeDirectory\Entity\Title;
use EmployeeDirectory\Http\Requests\Admin\Employees\TitleRequest;
use Illuminate\Http\Request;
use EmployeeDirectory\Http\Controllers\Controller;

class TitleController extends Controller
{
    public function index()
    {
        $titles = Title::all();

        return view('admin.employees.title.index', compact('titles'));
    }

    public function create()
    {
        return view('admin.employees.title.add');
    }

    public function store(TitleRequest $request)
    {
        Title::create([
            'name' => $request['name']
        ]);

        return redirect()->route('titles.index');
    }

    public function edit(Title $title)
    {
        return view('admin.employees.title.edit', compact('title'));
    }

    public function update(TitleRequest $request, Title $title)
    {
        $title->update([
            'name' => $request['name']
        ]);

        return redirect()->route('titles.index');
    }

//    public function destroy(Title $title)
//    {
//            DELETE NOT SUPPORTED
//    }
}
