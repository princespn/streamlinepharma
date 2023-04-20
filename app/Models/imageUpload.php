<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class imageUpload extends Model
{
    use SoftDeletes;
    protected $table = 'imageUploads';
    
    protected $fillable = [
       'mediaType','ref_id', 'name','status','title'
    ];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
    
    protected $casts = [
        'status' => 'boolean',
    ];
}
