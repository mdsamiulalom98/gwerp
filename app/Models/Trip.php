<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    
    protected $guarded = [];

    public function employee() {
        return $this->belongsTo(Employee::class)->select('id', 'name');
    }
    
}
