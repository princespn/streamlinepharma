<?php

namespace App\Http\Controllers;

use App\Models\changePassword;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Account;
use Validator;

class ChangePasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/changePassword/add');
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
        $input = $request->all();

        $rules = [
            //'password' => 'required',
            'password' => 'required|min:6',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
            
            $account_id = Session::get('user')->id;
            $input['password'] = bcrypt($input['password']);
            unset($input['cpassword']);
            unset($input['_token']);
            unset($input['_method']);

            $password = Account::where('id',$account_id)->update($input);
            if($password)
            {
                $request->session()->flush();
                return redirect('/admin/');

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
     * @param  \App\Models\changePassword  $changePassword
     * @return \Illuminate\Http\Response
     */
    public function show(changePassword $changePassword)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\changePassword  $changePassword
     * @return \Illuminate\Http\Response
     */
    public function edit(changePassword $changePassword)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\changePassword  $changePassword
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, changePassword $changePassword)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\changePassword  $changePassword
     * @return \Illuminate\Http\Response
     */
    public function destroy(changePassword $changePassword)
    {
        //
    }
}
