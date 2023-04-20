<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membership;
use App\Models\MembershipPage;
use App\Models\imageUpload;
use Illuminate\Support\Facades\Session;
use Redirect;
use DB;
class MembershipController extends Controller
{
    public function membership($id=''){
		$account_id = Session::get('user')->id;
		$data       = Membership::where('account_id',$account_id)->get();
		$return = view('admin.membership.index')->with('data',$data);
		if($id!=''){
			$mem_data       = Membership::where('account_id',$account_id)
			                          ->where('id',$id)
									  ->first();
			$return = $return->with('mem_data',$mem_data);
		}
		
		    $razorPayApiKey    = Session::get('user')->razorPayApiKey;
			$razorPayApiSecret = Session::get('user')->razorPayApiSecret;
			$ch = curl_init();
			$fields = array();
			curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/plans');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_USERPWD, $razorPayApiKey.":".$razorPayApiSecret);
			$headers = array();
			$headers[] = 'Accept: application/json';
			$headers[] = 'Content-Type: application/json';
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			$list = curl_exec($ch);

			
		   
		
		   if (empty($list) OR (curl_getinfo($ch, CURLINFO_HTTP_CODE != 200))) {
			   $list = FALSE;
		       curl_close($ch);
			} else {
				$list = json_decode($list, TRUE);
			    curl_close($ch);
				return $return->with('sub_list',$list);
			}
		
	}
	public function membership_action(Request $request){
		$account_id = Session::get('user')->id;
		$array = [
		            'name'=>$request->name,
		            'charges'=>$request->charges,
		            'charge_recurring'=>$request->charge_recurring,
		            'benifits'=>$request->benifits,
		            'shipping_charges'=>$request->shipping_charges,
		            'freebies_amount'=>$request->freebies_amount,
		            'freebies_scheduling'=>$request->freebies_scheduling,
		            'terms_and_conditions'=>$request->terms_and_conditions,
		            'razorpay_subscription_id'=>$request->razorpay_subscription_id,
					'account_id'=>$account_id
				 ];
		if(isset($request->id)){
			Membership::where('account_id',$account_id)
			            ->where('id',$request->id)
						->update($array);
			$message = 'Updated Successfully';
		}else{
			Membership::insert($array);
			$message = 'Added Successfully';
		}
		return Redirect::back()->with('status',$message);
	}
	
	public function membership_page($id=''){
		$account_id = Session::get('user')->id;
		$return     = view('admin.membership.membership_page');
		$ref_id = null;
		$imageUploadList = imageUpload ::where('account_id',$account_id)->where('ref_id',$ref_id)->orderBy('mediaType', 'ASC')->get();
		if($id!=''){
			$mem_data = MembershipPage::where('account_id',$account_id)
			                          ->where('id',$id)
									  ->first();
			$return = $return->with('mem_data',$mem_data);
		}
		$data = MembershipPage::where('account_id',$account_id)
			                    ->where('account_id',$account_id)
							    ->get();;
		return $return->with('data',$data)->with('imageUploadList',$imageUploadList);
	}
	public function membership_page_post(Request $request){
		$account_id = Session::get('user')->id;
		$array = ['title'=>$request->title,'sub_title'=>$request->sub_title,'image'=>$request->image,'sorting_order'=>$request->sorting_order];
		if(isset($request->id)){
			MembershipPage::where('account_id',$account_id)
			            ->where('id',$request->id)
						->update($array);
			$message = 'Updated Successfully';
		}else{
			MembershipPage::insert($array);
			$message = 'Added Successfully';
		}
		return Redirect::back()->with('status',$message);
	}
	public function referral_scheme_page($id=''){
		
		$account_id = Session::get('user')->id;
		$return     = view('admin.offers.referral.referral_scheme_page');
		if($id!=''){
			$mem_data = DB::table('referral_pages')->where('account_id',$account_id)
			                          ->where('id',$id)
									  ->first();
			$return = $return->with('mem_data',$mem_data);
		}
		$data = DB::table('referral_pages')->where('account_id',$account_id)
			                    ->where('account_id',$account_id)
							    ->get();
		$ref_id = null;
		$imageUploadList = imageUpload ::where('account_id',$account_id)->where('ref_id',$ref_id)->orderBy('mediaType', 'ASC')->get();
		return $return->with('data',$data)->with('imageUploadList',$imageUploadList);
	}
	public function referral_scheme_page_post(Request $request){
		$account_id = Session::get('user')->id;
		$array = ['title'=>$request->title,'sub_title'=>$request->sub_title,'image'=>$request->image,'sorting_order'=>$request->sorting_order];
		if(isset($request->id)){
			DB::table('referral_pages')->where('account_id',$account_id)
			            ->where('id',$request->id)
						->update($array);
			$message = 'Updated Successfully';
		}else{
			$array['account_id'] = $account_id;
			DB::table('referral_pages')->insert($array);
			$message = 'Added Successfully';
		}
		return Redirect::back()->with('status',$message);
	}
}
