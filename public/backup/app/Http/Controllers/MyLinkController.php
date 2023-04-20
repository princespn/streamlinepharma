<?php

namespace App\Http\Controllers;
use App\Models\MyKeyword;
use App\Models\MyLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MyLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account_id = Session::get('user')->id;
        $code = Session::get('user')->code;

        $myLinkList = MyKeyword::with(['productAffiliationKeyword' => function($query) {
            $query->with(
                ['productInventory' => function ($query) {
                
                $query->with(['productPrice' , 'product' => function($query){
                    $query->with(['account']);
                }]);

            }]);
        }])->where('affiliate_id',$account_id)->get();

        // dd($myLinkList);

        return view('affiliate/myLink/index',compact('myLinkList','code'));
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
     * @param  \App\Models\MyLink  $myLink
     * @return \Illuminate\Http\Response
     */
    public function show(MyLink $myLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MyLink  $myLink
     * @return \Illuminate\Http\Response
     */
    public function edit(MyLink $myLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MyLink  $myLink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MyLink $myLink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MyLink  $myLink
     * @return \Illuminate\Http\Response
     */
    public function destroy(MyLink $myLink)
    {
        //
    }
}
