<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductInquiry extends Model
{
    use SoftDeletes;
    protected $table = 'product_inquiries';
    
    protected $fillable = [
        'account_id','inventoryId','affiliate_id','title','description','name','phone','email','status'
    ];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
    
    protected $casts = [
        'status' => 'boolean',
    ];

    public function productvariations()
    {
        return $this->hasMany('App\Models\ProductInventory', 'id', 'inventoryId');
    }
}
