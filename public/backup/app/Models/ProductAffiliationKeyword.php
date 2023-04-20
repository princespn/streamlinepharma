<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAffiliationKeyword extends Model
{
    use SoftDeletes;
    protected $table = 'product_affiliation_keywords';
    
    protected $fillable = [
        'inventoryId','keyword_id','status'
    ];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
    
    protected $casts = [
        'status' => 'boolean',
    ];

    public function productInventory() {
        return $this->belongsTo('App\Models\ProductInventory','inventoryId','id');
    }

}
