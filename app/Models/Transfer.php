<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $guarded = [];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
}
