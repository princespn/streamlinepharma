<?php

namespace App\Http\Controllers;

use App\Models\EmpRestriction;
use App\Models\Employee;
use App\Models\Page;
use App\Models\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;

class EmpRestrictionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empRestrictionList = EmpRestriction::get();
        return view('supperAdmin/empRestriction/index',compact('empRestrictionList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employeeList = Employee::get();
        $pageList = Page::get();
        $actionList = Action::get();
        return view('supperAdmin/empRestriction/add',compact('employeeList','pageList','actionList'));
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
            'employee_id' => 'required',
            'page_id' => 'required',
            'action_id' => 'required',
        ];       

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
            unset($input['_token']);

            $empRestriction = EmpRestriction::insert($input);  

            if($empRestriction)
            {
                return redirect('/admin/empRestriction');

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
     * @param  \App\Models\Emp_restriction  $emp_restriction
     * @return \Illuminate\Http\Response
     */
    public function show(EmpRestriction $empRestriction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Emp_restriction  $emp_restriction
     * @return \Illuminate\Http\Response
     */
    public function edit(EmpRestriction $empRestriction)
    {
        $employeeList = Employee::get();
        $pageList = Page::get();
        $actionList = Action::get();
        return view('supperAdmin/empRestriction/edit',compact('employeeList','pageList','actionList','empRestriction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Emp_restriction  $emp_restriction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmpRestriction $empRestriction)
    {
        $empRestrictionId = $empRestriction->id;

        $input = $request->all();

        $rules = [
            'employee_id' => 'required',
            'page_id' => 'required',
            'action_id' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {            
           
            unset($input['_token']);
            unset($input['_method']);
            
            $empRestriction = EmpRestriction::where('id', $empRestrictionId)->update($input);   
                      
            if($empRestriction)
            {
                return redirect('/admin/empRestriction');

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
     * @param  \App\Models\EmpRestriction  $empRestriction
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmpRestriction $empRestriction)
    {
        $result = $empRestriction->forceDelete();

        if($result == 1) {

            return redirect('/admin/empRestriction');

        } else  {

            return back()->withErrors(['failed to delete']);

        }
    }
}
