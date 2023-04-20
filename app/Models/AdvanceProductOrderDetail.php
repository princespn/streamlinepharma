<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvanceProductOrderDetail extends Model
{
    protected $table = 'advance_product_order_details';
    protected $fillable = [
       'order_id','product_id','title','thumbnail','product_price','shipping_charges','selling_price','product_tax','cess','height','width','length','weight','total','qty' 
    ];
	public function product() {
        return $this->hasOne('App\Models\AdvanceProduct','id','product_id');
	}
	public function ReferralScheme() {
        return $this->hasOne('App\Models\ReferralScheme','id','referral_id');
	}
}
