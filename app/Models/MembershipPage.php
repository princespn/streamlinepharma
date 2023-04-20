<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipPage extends Model
{
	
    protected $fillable = [
       'account_id','title', 'sub_title','image','sorting_order'
    ];
}
