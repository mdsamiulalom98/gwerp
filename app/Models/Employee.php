<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    
    protected $guarded = [];

    public function department()
    {
        return $this->hasOne(Department::class, 'id', 'department_id')->select('id', 'name');
    }
    public function designation()
    {
        return $this->hasOne(Designation::class, 'id', 'designation_id')->select('id', 'name');
    }
    public function company() {
        return $this->hasOne(Company::class, 'id', 'company_id')->select('id', 'name');
    }
    public function branch() {
        return $this->hasOne(Branch::class, 'id', 'branch_id')->select('id', 'name');
    }
}
