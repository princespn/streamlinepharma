<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ExtraService extends Model
{
    use SoftDeletes;
    protected $table = 'extra_services';
    
    protected $fillable = [
        'account_id', 'delivery','deliveryTitle','moneyBack','moneyBackTitle','support', 'supportTitle','status'
    ];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
    
    protected $casts = [
        'status' => 'boolean',
    ];
}
