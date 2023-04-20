<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDiscountOffer extends Model
{
    protected $table = 'product_discount_offer';
    protected $fillable = [
       'account_id','sku','coupon_code','start_date','end_date','discount','maximum_discount','no_of_users','per_user' 
    ];
}
