<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Affiliate;
use Redirect;
class BankDetailController extends Controller
{
    public $razorpay_key    = 'rzp_live_txRWRjezURu9hd';
    public $razorpay_secret = 'fygIpUt3gpDD27b9VCKnhLU8';
    public function bankDetail(){
        $data = Affiliate::where('id',Session::get('user')->id)->first();
        $return = view('affiliate.bank.index');
        if($data->razorpay_bank_detail){
            $data = json_decode($data->razorpay_bank_detail,true);
            //print_r($data);exit;
            $return = $return->with('data',$data); 
        }
        return $return;
    }
    public function bankDetailPost(Request $request){
        
        $contact_array = [
                            "name"         => $request->name,
                            "email"        => $request->email,
                            "contact"      => '91'.$request->mobile,
                            "type"         => "employee",
                            "reference_id" => "AFF".$request->mobile
                         ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://api.razorpay.com/v1/contacts");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_USERPWD, env('RAZORPAY_X_KEY').':'.env('RAZORPAY_X_SECRET'));
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($contact_array));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $contact_output = curl_exec($ch);
        $contact_output = json_decode($contact_output,true);
        if(array_key_exists("error",$contact_output)){
            //echo $contact_output['error']['description'];
            return Redirect::back()->withErrors(['msg' => $contact_output['error']['description']]);
            exit;
        }
        

        $funds_array = [
            "contact_id"    => $contact_output['id'],
            "account_type"  => 'bank_account',
            "bank_account"  => [
                                 'name'           => $request->name,
                                 'ifsc'           => $request->ifsc,
                                 'account_number' => $request->account_number
                               ]
         ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://api.razorpay.com/v1/fund_accounts");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_USERPWD, env('RAZORPAY_X_KEY').':'.env('RAZORPAY_X_SECRET'));
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($funds_array));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $funds_output = curl_exec($ch);
        $funds_output = json_decode($funds_output,true);
        if(array_key_exists("error",$funds_output)){
            //echo $funds_output['error']['description'];
            return Redirect::back()->withErrors(['msg' => $funds_output['error']['description']]);
            exit;
        }
        
        Affiliate::where('id',Session::get('user')->id)
                   ->update([
                      'razorpay_account_id'  => $funds_output['id'],
                      'razorpay_bank_detail' => json_encode([ 'contact'=>$contact_output,'funds'=>$funds_output ])
                   ]);
        
        return Redirect::back()->with('status','Bank Details Added Successfully.');
    }
}
