<?php

namespace App\Http\Controllers;

use App\Models\ProductInquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductInquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account_id = Session::get('user')->id;
        $inquiryList = ProductInquiry::with('productvariations')->where('account_id',$account_id)->get();
        return view('admin/income/productInquiry/index',compact('inquiryList'));
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
     * @param  \App\Models\ProductInquiry  $productInquiry
     * @return \Illuminate\Http\Response
     */
    public function show(ProductInquiry $productInquiry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductInquiry  $productInquiry
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductInquiry $productInquiry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductInquiry  $productInquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductInquiry $productInquiry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductInquiry  $productInquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductInquiry $productInquiry)
    {
        //
    }
}
