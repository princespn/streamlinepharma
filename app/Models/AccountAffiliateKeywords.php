<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountAffiliateKeywords extends Model
{
    use SoftDeletes;
    protected $table = 'account_affiliate_keywords';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_id', 'keyword_id', 'status'
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
     
    protected $casts = [
        'status' => 'boolean',
    ];*/

    public function keyword() {
        return $this->belongsTo('App\Models\AffiliateKeyword','keyword_id','id');
    }
}
