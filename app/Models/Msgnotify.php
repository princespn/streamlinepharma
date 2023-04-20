<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Msgnotify extends Model
{
    protected $fillable = ['account_id','messages','msg_type','template_id','status'];
}
