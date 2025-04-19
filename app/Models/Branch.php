<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use SoftDeletes;
       
    protected $fillable = [
         'company_id',
         'branch_name',
         'branch_code',
         'address',
         'city',
         'state',
         'phone',
         'email',
         'status',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
