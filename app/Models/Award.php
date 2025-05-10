<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    protected $table = 'awards';

    protected $guarded = [];

    public function employee() {
        return $this->belongsTo(Employee::class)->select('id', 'name');
    }
    public function awardtype() {
        return $this->belongsTo(AwardType::class,'award_type')->select('id', 'name');
    }
}
