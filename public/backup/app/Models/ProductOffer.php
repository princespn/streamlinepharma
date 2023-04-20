<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ProductOffer extends Model
{
    use SoftDeletes;
    protected $table = 'product_offers';

    protected $fillable = [
        'inventoryId', 'offerType', 'offerId', 'status'
    ];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function offer(){
        return $this->belongsTo('App\Models\OfferNormal' , 'offerId' , 'id');
    }

}
