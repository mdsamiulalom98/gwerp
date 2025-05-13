<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $guarded = [];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }
}
