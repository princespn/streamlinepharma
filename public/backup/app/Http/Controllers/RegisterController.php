<?php

namespace App\Http\Controllers;

use App\Models\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account_id = Session::get('user')->id;
        $registerList = Register ::where('account_id',$account_id)->get();
        return view('admin/users/register/index',compact('registerList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/users/register/add');
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
            'name' => 'required|max:50',
            'phone' => 'required|unique:registers',
            'email' => 'required|unique:registers',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
            
            $input['account_id'] = Session::get('user')->id;
            $input['password'] = bcrypt($input['password']);

            unset($input['_token']);

            $register = Register::insert($input);
            if($register)
            {
                return redirect('/admin/register');

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
     * @param  \App\Models\Register  $register
     * @return \Illuminate\Http\Response
     */
    public function show(Register $register)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Register  $register
     * @return \Illuminate\Http\Response
     */
    public function edit(Register $register)
    {
       return view('admin/users/register/edit',compact('register'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Register  $register
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Register $register)
    {
        $input = $request->all();
        
        $input['account_id'] = Session::get('user')->id;
        $input['password'] = bcrypt($input['password']);
        unset($input['_token']);
        unset($input['_method']);

        $register = Register::where('id',$register->id)->update($input);
        if($register)
        {
            return redirect('/admin/register');

        } else {

            return back()->withErrors(['Something went wrong']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Register  $register
     * @return \Illuminate\Http\Response
     */
    public function destroy(Register $register)
    {
        //
    }
}
