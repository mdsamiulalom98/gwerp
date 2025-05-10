<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyPolicy extends Model
{

    protected $table = 'company_policies';
    protected $guarded = [];

    public function company() {
        return $this->hasOne(Company::class, 'id', 'company_id')->select('id', 'name');
    }
    public function branch() {
        return $this->hasOne(Branch::class, 'id', 'branch_id')->select('id', 'name');
    }
}
