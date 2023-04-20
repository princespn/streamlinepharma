<?php

namespace App\Http\Controllers;

use App\Models\AffiliateKeyword;
use App\Models\Account;
use App\Models\Affiliate;
use App\Models\AdvanceProductSetting;
use App\Models\MyKeyword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;
use Redirect;

class MyKeywordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account_id = Session::get('user')->id;
        $data = Affiliate::where('id',$account_id)->first();
		$myKeywordList = AdvanceProductSetting::whereIn('id',explode(',',$data->affiliateKeywords))->get();
        return view('affiliate/myKeyword/index',compact('myKeywordList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		
		$data = Affiliate::where('id',Session::get('user')->id)->first();
		
        $affiliateKeywordList = AdvanceProductSetting :: get();
		$subscribed = explode(',',$data->affiliateKeywords);
        return view('affiliate/myKeyword/add',compact('affiliateKeywordList','subscribed'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $account_id = Session::get('user')->id;
        Affiliate::where('id',$account_id)->update([
		  'affiliateKeywords'=>implode(',',$request->keyword_id)
		]);
		return Redirect::back()->with(['status', 'Subscribed Successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MyKeyword  $myKeyword
     * @return \Illuminate\Http\Response
     */
    public function show(MyKeyword $myKeyword)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MyKeyword  $myKeyword
     * @return \Illuminate\Http\Response
     */
    public function edit(MyKeyword $myKeyword)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MyKeyword  $myKeyword
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MyKeyword $myKeyword)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MyKeyword  $myKeyword
     * @return \Illuminate\Http\Response
     */
    public function destroy(MyKeyword $myKeyword)
    {
        $result = $myKeyword->delete();
        if($result == 1) {

            return redirect('/admin/myKeyword');

        } else  {

            return back()->withErrors(['failed to delete']);
        }
    }
}
