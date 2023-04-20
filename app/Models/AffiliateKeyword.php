<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AffiliateKeyword extends Model
{
    use SoftDeletes;
    protected $table = 'affiliate_keywords';
    
    protected $fillable = [
       'account_id','keyword','status'
    ];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
    
    protected $casts = [
        'status' => 'boolean',
    ];
}
