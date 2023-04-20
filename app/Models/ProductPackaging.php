<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPackaging extends Model
{
    use SoftDeletes;
    protected $table = 'product_packagings';
    
    protected $fillable = [
        'inventoryId','weight','length','width','height','cancelOrder','returnOrder','returnOrderDays','replacementOrder','replacementOrderDays','status','includeShipping'
    ];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
    
    protected $casts = [
        'status' => 'boolean',
    ];
}
