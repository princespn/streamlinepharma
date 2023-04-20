<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;
    protected $table = 'tags';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_id','tag','status'
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

    public function filterLabels() {
        
        return $this->hasMany('App\Models\Label','tag_id','id');
    }

    public function optionLabels() {
        
        return $this->hasMany('App\Models\Label','tag_id','id');
    }

    public function highlightLabels() {
        
        return $this->hasMany('App\Models\Label','tag_id','id');
    }
}
