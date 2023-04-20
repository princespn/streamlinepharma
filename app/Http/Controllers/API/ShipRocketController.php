<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\AdvanceProductOrder;
use App\Models\AffiliatePaymentHistory;
use App\Models\Affiliate;
class ShipRocketController extends Controller
{
    public function shiprockerWebHook(Request $request){
		$data = file_get_contents('php://input');
		DB::table('webhook')->insert(['data'=>$data]);
		$data = json_decode($data,true);
		$in_array = ['shirocketWebHook'=>$data];
		if($data['current_status']=='DELIVERED'){
			$in_array['status'] = 7;
			$order = AdvanceProductOrder::where('order_id',$data['order_id'])->whereNotNull('aff_id')->first();
			if($order){
                $payment = AffiliatePaymentHistory::where('reference_id',$data['order_id'])
			                                       ->where('user_type','affiliate')
												   ->where('term','On Order Delivered')
												   ->where('status',0)
												   ->sum('amount');
				if($payment>0){
					$aff_deatil = Affiliate::where('code', $order->aff_id)->first();
					if($aff_deatil->razorpay_account_id!=Null){
                        $ref_pay_array = [
                                            "account_number" => "4564563058857171",
                                            "fund_account_id" => $aff_deatil->razorpay_account_id,
                                            "amount" => ($payment*100),
                                            "currency" => "INR",
                                            "mode" => "IMPS",
                                            "purpose" => "payout",
                                            "queue_if_low_balance" => true,
                                            "reference_id" =>$data['order_id'],
                                            "narration" => $data['order_id'].' AFF Payment'
                                        ];
                        
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL,"https://api.razorpay.com/v1/payouts");
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_USERPWD, env('RAZORPAY_X_KEY').':'.env('RAZORPAY_X_SECRET'));
                        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($ref_pay_array));
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $server_output = curl_exec($ch);
                        
                        //var_dump($server_output);exit;
                        curl_close ($ch);
						AffiliatePaymentHistory::where('reference_id',$data['order_id'])
												   ->where('term','On Order Delivered')
												   ->where('status',0)
												   ->update(['status'=>1]);
                    }
				}
			}
		}
		AdvanceProductOrder::where('order_id',$data['order_id'])->update($in_array);
		return ['error'=>false];
	}
	public function delhiveryWebHook(){
		return ['error'=>false,'message'=>'Data saved successfully.'];
	}
}
