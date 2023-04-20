<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductWarranty extends Model
{
    use SoftDeletes;
    protected $table = 'product_warranties';
    
    protected $fillable = [
        'inventoryId','domestic','international','summary','coveredIn','notCovered','status'
    ];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
    
    protected $casts = [
        'status' => 'boolean',
    ];
}
