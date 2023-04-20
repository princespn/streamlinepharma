<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvanceProductOrder extends Model
{
    protected $table = 'advance_product_orders';
    protected $fillable = [
       'id','account_id','wallet_tr_details','register_id','order_id','transactionType','transactionId','status','name','phone','email','landmark','address','zipCode','cityId','stateId','grand_total','shipyaariPayLoad','shipRocketPayLoad','shiprocketManifests','delhiVeryPayload' ,'delhiVeryOrderResponse','delhiVeryPickUpResponse'
    ];
	
	public function products() {
        return $this->hasMany('App\Models\AdvanceProductOrderDetail','order_id','order_id');
	}
	public function affiliates(){
		return $this->hasOne('App\Models\Affiliate','code','aff_id');
	}
	public function register(){
		return $this->hasOne('App\Models\Register','id','register_id');
	}
	
	public function account(){
		return $this->hasOne('App\Models\Account','id','account_id');
	}
}
