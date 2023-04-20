<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class order extends Model
{
    use SoftDeletes;
    protected $table = 'orders';
    
    protected $fillable = [
        'account_id', 'register_id', 'name','phone','email','landmark','address','zipCode','transactionType','onlineTransactionMode','transactionId','orderNo','orderStatus','status','coupon_code','coupon_amount','shipRocketOrder','shiprocketPickUpRequest','shiprocketAWB','shiprocketAvailabilityPayLoad'
    ];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
    
    protected $casts = [
        'status' => 'boolean',
    ];

    public function orderDetails() {
        return $this->hasMany('App\Models\orderDetail','order_id','id');
    }
	
	public function account() {
        return $this->belongsTo('App\Models\Account','account_id','id');
    }
}
