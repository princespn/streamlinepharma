<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmpRestriction extends Model
{
    use SoftDeletes;
    protected $table = 'emp_restrictions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'employee_id','action_id', 'page_id'];

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
        
    ];

    public function employee() {
        return $this->belongsTo('App\Models\Employee','employee_id','id');
    }

    public function action() {
        return $this->belongsTo('App\Models\Action','action_id','id');
    }

    public function page() {
        return $this->belongsTo('App\Models\Page','page_id','id');
    }
}
