<?php

namespace App\Http\Controllers;

use App\Models\AffiliateKeyword;
use App\Models\MyKeyword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

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
        $myKeywordList = MyKeyword::with('keyword')->where('affiliate_id',$account_id)->get();
        //dd($myKeywordList);
        return view('affiliate/myKeyword/index',compact('myKeywordList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $affiliateKeywordList = AffiliateKeyword :: get();
        return view('affiliate/myKeyword/add',compact('affiliateKeywordList'));
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
            
            $affiliate_id = Session::get('user')->id;
            $keyword_id = $input['keyword_id'];
            unset($input['_token']);

            $myKeywordJSON = array();
            foreach ($keyword_id as $key => $value) {

                $myKeywordList = MyKeyword::where('affiliate_id',$account_id)->where('keyword_id',$value)->get();
                if(count($myKeywordList)==0) {

                    array_push($myKeywordJSON, ['affiliate_id' => $affiliate_id, 'keyword_id' => $value]);
                }
            }
            
            $myKeyword = MyKeyword::insert($myKeywordJSON);
            if($myKeyword)
            {
                return redirect('/admin/myKeyword');

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
