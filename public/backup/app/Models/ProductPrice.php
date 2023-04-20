<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPrice extends Model
{
    use SoftDeletes;
    protected $table = 'product_prices';

    protected $fillable = [
        'inventoryId', 'qty' , 'mrp' , 'sprice', 'sellingAffiliationCharge','inquiryAffiliationCharge', 'status'
    ];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function orderDetails(){

        return $this->hasOne('App\Models\orderDetail', 'inventory_id' , 'id');
    }
}
