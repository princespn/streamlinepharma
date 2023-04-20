<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class cartTemporary extends Model
{
    use SoftDeletes;
    protected $table = 'cart_temporaries';
    
    protected $fillable = [
        'account_id', 'register_id', 'affiliate_id','inventoryId','qty','status'
    ];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
    
    protected $casts = [
        'status' => 'boolean',
    ];

    public function cartInventory() {
        return $this->belongsTo('App\Models\ProductInventory','inventoryId','id');
    }

    public function inventoryPrice(){

        return $this->hasOne('App\Models\ProductPrice', 'inventoryId' , 'inventoryId');
    }

    public function inventoryPackaging(){

        return $this->hasOne('App\Models\ProductPackaging', 'inventoryId' , 'inventoryId');
    }

    public function inventoryOffer(){

        return $this->hasOne('App\Models\OfferNormal','id','offerId');
    }
}
