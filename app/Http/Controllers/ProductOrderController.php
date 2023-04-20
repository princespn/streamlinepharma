<?php

namespace App\Http\Controllers;

use App\Models\AccountCreditAffiliation;
use App\Models\order;
use App\Models\orderDetail;
use App\Models\ProductOrder;
use App\Models\OfferNormal;
use App\Models\AffiliatePaymentHistory;
use App\Models\ProductOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
class ProductOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $account_id = Session::get('user')->id;
		$allQuery = $request->all();
        $orderData = order::with(['orderDetails' => function ($query) {
            $query->with(['orderOffers' => function ($query) {
                $query->with('offer');
            }]);
        }])->where('account_id', $account_id);

		if (isset($allQuery['status']) && $allQuery['status']==1) {
            $orderData->where('orderAcceptance',1);
        }else if (isset($allQuery['status']) && $allQuery['status']==2) {
            $orderData->whereNull('shipyaariOrder');
            $orderData->where('orderAcceptance',1);
        }else if (isset($allQuery['status']) && $allQuery['status']) {
            $orderData->where('orderStatus', $allQuery['status']);
        }
        $orderList = $orderData->orderBy('id', 'desc')->get();
        // if($account_id == 2) {
        //     dd($orderList);
        // }
        return view('admin/income/productOrder/index',compact('orderList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductOrder  $productOrder
     * @return \Illuminate\Http\Response
     */
    public function show(ProductOrder $productOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductOrder  $productOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductOrder $productOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductOrder  $productOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductOrder $productOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductOrder  $productOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductOrder $productOrder)
    {
        //
    }

    public function affiliateLedger(Request $request)
    {
        $account_id = Session::get('user')->id;
        $rechargeList = AffiliatePaymentHistory::where('account_id',$account_id)->where('user_type','seller')->orderBy('created_at', 'asc')->get();
        return view('admin/income/affiliateLedger/index',compact('account_id','rechargeList'));
    }

    public function domainAffiliateLedger(Request $request,$accountId)
    {
        $account_id = $accountId;
        $rechargeList = AccountCreditAffiliation::where('account_id',$account_id)->orderBy('created_at', 'asc')->get();
        return view('admin/income/affiliateLedger/index',compact('account_id','rechargeList'));
    }
	public function initiateRefund(Request $request){
		$refund_transaction_id = time();
		DB::table('orders')
		->where('id', $request->pr_id)
        ->update(['refund_status' => 1,'refund_transaction_id'=>$refund_transaction_id]);
		$type_array = [
                       'RFD' => 'Duplicate/delayed payment',
					   'TNR' => 'Product/service no longer available',
					   'QFL' => 'Customer not satisfied',		              
                       'QNR' => 'Product lost/damaged',		              
                       'EWN' => 'Digital download issue',		              
                       'TAN' => 'Event was canceled/changed',
					   'PTH' => 'Problem not described above'
					   ];
		$account = Session::get('user');
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/refunds/');
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_HTTPHEADER,
					array("X-Api-Key:".$account->instamojoApiKey,
						  "X-Auth-Token:".$account->instamojoAuthToken));
		$payload = Array(
			'transaction_id'=> $refund_transaction_id,
			'payment_id' => $request->id,
			'type' => $request->refund_reason,
			'body' => $type_array[$request->refund_reason]
		);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
		$response = curl_exec($ch);
		curl_close($ch); 

		//echo $response;
		return array('error'=>false,'data' => $response);
	}
}
