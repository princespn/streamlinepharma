<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralScheme extends Model
{
    protected $table = 'referral_scheme';
    protected $fillable = [
       'scheme_name','offering_product','discount','special_charges_label','special_charges','referral_wallet_benefits','description','scheme_validity','account_id' 
    ];
}
