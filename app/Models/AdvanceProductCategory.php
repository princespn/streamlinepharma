<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvanceProductCategory extends Model
{
    protected $table = 'advance_product_category';
    protected $fillable = [
       'setting_id','category','sub_category','account_id','grouping_name','brands','banner'
    ];
	public function template(){
		 return $this->hasOne('App\Models\AdvanceProductSetting','id','setting_id');
	}
}
