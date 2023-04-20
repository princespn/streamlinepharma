<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductInventory extends Model
{
    use SoftDeletes;
    protected $table = 'product_inventories';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'sku', 'productName', 'productDescription', 'variation0', 'variation1', 'variation2', 'variation3', 'variation4', 'imageURL0', 'imageURL1', 'imageURL2', 'imageURL3', 'imageURL4' , 'imageURL5' ,'videoURL' ,'pdfURL' , 'status'
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
    
    public function variant0(){

        return $this->belongsTo('App\Models\Label','variation0','id');
    }

    public function variant1(){

        return $this->belongsTo('App\Models\Label','variation1','id');
    }

    public function variant2(){

        return $this->belongsTo('App\Models\Label','variation2','id');
    }

    public function variant3(){

        return $this->belongsTo('App\Models\Label','variation3','id');
    }

    public function variant4(){

        return $this->belongsTo('App\Models\Label','variation4','id');
    }

    public function inventory_shipping(){

        return $this->hasOne('App\Models\ProductPackaging', 'inventoryId' , 'id');
    }

    public function inventory_warranty(){

        return $this->hasOne('App\Models\ProductWarranty', 'inventoryId' , 'id');
    }

    public function inventory_affiliation(){

        return $this->hasMany('App\Models\ProductAffiliationKeyword', 'inventoryId' , 'id');
    }

    public function inventory_offer(){

        return $this->hasOne('App\Models\ProductOffer', 'inventoryId' , 'id');
    }

    public function inventory_price(){

        return $this->hasOne('App\Models\ProductPrice', 'inventoryId' , 'id');
    }

    public function productTax(){

        return $this->hasOne('App\Models\ProductTax', 'product_id' , 'product_id');
    }

    public function productPrice(){

        return $this->hasOne('App\Models\ProductPrice', 'inventoryId' , 'id');
    }

    public function product_packaging(){

        return $this->hasOne('App\Models\ProductPackaging', 'inventoryId' , 'id');
    }

    public function product(){

        return $this->belongsTo('App\Models\Product', 'product_id' , 'id');
    }

    public function account() {

        return $this->belongsTo('App\Models\Account','account_id','id');
    }

    public function inventory_message(){

        return $this->hasMany('App\Models\ProductQc', 'inventory_id' , 'id')->orderBy('id', 'DESC');
    }
}
