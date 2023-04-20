<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductTax extends Model
{
    use SoftDeletes;
    protected $table = 'product_taxes';
    
    protected $fillable = [
        'product_id','hsn','tax','status'
    ];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
    
    protected $casts = [
        'status' => 'boolean',
    ];
}
