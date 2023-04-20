<?php

namespace App\Http\Controllers;

use App\Models\Privacy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class PrivacyController extends Controller
{
    
    public function index() {

        $account_id = Session::get('user')->id;
        $privacyList = Privacy ::where('account_id',$account_id)->get();
        return view('admin/pages/privacy/index',compact('privacyList'));
    }

    public function create() {

        return view('admin/pages/privacy/add');
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

            $privacy = Privacy::insert($input);
            if($privacy)
            {
                return redirect('/admin/privacy');

            } else {

                return back()->withErrors(['Something went wrong']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }

    public function show(Privacy $privacy) {
        //
    }

    public function edit(Privacy $privacy) {

        return view('admin/pages/privacy/edit',compact('privacy'));
    }

    public function update(Request $request, Privacy $privacy) {

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

            $privacy = Privacy::where('id',$privacy->id)->where('account_id',Session::get('user')->id)->update($input);
            if($privacy)
            {
                return redirect('/admin/privacy');

            } else {

                return back()->withErrors(['Something went wrong']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }

    public function destroy(Privacy $privacy) {
        
        $result = $privacy->delete();
        if($result == 1) {

            return redirect('/admin/privacy');

        } else  {

            return back()->withErrors(['failed to delete']);
        }
    }
}
