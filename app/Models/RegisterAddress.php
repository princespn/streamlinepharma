<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegisterAddress extends Model
{
    use SoftDeletes;
    protected $table = 'register_addresses';
    
    protected $fillable = [
        'register_id', 'name', 'phone', 'email', 'landmark', 'address', 'zipCode', 'cityId', 'stateId', 'countryId', 'status'
    ];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
    
    protected $casts = [
        'status' => 'boolean',
    ];
}
