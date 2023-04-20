<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employeeList = Employee :: get();
        return view('supperAdmin/restriction/index',compact('employeeList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supperAdmin/restriction/add');
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
        $input['password'] = bcrypt($input['password']);
        $rules = [
            'name' => 'required',
            'phone' => 'required|min:10|unique:accounts,phone|unique:affiliates,phone|unique:employees,phone',
            'email' => 'required|email|unique:accounts,email|unique:affiliates,email|unique:employees,email',
            'address' => 'required|max:150',
            'password' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {

            unset($input['_token']);

            $employee = Employee::insert($input);
           
            if($employee)
            {
                return redirect('/admin/employee');

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
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('supperAdmin/restriction/edit',compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $rules = [
            'name' => 'required',
            'phone' => 'required|min:10|unique:accounts,phone|unique:affiliates,phone',
            'email' => 'required|email|unique:accounts,email|unique:affiliates,email',
            'address' => 'required|max:150',
            'password' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {

            unset($input['_token']);
            unset($input['_method']);

            $employee = Employee::where('id', $employee->id)->update($input);  
           
            if($employee)
            {
                return redirect('/admin/employee');

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
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $result = $employee->forceDelete();

        if($result == 1) {

            return redirect('/admin/employee');

        } else  {

            return back()->withErrors(['failed to delete']);

        }
    }

    public function ChangePassword(Employee $employee)
    {
        return view('employee/changePassword/add');
    }

    public function employeChangePassword(Request $request)
    {
        $input = $request->all();

        $rules = [
            'password' => 'required|min:6',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
            
            $account_id = Session::get('user')->id;
            $input['password'] = bcrypt($input['password']);
            unset($input['cpassword']);
            unset($input['_token']);
            unset($input['_method']);

            $password = Employee::where('id',$account_id)->update($input);
            if($password)
            {
                $request->session()->flush();
                return redirect('/admin');

            } else {

                return back()->withErrors(['Something went wrong']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }

    }
}
