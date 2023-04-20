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
        'account_type',
        'delhivehryStatus',
        'delhivehry_token',
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
        'home_page',
        'address',
        'pinCode',
        'instamojoApiKey',
        'instamojoAuthToken',
        'razorPayDisplayName',
        'razorPayApiKey',
        'razorPayApiSecret',
        'shipyaariStatus',
        'shipyaariUserName',
        'shipyaariClientCode',
        'shipyaariParentCode',
        'shiprocketStatus',
        'shiprocketEmail',
        'shiprocketPassword',
        'shiprocketPickupLocation',
        'shiprocketToken',
        'shiprocketTokenGenrationTime',
        'defaultShippingMethod',
        'type',
        'password',
        'offer_page_title',
        'isMembership',
        'membership_background_image',
        'membership_product_page_text',
        'shiprocketPickupLocationAll',
        'affiliateKeywords',
        'subscribedTemplate',
        'description',
        'administrator',
        'kyc_gstin',
        'kyc_gstin_certificate',
        'kyc_pan',
        'kyc_pan_certificate',
        'kyc_authorized_signatory',
        'users_listing_coloumn'
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
