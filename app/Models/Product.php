<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';

    protected $fillable = [
        'account_id', 'category_id1' , 'category_id2' , 'category_id3','name', 'description','qc', 'status'
    ];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function attributesFilter()
    {
        return $this->hasMany('App\Models\ProductAttributes', 'product_id', 'id');
    }

    public function attributesOption()
    {
        return $this->hasMany('App\Models\ProductAttributes', 'product_id', 'id');
    }

    public function attributesHighlight()
    {
        return $this->hasMany('App\Models\ProductAttributes', 'product_id', 'id');
    }

    public function productRelated()
    {
        return $this->hasMany('App\Models\ProductRelated', 'product_id', 'id');
    }

    public function productvariations()
    {
        return $this->hasMany('App\Models\ProductInventory', 'product_id', 'id');
    }

    public function tax_detail()
    {
        return $this->hasOne('App\Models\ProductTax', 'product_id', 'id');
    }

    public function searchKeywords()
    {
        return $this->hasOne('App\Models\ProductSearchKeyword', 'product_id', 'id');
    }

    public function account() {
        return $this->belongsTo('App\Models\Account','account_id','id');
    }
}
