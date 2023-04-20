<?php

namespace App\Http\Controllers;

use App\Models\OfferNormal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class OfferNormalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account_id = Session::get('user')->id;
        $offerNormalList = OfferNormal ::where('account_id',$account_id)->get();
        return view('admin/offers/offerNormal/index',compact('offerNormalList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/offers/offerNormal/add');
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

        $rules = [
            'website_url_image' => 'required',
            'mobile_url_image' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'couponCode' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
            
            $input['account_id'] = Session::get('user')->id;
            unset($input['_token']);

            $offerNormal = OfferNormal::insert($input);
            if($offerNormal)
            {
                return redirect('/admin/offerNormal');

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
     * @param  \App\Models\OfferNormal  $offerNormal
     * @return \Illuminate\Http\Response
     */
    public function show(OfferNormal $offerNormal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OfferNormal  $offerNormal
     * @return \Illuminate\Http\Response
     */
    public function edit(OfferNormal $offerNormal)
    {
        return view('admin/offers/offerNormal/edit',compact('offerNormal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OfferNormal  $offerNormal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OfferNormal $offerNormal)
    {
        $input = $request->all();

        $rules = [
            'website_url_image' => 'required',
            'mobile_url_image' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'couponCode' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
            
            $input['account_id'] = Session::get('user')->id;
            unset($input['_token']);
            unset($input['_method']);

            $offerNormal = OfferNormal::where('id',$offerNormal->id)->where('account_id',Session::get('user')->id)->update($input);
            if($offerNormal)
            {
                return redirect('/admin/offerNormal');

            } else {

                return back()->withErrors(['Something went wrong']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OfferNormal  $offerNormal
     * @return \Illuminate\Http\Response
     */
    public function destroy(OfferNormal $offerNormal)
    {
        $result = $offerNormal->delete();

        if($result == 1) {

            return redirect('/admin/offerNormal');

        } else  {

            return back()->withErrors(['failed to delete']);

        }
    }
}
