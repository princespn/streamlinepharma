<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DynamicMenu extends Model
{
    protected $table = 'dynamic_menu';
    protected $fillable = [
       'account_id','category','sub_category','setting' 
    ];
	public function cat() {
        return $this->hasOne('App\Models\Category','id','category');
	}
	public function sub_cat() {
        return $this->hasOne('App\Models\Category','id','sub_category');
	}
	public function template() {
        return $this->hasOne('App\Models\AdvanceProductSetting','id','setting');
	}
}
