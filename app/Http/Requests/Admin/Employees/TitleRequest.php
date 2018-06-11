<?php

namespace EmployeeDirectory\Http\Requests\Admin\Employees;

use Illuminate\Foundation\Http\FormRequest;

class TitleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
        ];
    }
}
