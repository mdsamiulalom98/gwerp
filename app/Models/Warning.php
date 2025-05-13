<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warning extends Model
{
    protected $guarded = [];
    public function warningBy()
    {
        return $this->belongsTo(Employee::class, 'warning_by');
    }
    public function warningTo()
    {
        return $this->belongsTo(Employee::class, 'warning_to');
    }
}
