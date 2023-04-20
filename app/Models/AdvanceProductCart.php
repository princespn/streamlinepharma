<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvanceProductCart extends Model
{
    protected $table = 'advance_product_cart';
    protected $fillable = [
       'account_id','register_id','product_id','qty' 
    ];
	 
	public function product() {
        return $this->hasOne('App\Models\AdvanceProduct','id','product_id');
	}
	
	public function register() {
        return $this->hasOne('App\Models\Register','id','register_user_id');
	}
	public function ReferralScheme() {
        return $this->hasOne('App\Models\ReferralScheme','id','scheme_id');
	}
}
