<?php

namespace App\Http\Controllers;

use App\Models\AccountAffiliateKeywords;
use App\Models\AffiliateKeyword;
use App\Models\MyKeyword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class AccountAffiliateKeywordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account_id = Session::get('user')->id;
        $affiliateKeywordList = accountAffiliateKeywords::with('keyword')->where('account_id',$account_id)->get();
        //dd($affiliateKeywordList);
        return view('admin/product/affiliateKeyword/index',compact('affiliateKeywordList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $input = $request->all();
        $search = $input['search'];
        
        $affiliateKeywordList = AffiliateKeyword ::where('keyword', 'like', '%' . $search . '%')-> get();
        //dd($affiliateKeywordList);
        return view('admin/product/affiliateKeyword/add',compact('affiliateKeywordList'));
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
        $account_id = Session::get('user')->id;

        $rules = [
            'keyword_id' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
            
            $keyword_id = $input['keyword_id'];
            unset($input['_token']);

            $myKeywordJSON = array();
            foreach ($keyword_id as $key => $value) {

                $myKeywordList = accountAffiliateKeywords::where('account_id',$account_id)->where('keyword_id',$value)->get();
                if(count($myKeywordList)==0) {

                    array_push($myKeywordJSON, ['account_id' => $account_id, 'keyword_id' => $value]);
                }
            }
            
            $myKeyword = accountAffiliateKeywords::insert($myKeywordJSON);
            if($myKeyword)
            {
                return redirect('/admin/accountAffiliateKeyword');

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
     * @param  \App\Models\accountAffiliateKeywords  $accountAffiliateKeywords
     * @return \Illuminate\Http\Response
     */
    public function show(accountAffiliateKeywords $accountAffiliateKeywords)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\accountAffiliateKeywords  $accountAffiliateKeywords
     * @return \Illuminate\Http\Response
     */
    public function edit(accountAffiliateKeywords $accountAffiliateKeywords)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\accountAffiliateKeywords  $accountAffiliateKeywords
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, accountAffiliateKeywords $accountAffiliateKeywords)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\accountAffiliateKeywords  $accountAffiliateKeywords
     * @return \Illuminate\Http\Response
     */
    public function destroy(accountAffiliateKeywords $accountAffiliateKeywords)
    {
        //
    }
}
