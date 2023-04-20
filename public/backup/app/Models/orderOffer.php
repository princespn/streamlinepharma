<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class orderOffer extends Model
{
    use SoftDeletes;
    protected $table = 'order_offers';
    
    protected $fillable = [
        'order_detail_id','offer_type','offer_id','offer_amount','status'
    ];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
    
    protected $casts = [
        'status' => 'boolean',
    ];

    public function offer(){

        return $this->belongsTo('App\Models\OfferNormal', 'offer_id', 'id' );
    }

    
}
