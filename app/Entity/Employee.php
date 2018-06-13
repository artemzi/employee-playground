<?php

namespace EmployeeDirectory\Entity;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

/**
 * EmployeeDirectory\Entity\Employees
 *
 * @mixin \Eloquent
 */
class Employee extends Model
{
    use NodeTrait;

    public $timestamps = false;

    protected $fillable = [
        'full_name', 'image', 'hire_date', 'parent_id', 'title_id', 'salary',
    ];

    public function getParent()
    {
        return Employee::where('id',  $this->getParentId())->get()[0];
    }

    public function title()
    {
        return $this->belongsTo(Title::class);
    }

    public function setImageAttribute($val)
    {
        $this->attributes['image'] = $val;
    }
}
