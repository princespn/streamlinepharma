<?php

namespace App\Http\Controllers;

use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class ShippingController extends Controller
{
    
    public function index() {

        $account_id = Session::get('user')->id;
        $shippingList = Shipping ::where('account_id',$account_id)->get();
        return view('admin/pages/shipping/index',compact('shippingList'));
    }

    public function create() {

        return view('admin/pages/shipping/add');
    }

    public function store(Request $request) {

        $input = $request->all();

        $rules = [
            'heading' => 'required',
            'description' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
            
            $input['account_id'] = Session::get('user')->id;
            unset($input['_token']);

            $shipping = Shipping::insert($input);
            if($shipping)
            {
                return redirect('/admin/shipping');

            } else {

                return back()->withErrors(['Something went wrong']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }

    public function show(Shipping $shipping) {
        //
    }

    public function edit(Shipping $shipping) {

        return view('admin/pages/shipping/edit',compact('shipping'));
    }

    public function update(Request $request, Shipping $shipping) {
        
        $input = $request->all();

        $rules = [
            'heading' => 'required',
            'description' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
            
            $input['account_id'] = Session::get('user')->id;
            unset($input['_token']);
            unset($input['_method']);

            $shipping = Shipping::where('id',$shipping->id)->where('account_id',Session::get('user')->id)->update($input);
            if($shipping)
            {
                return redirect('/admin/shipping');

            } else {

                return back()->withErrors(['Something went wrong']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }

    public function destroy(Shipping $shipping) {

        $result = $shipping->delete();
        if($result == 1) {

            return redirect('/admin/shipping');

        } else  {

            return back()->withErrors(['failed to delete']);
        }
    }
}
