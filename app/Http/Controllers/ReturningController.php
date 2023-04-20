<?php

namespace App\Http\Controllers;

use App\Models\Returning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class ReturningController extends Controller
{
    
    public function index() {

        $account_id = Session::get('user')->id;
        $returningList = Returning ::where('account_id',$account_id)->get();
        return view('admin/pages/returning/index',compact('returningList'));
    }
    
    public function create() {
        
        return view('admin/pages/returning/add');
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

            $shipping = Returning::insert($input);
            if($shipping)
            {
                return redirect('/admin/returning');

            } else {

                return back()->withErrors(['Something went wrong']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }
    
    public function show(Returning $returning) {
        //
    }
    
    public function edit(Returning $returning) {

        return view('admin/pages/returning/edit',compact('returning'));
    }

    public function update(Request $request, Returning $returning) {
        
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

            $returning = Returning::where('id',$returning->id)->where('account_id',Session::get('user')->id)->update($input);
            if($returning)
            {
                return redirect('/admin/returning');

            } else {

                return back()->withErrors(['Something went wrong']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }
    
    public function destroy(Returning $returning) {

        $result = $returning->delete();
        if($result == 1) {

            return redirect('/admin/returning');

        } else  {

            return back()->withErrors(['failed to delete']);
        }
    }
}
