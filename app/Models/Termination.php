<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Termination extends Model
{
    protected $guarded = [];
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function terminationType()
    {
        return $this->belongsTo(TerminationType::class, 'termination_type');
    }
}
