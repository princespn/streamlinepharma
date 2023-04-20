<?php

namespace App\Http\Controllers;
use App\Models\MyKeyword;
use App\Models\Affiliate;
use App\Models\AdvanceProduct;
use App\Models\MyLink;
use App\Models\AccountCreditAffiliation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
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
		$pre_amount = 0;
		$amount = AccountCreditAffiliation::where('account_id',$account_id)
		          ->first();
		if($amount){
			$pre_amount = 0;
		}
        $code = Session::get('user')->code;
        $user = Affiliate::where('id',$account_id)->first();
		$affiliateKeywords = explode(',',$user->affiliateKeywords);
        $myLinkList = AdvanceProduct::
		              whereIn('advance_product.setting_id',$affiliateKeywords)
		              ->where('advance_product.is_affiliation','Yes')
		              ->where('advance_product.status','Active')
		              ->whereRaw(" uc_advance_product.affiliation_price <=  uc_account_credit_affiliations.amount")
					  ->leftJoin('account_credit_affiliations','account_credit_affiliations.account_id','=','advance_product.account_id')
					  ->get();

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
