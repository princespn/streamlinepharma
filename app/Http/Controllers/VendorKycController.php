<?php

namespace App\Http\Controllers;

use App\Models\VendorKyc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Models\Account;
use Redirect;

class VendorKycController extends Controller
{

    public function index() {

        $vendorKycList = VendorKyc:: get();
        //dd($vendorKycList);
		$account_id = Session::get('user')->id;
		$data = Account::where('id',$account_id)->first();
        return view('admin/income/vendorKyc/index',compact('vendorKycList','data'));
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
	public function updateKyc(Request $request){
		$allowed = ['jpeg','jpg','pdf','png'];
		$error = [];
		$account_id = Session::get('user')->id;
		$data = [
		         'kyc_gstin'=> $request->kyc_gstin,
		         'kyc_pan'=> $request->kyc_pan,
				];
		if($request->hasFile('kyc_gstin_certificate')){
		  $file = $request->file('kyc_gstin_certificate');
		  $ext  = $file->getClientOriginalExtension();
		  if(in_array(strtolower($ext),$allowed)){
			  $new_name = "kyc_gstin_".$account_id.'_'.time().'.'.$ext;
			  $file->move("kyc",$new_name);
			  $data['kyc_gstin_certificate'] = $new_name;
		  }else{
			  $error['kyc_gstin_'] = 'invalid file for  gstin certificate, '.' extension '.$ext.' not allowed';
		  }
		}
		if($request->hasFile('kyc_pan_certificate')){
		  $file = $request->file('kyc_pan_certificate');
		  $ext  = $file->getClientOriginalExtension();
		  if(in_array(strtolower($ext),$allowed)){
			  $new_name = "kyc_pan".$account_id.'_'.time().'.'.$ext;
			  $file->move("kyc",$new_name);
			  $data['kyc_pan_certificate'] = $new_name;
		  }else{
			  $error['kyc_pan'] = 'invalid file for is invalid for  pan certificate, '.' extension '.$ext.' not allowed';
		  }
		}
		if($request->hasFile('kyc_authorized_signatory')){
		  $file = $request->file('kyc_authorized_signatory');
		  $ext  = $file->getClientOriginalExtension();
		  if(in_array(strtolower($ext),$allowed)){
			  $new_name = "kyc_authorized".$account_id.'_'.time().'.'.$ext;
			  $file->move("kyc",$new_name);
			  $data['kyc_authorized_signatory'] = $new_name;
		  }else{
			  $error['kyc_authorized'] = 'invalid file for is invalid for  authorized signatory, '.' extension '.$ext.' not allowed';
		  }
		}
		Account::where('id',$account_id)
		         ->update($data);
		return Redirect::back()->with('status','Updated Successfully.')->withErrors($error);
	}
}
