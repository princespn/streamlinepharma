<?php

namespace App\Http\Controllers;

use App\Models\AffiliatePayment;
use App\Models\order;
use App\Models\orderDetail;
use Illuminate\Http\Request;
use Validator;

class AffiliatePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mySellingList = orderDetail :: with([
            'inventory_price',
            'affiliate',
            'order'=> function ($query) {
                $query->with(['account']);
            }
        ])->whereNotNull('affiliate_id')->orderBy('affiliate_transaction_id', 'ASC')->get();
		//dd($mySellingList);
		
		return view('supperAdmin/affiliatePayment/index',compact('mySellingList'));
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
        $input = $request->all();
		//dd($input);
		
		$rules = [
            'transactionId' => 'required',
        ];
		
		$validation = Validator::make($input, $rules);
        if ($validation->passes()) {
                
            unset($input['_token']);

            $payment = orderDetail::where('id',$input['orderDetailId'])->update(['affiliate_transaction_id'=>$input['transactionId']]);
			
            if($payment)
            {
                return redirect('/admin/AffiliatePayment');

            } else {

                return back()->withErrors(['Something went wrong']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AffiliatePayment  $affiliatePayment
     * @return \Illuminate\Http\Response
     */
    public function show(AffiliatePayment $affiliatePayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AffiliatePayment  $affiliatePayment
     * @return \Illuminate\Http\Response
     */
    public function edit(AffiliatePayment $affiliatePayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AffiliatePayment  $affiliatePayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AffiliatePayment $affiliatePayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AffiliatePayment  $affiliatePayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(AffiliatePayment $affiliatePayment)
    {
        //
    }
}
