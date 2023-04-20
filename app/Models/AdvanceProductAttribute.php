<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvanceProductAttribute extends Model
{
    protected $table = 'advance_product_attributes';
    protected $fillable = [
       'advance_product_setting_id','advance_product_id','attribute','value'
    ];
}
