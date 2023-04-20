<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class orderDetail extends Model
{
    use SoftDeletes;
    protected $table = 'order_details';
    
    protected $fillable = [
        'order_id','affiliate_id','qty','price','tax','shipping','inventory_id','sku','productName','productDescription','variation0','variation1','variation2','variation3','variation4','imageURL0','imageURL1','imageURL2','imageURL3','imageURL4','imageURL5','videoURL','pdfURL','status'
    ];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
    
    protected $casts = [
        'status' => 'boolean',
    ];

    public function inventory_price(){

        return $this->belongsTo('App\Models\ProductPrice','inventory_id','inventoryId');
    }

    public function inventoryPackaging(){

        return $this->hasOne('App\Models\ProductPackaging', 'inventoryId', 'inventory_id' );
    }

    public function orderOffers(){

        return $this->belongsTo('App\Models\orderOffer', 'inventory_id', 'inventoryId' );
    }

    public function order()
    {
        return $this->hasOne('App\Models\order', 'id', 'order_id');
    }

    public function affiliate()
    {
        return $this->hasOne('App\Models\Affiliate', 'id', 'affiliate_id');
    }
}
