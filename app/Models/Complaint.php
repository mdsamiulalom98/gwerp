<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $guarded = [];
    public function from()
    {
        return $this->belongsTo(Employee::class, 'complaint_from');
    }
    public function against()
    {
        return $this->belongsTo(Employee::class, 'complaint_against');
    }
}
