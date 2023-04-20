<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use SoftDeletes;
    protected $table = 'accounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'theme',
        'color',
        'domain',
        'charge',
        'defaultCurrency',
        'logo',
        'title',
        'phone',
        'whatsApp',
        'email',
        'landmark',
        'address',
        'pinCode',
        'instamojoApiKey',
        'instamojoAuthToken',
        'shipyaariUserName',
        'shipyaariClientCode',
        'shipyaariParentCode',
        'type',
        'password'
    ];

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
        'status' => 'boolean',
    ];

    public function currency() {
        return $this->belongsTo('App\Models\Currency','defaultCurrency','id');
    }
}
