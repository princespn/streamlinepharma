<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB; 
use Redirect; 
use App\Models\ReferralScheme;
use App\Models\Msgnotify;
use Illuminate\Support\Facades\Session;
class ReferralSchemeController extends Controller
{
    public function index(){
		return view('admin/offers/referral/index');
	}
	public function referral_scheme(Request $request){
		ReferralScheme::insert([
		'scheme_name'=>$request->scheme_name,
		'offering_product'=>$request->offering_product,
		'discount'=>$request->discount,
		'special_charges'=>$request->special_charges,
		'special_charges_label'=>$request->special_charges_label,
		'referral_wallet_benefits'=>$request->referral_wallet_benefits,
		'description'=>$request->description,
		'scheme_validity'=>$request->scheme_validity,
		'account_id'=>Session::get('user')->id
		]);
		return Redirect::back()->with('status','Created Successfully.');
	}
	public function view_referral_scheme(){
		$data = ReferralScheme::where('account_id',Session::get('user')->id)->get();
		//print_r($data);exit;
		$userList = DB::table('registers')->where('account_id',Session::get('user')->id)->get();
		return view('admin.offers.referral.view_referral_scheme')->with('data',$data)->with('userList',$userList);
	}
	public function referral_scheme_shared_with(Request $request){
		ReferralScheme::where('account_id',Session::get('user')->id)->where('id',$request->scheme_id)->update(['shared_with'=>implode(',',$request->shared_with)]);
		$scheme = ReferralScheme::where('account_id',Session::get('user')->id)->where('id',$request->scheme_id)->first();
	//	print_r($scheme);exit;

		if(isset($request->is_sms_send)){
		$found = Msgnotify::where('account_id', Session::get('user')->id)->where('msg_type', '7')->first();
		
		$reg = DB::table('registers')
		           ->select(DB::Raw("group_concat(phone) as phone"))
		           ->whereIn('id',$request->shared_with)
				   ->first();
		//echo $reg->phone;

		$sign_up_message = $found->messages;
	   // $message = urlencode($sign_up_message);
		$message = $sign_up_message;

		$message = str_replace('[Product_Link]', 'https://sdcollection.in/detail/'.$scheme->offering_product,$message);
				
		$message = str_replace('[Referral Scheme Header]',$scheme->scheme_name,$message);
		$message = urlencode($message);
		/************************************/
		        $account = DB::table('accounts')->where('id',Session::get('user')->id)->first();
				//dd($account);exit;
                $replace = str_replace('setUsername', $account->SMSUserName, $account->SMSApi);
                $replace1 = str_replace('setPassword', $account->SMSUserPassword, $replace);
                $replace2 = str_replace('setSenderId', $account->SMSUserSenderId, $replace1);
                $replace3 = str_replace('setPhone', $reg->phone, $replace2);
                $replace4 = str_replace('setMessage', $message, $replace3);
                $replace5 = str_replace('setTEMPLATEID', $found->template_id,$replace4);
				
				
              
			  	//echo $replace5; exit;
			 	
               // $url = urlencode($replace5);
               // dd($url);

                $post = curl_init();
                curl_setopt($post, CURLOPT_URL, $replace5);
                curl_setopt($post, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($post, CURLOPT_CUSTOMREQUEST, 'GET');
                $response = curl_exec($post);
                curl_close($post);
			
              // $result = json_decode($response, true);
			  $result = $response;
				//var_dump($result);
				
		
		//exit;
		}
		return Redirect::back()->with('status','Shared Successfully.');
	}
	public function referral_scheme_delete($id){
		ReferralScheme::where('account_id',Session::get('user')->id)->whereRaw("md5(id) = '".$id."'")->delete();
		return Redirect::back()->with('status','Deleted Successfully.');
	}
	public function referral_scheme_status($id,$status){
		ReferralScheme::where('account_id',Session::get('user')->id)->whereRaw("md5(id) = '".$id."'")->update(['status'=>$status]);
		return Redirect::back()->with('status','Deleted Successfully.');
	}

}
