<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Coupon extends Model
{
    
    protected $table = 'coupons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'scheme_name',
        'four_sale_x_id',
        'template',
        'no_set',
        'coupon',
        'time',
        'added_by',
        'send_to',
        'status',
        'uesttime',
        'user_type'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
    ];
    public function register(){
        return $this->belongsTo(Register::class,'send_to','id');
    }

   
}
