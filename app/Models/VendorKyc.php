<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorKyc extends Model
{
    use SoftDeletes;
    protected $table = 'vendor_kycs';
    
    protected $fillable = [
        'account_id', 'companyName', 'companyType','kycAddress','kycAddressProof','tanNumber','tanImage','accountHolderName','accountNumber','ifscCode','bankName','bankAddress','bankProofName','bankProofImage','blankCheck','blankCheckImage','kycStatus','status'
    ];

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
    
    protected $casts = [
        'status' => 'boolean',
    ];
}
