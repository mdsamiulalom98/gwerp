<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnnouncementDepartment extends Model
{
    protected $guarded = [];
    public function announcement()
    {
        return $this->belongsTo(Announcement::class, 'announcement_id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
