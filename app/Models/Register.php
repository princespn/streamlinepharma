<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Register extends Model
{
    use SoftDeletes;
    protected $table = 'registers';
    
    protected $fillable = [
        'account_id','type', 'name', 'phone', 'email', 'password', 'memebership_id', 'subscription_id', 'status','last_login_at'
    ];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
    
    protected $casts = [
        'status' => 'boolean',
    ];
	
	public function latestOrder(){
        $order=$this->hasMany('App\Models\AdvanceProductOrder','register_id','id')->latest()->first();
       $diff_in_days='';
        if ($order) {
            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $order->created_at);
            $from = \Carbon\Carbon::now();
            $diff_in_days = $to->diffInDays($from);
        }
        return $diff_in_days;
    }
	
	public function inCart(){
		return $this->hasMany('App\Models\AdvanceProductCart','register_user_id','id');
	}
    public function coupons(){
        return $this->hasMany(Coupon::class,'send_to','id');
    }
    public function lastOrder(){
		return $this->hasOne('App\Models\AdvanceProductOrder','id','register_id')->orderBy('id','desc');
	}
}
