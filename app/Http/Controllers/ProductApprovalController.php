<?php

namespace App\Http\Controllers;

use App\Models\ProductInventory;
use App\Models\ProductQc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;


class ProductApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $approvalList = ProductInventory::with([
            'product' => function ($query) {
                $query->with('account');

        }])->where('qc',1)->get();
        // dd($approvalList);

        return view('supperAdmin/productApproval/index',compact('approvalList'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Approval $approval)
    {
       //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Approval $approval)
    {
        //
    }

    public function productApprovalConfirm(Request $request,$inventoryId)
    {
        $approval = ProductInventory::find($inventoryId);
        if($approval){

            $approval->qc = 4;
            $approval->save();
            return redirect('/admin/productApproval');

        } else {
            return back()->withErrors(['Product not found.']);
        }
    }

    public function productApprovalQcMSG(Request $request) {

        $input = $request->all();
        
        $rules = [
            'description' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {

            unset($input['_token']);

            $productQc = ProductQc::create($input);

            if ($productQc) {

                $QcData =  ['qc' => 2];

                ProductInventory::where('id', $input['inventory_id'])->update($QcData);
                
                return redirect('/admin/productApproval');


            } else {

                return back()->withErrors(['Something went wrong']);
            }
        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }
}
