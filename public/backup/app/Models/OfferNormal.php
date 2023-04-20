<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class OfferNormal extends Model
{
    use SoftDeletes;

    protected $table = 'offer_normals';
    
    protected $fillable = [
        'account_id', 'startDate', 'endDate','couponCode','website_url_image','mobile_url_image','cartMinValue','discount','noOfUsers','link','status'
    ];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
    
    protected $casts = [
        'status' => 'boolean',
    ];
}
