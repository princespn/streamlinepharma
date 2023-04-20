<?php

namespace App\Http\Controllers;

use App\Models\GeneralInquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GeneralInquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account_id = Session::get('user')->id;
        $inquiryList = GeneralInquiry::where('account_id',$account_id)->get();
        return view('admin/users/generalInquiry/index',compact('inquiryList'));
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GeneralInquiry  $generalInquiry
     * @return \Illuminate\Http\Response
     */
    public function show(GeneralInquiry $generalInquiry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GeneralInquiry  $generalInquiry
     * @return \Illuminate\Http\Response
     */
    public function edit(GeneralInquiry $generalInquiry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GeneralInquiry  $generalInquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GeneralInquiry $generalInquiry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GeneralInquiry  $generalInquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy(GeneralInquiry $generalInquiry)
    {
        //
    }
}
