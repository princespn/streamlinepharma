<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvanceProduct extends Model
{
    protected $table = 'advance_product';
    protected $fillable = [
       'setting_id','title','brand','hsn_code','account_id','thumbnail','image1','image2','image3','image4','image5','image6','image7','view_360_file','name','sku','product_code','category','sub_category','unit_quanitity','unit','product_price','product_tax','tax_method','cess','selling_price','selling_price_label','moq','description','status','color','height','width','length','dimension_unit','size','weight','weight_unit','search_key_words','dropdown_name','dropdown_option','dropdown_unit','single_name','single_value','additional_attribute','is_return','return_days','return_terms','is_replace','replace_days','replace_terms','shipping_charges','shipping_method','is_cod_available' ,'dynamic_selling_price','is_affiliation','affiliation_payment_release_online','affiliation_payment_release_cod','affiliation_price','dynamic_menu'
    ];
	
	public function setting() {
        return $this->hasOne('App\Models\AdvanceProductSetting','id','setting_id');
	}
	public function account(){
		return $this->hasOne('App\Models\Account','id','account_id');
	}
	public function purchase_offer(){
		return $this->hasMany('App\Models\Purchaseoffer','product_sku','sku')
		->where('startDate','<=',date('Y-m-d H:i:s'))
		->where('endDate','>=',date('Y-m-d H:i:s')); 
	}
	public function purchase_product_offer(){
		return $this->hasOne('App\Models\Purchaseoffer','product_sku','sku')
		->where('startDate','<=',date('Y-m-d H:i:s'))
		->where('endDate','>=',date('Y-m-d H:i:s')); 
	}
	public function credit(){
		return $this->hasOne('App\Models\AccountCreditAffiliation','account_id','account_id');
	}
	public function review(){
		return $this->hasMany('App\Models\Reviews','product_id','id')
		       ->where('status',1);
	}
	public function singleReview(){
		return $this->hasOne('App\Models\Reviews','product_id','id')
		       ->where('status',1);
	}
	public function avgRating(){
		return $this->singleReview()
		       ->where('status',1)
			   ->selectRaw('avg(rating) as avg,product_id')
			   ->groupBy('product_id');
	}
	public function fiveStar(){
		return $this->singleReview()
		       ->where('status',1)
		       ->where('rating',5)
			   ->selectRaw('count(rating) as num,product_id')
			   ->groupBy('product_id');
	}
	public function fourStar(){
		return $this->singleReview()
		       ->where('status',1)
		       ->where('rating',4)
			   ->selectRaw('count(rating) as num,product_id')
			   ->groupBy('product_id');
	}
	public function threeStar(){
		return $this->singleReview()
		       ->where('status',1)
		       ->where('rating',3)
			   ->selectRaw('count(rating) as num,product_id')
			   ->groupBy('product_id');
	}
	public function twoStar(){
		return $this->singleReview()
		       ->where('status',1)
		       ->where('rating',2)
			   ->selectRaw('count(rating) as num,product_id')
			   ->groupBy('product_id');
	}
	public function oneStar(){
		return $this->singleReview()
		       ->where('status',1)
		       ->where('rating',1)
			   ->selectRaw('count(rating) as num,product_id')
			   ->groupBy('product_id');
	}
}
