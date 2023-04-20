<?php

namespace App\Http\Controllers;

use App\Models\AccountCreditAffiliation;
use App\Models\order;
use App\Models\orderDetail;
use App\Models\ProductOrder;
use App\Models\OfferNormal;
use App\Models\ProductOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account_id = Session::get('user')->id;
        $orderList = order :: with(['orderDetails'=>function($query){ $query->with(['orderOffers'=>function($query) { $query->with('offer');}]);}])->where('account_id',$account_id)->orderBy('id', 'desc')->get();
        
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
        $rechargeList = AccountCreditAffiliation::where('account_id',$account_id)->orderBy('created_at', 'asc')->get();
        return view('admin/income/affiliateLedger/index',compact('account_id','rechargeList'));
    }

    public function domainAffiliateLedger(Request $request,$accountId)
    {
        $account_id = $accountId;
        $rechargeList = AccountCreditAffiliation::where('account_id',$account_id)->orderBy('created_at', 'asc')->get();
        return view('admin/income/affiliateLedger/index',compact('account_id','rechargeList'));
    }
}
