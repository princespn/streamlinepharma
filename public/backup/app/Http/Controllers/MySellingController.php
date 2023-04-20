<?php

namespace App\Http\Controllers;

use App\Models\MySelling;
use App\Models\order;
use App\Models\orderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MySellingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account_id = Session::get('user')->id;

        $mySellingList = orderDetail :: with([
            'inventory_price',
            'order',
            'inventoryPackaging'
        ])->where('affiliate_id',$account_id)->get();
        //dd($mySellingList);

        return view('affiliate/mySelling/index',compact('mySellingList'));
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
     * @param  \App\Models\MySelling  $mySelling
     * @return \Illuminate\Http\Response
     */
    public function show(MySelling $mySelling)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MySelling  $mySelling
     * @return \Illuminate\Http\Response
     */
    public function edit(MySelling $mySelling)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MySelling  $mySelling
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MySelling $mySelling)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MySelling  $mySelling
     * @return \Illuminate\Http\Response
     */
    public function destroy(MySelling $mySelling)
    {
        //
    }
}
