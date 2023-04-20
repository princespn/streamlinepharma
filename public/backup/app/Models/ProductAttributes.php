<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAttributes extends Model
{
    use SoftDeletes;
    protected $table = 'product_attributes';
    
    protected $fillable = [
        'product_id','label_id','type','status'
    ];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
    
    protected $casts = [
        'status' => 'boolean',
    ];

    public function label(){
        return $this->belongsTo('App\Models\Label','label_id','id');
    }
}
