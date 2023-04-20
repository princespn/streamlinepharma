<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class AffiliateController extends Controller
{

    public function index() {

        $affiliateList = Affiliate :: get();
        return view('supperAdmin/affiliate/index',compact('affiliateList'));
    }

    public function create() {

        return view('supperAdmin/affiliate/add');
    }
    
    public function store(Request $request) {

        $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $code = "";
        for ($i = 0; $i < 11; $i++) {
            $code .= $chars[mt_rand(0, strlen($chars)-1)];
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['code'] = $code;

        $rules = [
            'code' => 'required|unique:affiliates',
            'name' => 'required',
            'phone' => 'required|min:10|unique:accounts,phone|unique:affiliates,phone',
            'email' => 'required|email|unique:accounts,email|unique:affiliates,email',
            'address' => 'required',
            'commission' => 'required',
            'password' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
                
            $input['account_id'] = Session::get('user')->id;

            unset($input['_token']);

            $affiliate = Affiliate::insert($input);
            if($affiliate)
            {
                return redirect('/admin/affiliate');

            } else {

                return back()->withErrors(['Something went wrong']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }
    
    public function show(Affiliate $affiliate) {
        //
    }
    
    public function edit(Affiliate $affiliate) {
        
        return view('supperAdmin/affiliate/edit',compact('affiliate'));
    }

    public function update(Request $request, Affiliate $affiliate) {

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $rules = [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
            'commission' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
                
            unset($input['_token']);
            unset($input['_method']);

            $affiliate = Affiliate::where('id',$affiliate->id)->update($input);
            if($affiliate)
            {
                return redirect('/admin/affiliate');

            } else {

                return back()->withErrors(['Something went wrong']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }

    public function destroy(Affiliate $affiliate) {

        $result = $affiliate->delete();
        if($result == 1) {

            return redirect('/admin/affiliate');

        } else  {

            return back()->withErrors(['failed to delete']);
        }
    }
}
