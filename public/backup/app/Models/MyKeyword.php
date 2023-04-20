<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MyKeyword extends Model
{
    use SoftDeletes;
    protected $table = 'my_keywords';
    
    protected $fillable = [
        'affiliate_id', 'keyword_id'
    ];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
    
    protected $casts = [
        'status' => 'boolean',
    ];

    public function keyword() {
        return $this->belongsTo('App\Models\AffiliateKeyword','keyword_id','id');
    }

    public function productAffiliationKeyword() {
        return $this->hasMany('App\Models\ProductAffiliationKeyword','keyword_id','keyword_id');
    }
}
