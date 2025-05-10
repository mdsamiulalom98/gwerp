<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Document extends Model
{
     protected $guarded = [];

     public function role(){
        return $this->belongsTo(Role::class);
    }

}
