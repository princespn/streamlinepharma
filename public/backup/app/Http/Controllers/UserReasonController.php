<?php

namespace App\Http\Controllers;

use App\Models\UserReason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class UserReasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account_id = Session::get('user')->id;
        $userReasonList = UserReason ::where('account_id',$account_id)->get();
        return view('admin/product/userReason/index',compact('userReasonList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/product/userReason/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $rules = [
            'type' => 'required',
            'title' => 'required',
        ];
        //dd($input);
        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
            
            $input['account_id'] = Session::get('user')->id;
            
           //dd($input);
            unset($input['_token']);

            $userReason = UserReason::insert($input);
            if($userReason)
            {
                return redirect('/admin/userReason');

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
     * @param  \App\Models\UserReason  $userReason
     * @return \Illuminate\Http\Response
     */
    public function show(UserReason $userReason)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserReason  $userReason
     * @return \Illuminate\Http\Response
     */
    public function edit(UserReason $userReason)
    {
        return view('admin/product/userReason/edit',compact('userReason'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserReason  $userReason
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserReason $userReason)
    {
        $input = $request->all();
        
        $rules = [
            'type' => 'required',
            'title' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
            
            $input['account_id'] = Session::get('user')->id;
            unset($input['_token']);
            unset($input['_method']);

            $userReason = UserReason::where('id',$userReason->id)->update($input); //->where('accounte_id',Session::get('user')->id)
            if($userReason)
            {
                return redirect('/admin/userReason');

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
     * @param  \App\Models\UserReason  $userReason
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserReason $userReason)
    {
        $result = $userReason->delete();
        if($result == 1) {

            return redirect('/admin/userReason');

        } else  {

            return back()->withErrors(['failed to delete']);
        }
    }
}
