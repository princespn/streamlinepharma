<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
class Category extends Model
{
    use SoftDeletes;
    protected $table = 'categories';
    
    protected $fillable = [
       'account_id', 'ref_id', 'level','website_url_image', 'mobile_url_image', 'name', 'description','status'
    ];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
    
    protected $casts = [
        'status' => 'boolean',
    ];

    public function parentCategory(){
        return $this->belongsTo('App\Models\Category','ref_id','id');
    }

    public function subCategory(){
        return $this->hasMany('App\Models\Category', 'ref_id' , 'id');
    }
   
    public function productlevel0(){
        return $this->hasMany('App\Models\Product', 'account_id' , 'account_id');
    }

    public function productlevel1(){
        return $this->hasMany('App\Models\Product', 'category_id1' , 'id');
    }

    public function productlevel2(){
        return $this->hasMany('App\Models\Product', 'category_id2' , 'id');
    }

    public function productlevel3(){
        return $this->hasMany('App\Models\Product', 'category_id3' , 'id');
    }
	public function template(){
		$domainName = (new Controller)->activeDomain();
		$account = Account::where('domain', $domainName)->first();
		$subscribedTemplate    = $account->subscribedTemplate;
		return $this->hasMany('App\Models\AdvanceProductCategory','sub_category','id')->whereIn('setting_id',explode(',',$subscribedTemplate));
		return $this->hasMany('App\Models\AdvanceProductCategory','sub_category','id');
	}
}
