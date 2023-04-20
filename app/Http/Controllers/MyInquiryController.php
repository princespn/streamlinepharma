<?php

namespace App\Http\Controllers;

use App\Models\MyInquiry;
use Illuminate\Http\Request;

class MyInquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('affiliate/myInquiry/index');
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
     * @param  \App\Models\MyInquiry  $myInquiry
     * @return \Illuminate\Http\Response
     */
    public function show(MyInquiry $myInquiry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MyInquiry  $myInquiry
     * @return \Illuminate\Http\Response
     */
    public function edit(MyInquiry $myInquiry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MyInquiry  $myInquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MyInquiry $myInquiry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MyInquiry  $myInquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy(MyInquiry $myInquiry)
    {
        //
    }
}
