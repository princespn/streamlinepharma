<?php

namespace App\Http\Controllers;

use App\Models\VendorKyc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class VendorKycController extends Controller
{

    public function index() {

        $vendorKycList = VendorKyc:: get();
        //dd($vendorKycList);
        return view('admin/income/vendorKyc/index',compact('vendorKycList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        return view('admin/income/vendorKyc/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $input = $request->all();

        $rules = [
            'companyName' => 'required',
            'companyType' => 'required',
            'kycAddress' => 'required',
            'kycAddressProof' => 'required',
            'tanNumber' => 'required',
            'tanImage' => 'required',
            'accountHolderName' => 'required',
            'accountNumber' => 'required',
            'ifscCode' => 'required',
            'bankName' => 'required',
            'bankAddress' => 'required',
            'bankProofName' => 'required',
            'bankProofImage' => 'required',
            'blankCheck' => 'required',
            'blankCheckImage' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {

            $input['account_id'] = Session::get('user')->id;
            unset($input['_token']);
            
            $vendorKyc = VendorKyc::insert($input);
            if($vendorKyc)
            {
                return redirect('/admin/vendorKyc');

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
     * @param  \App\Models\VendorKyc  $vendorKyc
     * @return \Illuminate\Http\Response
     */
    public function show(VendorKyc $vendorKyc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VendorKyc  $vendorKyc
     * @return \Illuminate\Http\Response
     */
    public function edit(VendorKyc $vendorKyc) {

        return view('admin/income/vendorKyc/edit',compact('vendorKyc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VendorKyc  $vendorKyc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VendorKyc $vendorKyc)
    {
        $input = $request->all();
        
        $rules = [
            'companyName' => 'required',
            'companyType' => 'required',
            'kycAddress' => 'required',
            'kycAddressProof' => 'required',
            'tanNumber' => 'required',
            'tanImage' => 'required',
            'accountHolderName' => 'required',
            'accountNumber' => 'required',
            'ifscCode' => 'required',
            'bankName' => 'required',
            'bankAddress' => 'required',
            'bankProofName' => 'required',
            'bankProofImage' => 'required',
            'blankCheck' => 'required',
            'blankCheckImage' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
                
            unset($input['_token']);
            unset($input['_method']);

            $vendorKyc = VendorKyc ::where('id',$vendorKyc->id)->update($input);
            if($vendorKyc)
            {
                return redirect('/admin/vendorKyc');

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
     * @param  \App\Models\VendorKyc  $vendorKyc
     * @return \Illuminate\Http\Response
     */
    public function destroy(VendorKyc $vendorKyc)
    {
        $result = $vendorKyc->delete();
        if($result == 1) {

            return redirect('/admin/label');

        } else  {

            return back()->withErrors(['failed to delete']);
        }
    }

    public function approveKYC(Request $request,$kycId)
    {
        $approval = VendorKyc::find($kycId);
        if($approval) {

            $approval->kycStatus = 1;
            $approval->save();
            return redirect('/admin/vendorKyc');

        } else {
            return back()->withErrors(['KYC not found.']);
        }
    }
}
