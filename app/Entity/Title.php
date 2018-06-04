<?php

namespace EmployeeDirectory\Entity;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    public $timestamps = false;

    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }
}
