<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Privacy extends Model
{
    use SoftDeletes;
    protected $table = 'privacies';
    
    protected $fillable = [
        'account_id', 'heading', 'description','status'
    ];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
    
    protected $casts = [
        'status' => 'boolean',
    ];
}
