<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    
    
    protected $fillable = [
       'name','charges', 'charge_recurring','benifits','shipping_charges','freebies_amount','freebies_scheduling','terms_and_conditions','account_id','razorpay_subscription_id'
    ];
}
