<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $guarded = [];

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'announcement_departments');
    }
}
