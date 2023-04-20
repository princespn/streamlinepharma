<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Affiliate extends Model
{
    use SoftDeletes;
    protected $table = 'affiliates';
    
    protected $fillable = [
       'code', 'name', 'phone', 'email', 'address', 'commission', 'password','status','affiliateKeywords'
    ];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
    
    protected $casts = [
        'status' => 'boolean',
    ];
}
