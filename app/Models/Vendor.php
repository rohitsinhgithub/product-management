<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = 'vendors';
    protected $fillable = [
        'company_name',
        'contact_person',
        'address',
        'state',
        'city',
        'phone_number',
        'email',
        'gstin',
        'pan_card_no',
        'aadhar_card_no',
        'cin',
        'tan',
        'tin',
        'status'
    ];
    
}
