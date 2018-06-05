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
        'full_name', 'hire_date', 'parent_id',
    ];

    public function title()
    {
        return $this->belongsTo(Title::class);
    }
}
