<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductQc extends Model
{
    use SoftDeletes;
    protected $table = 'product_qcs';
    
    protected $fillable = [
        'inventory_id','description','status'
    ];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
    
    protected $casts = [
        'status' => 'boolean',
    ];

    public function label(){
        return $this->belongsTo('App\Models\Label','label_id','id');
    }
}
