<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(order $order)
    {
        //
    }

    public function updateCourierDetails(Request $request)
    {
        $account_id = Session::get('user')->id;
        $input = $request->all();

        $orderNo = $input['orderNo'];
        $courierType = $input['courierType'];
        $courierLink = $input['courierLink'];
        $courierTracking = $input['courierTracking'];

        if($courierType == 1)
        {
            $lastOrder = order::where('orderNo', $orderNo)->where('account_id',$account_id)->first();
            $shipyaariData = json_decode($lastOrder->payLoad, true);
            //dd($shipyaariData);

            $payLoad =  json_encode($shipyaariData);
            $request_url = "https://seller.shipyaari.com/logistic/webservice/create_consignment_api.php";
            $post = curl_init();
            curl_setopt($post, CURLOPT_URL, $request_url);
            curl_setopt($post, CURLOPT_POST, TRUE);
            curl_setopt($post, CURLOPT_POSTFIELDS, $payLoad);
            curl_setopt($post, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($post, CURLOPT_HTTPHEADER, array('Accept:application/json' , 'Content-Type:application/json'));
            $response = curl_exec($post);
            //dd($response);

            curl_close($post);

            if($response){
                
                order::where('orderNo', $orderNo)->where('account_id',$account_id)->update(['courierType' => $courierType,'shipyaariOrder' => $response]);
            }

        } else {

            $shipyaariOrder = $courierLink.'#@#'.$courierTracking;
            order::where('orderNo', $orderNo)->where('account_id',$account_id)->update(['courierType' => $courierType,'shipyaariOrder' => $shipyaariOrder]);
        }

        return redirect('/admin/productOrder');
    }

    public function updateOrderStatus(Request $request,$orderNo)
    {
        $account_id = Session::get('user')->id;
        order::where('orderNo', $orderNo)->where('account_id',$account_id)->update(['orderStatus' => 4]);
        return redirect('/admin/productOrder');
    }
    
    public function orderPrint(Request $request,$orderNo)
    {
        $account = Session::get('user');
        $account_id = $account->id;

        $orderList = order :: with([
            'orderDetails'=>function($query) {
                $query->with(['inventoryPackaging','orderOffers'=>function($query) { $query->with('offer');}]);
            }
        ])->where('orderNo', $orderNo)->where('account_id',$account_id)->orderBy('id', 'desc')->first();
        
        //dd($orderList);
        return view('admin/income/productOrder/orderPrint',compact('account','orderList'));
    }

    public function orderAcceptance(Request $request,$orderNo)
    {
        $account_id = Session::get('user')->id;
        order::where('orderNo', $orderNo)->where('account_id',$account_id)->update(['orderAcceptance' => 1]);
        return redirect('/admin/productOrder');
    }

    public function orderReject(Request $request,$orderNo)
    {
        $account_id = Session::get('user')->id;
        order::where('orderNo', $orderNo)->where('account_id',$account_id)->update(['orderAcceptance' => 2]);
        return redirect('/admin/productOrder');
    }
}
