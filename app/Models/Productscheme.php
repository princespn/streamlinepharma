<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productscheme extends Model
{
    protected $fillable = [
        'account_id','image_file', 'title', 'status'
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
