<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSearchKeyword extends Model
{
    use SoftDeletes;
    protected $table = 'product_search_keywords';
    
    protected $fillable = [
        'product_id','keyword','status'
    ];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
    
    protected $casts = [
        'status' => 'boolean',
    ];

    public function searchProduct()
    {
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }
}
