<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvanceProductSetting extends Model
{
    protected $table = 'advance_product_setting';
    protected $fillable = [
       'name','menu','sub_menu','title_check','brand_check','hsn_code_check','thumbnail_check','image1_check','image2_check','image3_check','image4_check','image5_check','image6_check','image7_check','view_360_file_check','sku_check','product_code_check','category_check','category_check_value','sub_category_check','sub_category_check_value','unit_type_check','unit_type_check_value_multi','product_price_check','product_tax_check','product_tax_check_value','tax_method_check','cess_check','cess_check_value','selling_price_check','selling_price_label','moq_check','description_check','status_check','color_check','color_check_value','color_check_value_multi','dimension_check','dimension_check_value','size_check','size_check_value','size_check_value_option','weight_check','weight_check_value','search_key_words_check','additional_attribute','brand_filter','category_filter','sub_category_filter','selling_price_filter','moq_filter','status_filter','color_filter','dimension_filter','size_filter','weight_filter','search_key_words_filter','company_id','grouping','isOptional'
    ];
	
    public function category(){
		return $this->hasOne('App\Models\AdvanceProductCategory','setting_id','setting_id')->where('advance_product_category.account_id','advance_product_setting.account_id');
	}
}
