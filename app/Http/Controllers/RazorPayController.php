<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Redirect;
class RazorPayController extends Controller
{
    public function razorpay_plan(){
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
		$data = curl_exec($ch);

		if (empty($data) OR (curl_getinfo($ch, CURLINFO_HTTP_CODE != 200))) {
		   $data = FALSE;
		   curl_close($ch);
		} else {
			$data = json_decode($data, TRUE);
			if(array_key_exists("error",$data)){
				echo $data['error']['description'];exit;
			}
			curl_close($ch);
			return view('/admin/razorpay/index')->with('data',$data);
		}
		
		
	}
	public function razorpay_plan_post(Request $request){
		$razorPayApiKey    = Session::get('user')->razorPayApiKey;
		$razorPayApiSecret = Session::get('user')->razorPayApiSecret;
		$ch = curl_init();
		$fields = array();
		$fields["period"]               = $request->period;
		$fields["interval"]             = $request->interval;
		$fields["item"]['name']         = $request->name;
		$fields["item"]['amount']       = $request->amount*100;
		$fields["item"]['currency']     = 'INR';
		$fields["item"]['description']  = $request->description;
		curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/plans');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_USERPWD, $razorPayApiKey.":".$razorPayApiSecret);
		$headers = array();
		$headers[] = 'Accept: application/json';
		$headers[] = 'Content-Type: application/json';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$data = curl_exec($ch);
		if (empty($data) OR (curl_getinfo($ch, CURLINFO_HTTP_CODE != 200))) {
		   $data = FALSE;
		} else {
			//return json_decode($data, TRUE);
			//var_dump($data);
		}
		curl_close($ch);
		return Redirect::back();

	}
	public function razorpay_subscription(){
		$razorPayApiKey    = Session::get('user')->razorPayApiKey;
		$razorPayApiSecret = Session::get('user')->razorPayApiSecret;
		$ch = curl_init();
		$fields = array();
		$fields["period"]               = 'weekly';
		$fields["interval"]             = 1;
		$fields["item"]['name']         = 'Test from Curl';
		$fields["item"]['amount']       = '200';
		$fields["item"]['currency']     = 'INR';
		$fields["item"]['description']  = 'description';
		$fields["notes"]['notes_key_1'] = 'notes_key_1';
		$fields["notes"]['notes_key_2'] = 'notes_key_2';
		curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/plans');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		//curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_USERPWD, $razorPayApiKey.":".$razorPayApiSecret);
		$headers = array();
		$headers[] = 'Accept: application/json';
		$headers[] = 'Content-Type: application/json';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$data = curl_exec($ch);

		if (empty($data) OR (curl_getinfo($ch, CURLINFO_HTTP_CODE != 200))) {
		   $data = FALSE;
		   curl_close($ch);
		} else {
			$data = json_decode($data, TRUE);
			curl_close($ch);
			/*********************************************/
			$ch = curl_init();
			$fields = array();
			curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/subscriptions');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_USERPWD, $razorPayApiKey.":".$razorPayApiSecret);
			$headers = array();
			$headers[] = 'Accept: application/json';
			$headers[] = 'Content-Type: application/json';
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			$list = curl_exec($ch);

			
				$list = json_decode($list, TRUE);
				curl_close($ch);
			/*********************************************/
			return view('/admin/razorpay/subscription')->with('data',$data)->with('list',$list);
		}
		
	}
	public function razorpay_subscription_post(Request $request){
		$razorPayApiKey    = Session::get('user')->razorPayApiKey;
		$razorPayApiSecret = Session::get('user')->razorPayApiSecret;
		$ch = curl_init();
		$fields = array();
		$fields["plan_id"]              = $request->plan_id;
		$fields["total_count"]          = $request->total_count;
		curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/subscriptions');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_USERPWD, $razorPayApiKey.":".$razorPayApiSecret);
		$headers = array();
		$headers[] = 'Accept: application/json';
		$headers[] = 'Content-Type: application/json';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$data = curl_exec($ch);
		if (empty($data) OR (curl_getinfo($ch, CURLINFO_HTTP_CODE != 200))) {
		   $data = FALSE;
		} else {
			//return json_decode($data, TRUE);
			//var_dump($data);
		}
		curl_close($ch);
		return Redirect::back();
	}
}
