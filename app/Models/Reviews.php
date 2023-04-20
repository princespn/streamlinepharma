<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $table = 'reviews';
    protected $fillable = [
       'account_id','register_id','product_id','rating','headline','review','photo','created_at','updated_at'
    ];
	public function product() {
        return $this->hasOne('App\Models\AdvanceProduct','id','product_id');
	}
	
	public function register() {
        return $this->hasOne('App\Models\Register','id','register_id');
	}
}
