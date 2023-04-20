<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffiliatePaymentHistory extends Model
{
    protected $table = 'affiliate_payment_history';
    protected $fillable = [
       'account_id','affiliate_id','reference_id','sub_reference_id','type','amount','remaining_amount','user_type','status','term','created_at'
    ];
	
	public function affiliate(){
		return $this->hasOne('App\Models\Affiliate','code','affiliate_id'); 
	}
	public function order(){
		return $this->hasOne('App\Models\AdvanceProductOrder','order_id','reference_id'); 
	}
	public function product(){
		return $this->hasOne('App\Models\AdvanceProduct','id','sub_reference_id'); 
	}
}
