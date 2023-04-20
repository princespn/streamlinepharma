<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchaseoffer extends Model
{
    protected $fillable = [
        'account_id','scheme','product_sku', 'qty','startDate','endDate', 'get_prod_sku','get_qty', 'status','terms_and_conditions'
    ];

    protected $hidden = ['created_at', 'updated_at'];
	public function sceheme(){
		return $this->hasOne('App\Models\Productscheme','id','scheme');
	}
	public function offerProduct(){
		return $this->hasOne('App\Models\AdvanceProduct','sku','get_prod_sku');
	}
	public function buyProduct(){
		return $this->hasOne('App\Models\AdvanceProduct','sku','product_sku');
	}
}
