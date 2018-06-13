<?php

namespace EmployeeDirectory\Http\Requests\Admin\Employees;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'full_name' => 'required|string',
            'title_id' => 'integer|exists:titles,id',
            'hire_date' => 'required|date_format:Y-m-d H:i:s',
            'salary' => 'nullable|string',
            'parent' => 'nullable|integer|exists:employees,id',
            'new__parent' => 'nullable|integer|exists:employees,id'
        ];
    }
}
