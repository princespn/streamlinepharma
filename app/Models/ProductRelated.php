<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ProductRelated extends Model
{
    use SoftDeletes;
    protected $table = 'product_related';

    protected $fillable = [
        'product_id', 'related_product_id', 'status'
    ];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];

    protected $casts = [
        'status' => 'boolean',
    ];
}
