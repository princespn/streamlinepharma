<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GeneralInquiry extends Model
{
    use SoftDeletes;
    protected $table = 'general_inquiries';
    
    protected $fillable = [
        'account_id','title','description','name','phone','email','status'
    ];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
    
    protected $casts = [
        'status' => 'boolean',
    ];
}
