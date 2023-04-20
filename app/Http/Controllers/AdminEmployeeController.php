<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\AdminEmployee;
use App\Models\Account;
use Validator;
use DB;
use Redirect;
use Illuminate\Support\Facades\Hash;

class AdminEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emp = Account::where('status','1')->get();
        $data=DB::table('description')->where('status','1')->get();
        return view('admin/employee/create_employee')->with('data',$data)->with('emp',$emp);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       
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
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
    }
    public function  view_employee(){
        
        $emp = Account::where('type','3')->get();
        return view('admin/employee/view_employee')->with('emp',$emp);
    }
    public function set_employee(Request $request){
        $password = rand();
        $count=Account::where('email',$request->employee_email)->orWhere('phone',$request->employee_mobile)->count();
        if($count >= 1){
            return Redirect::back()->with('error','Duplicate data not allowed.');
        }else{
                # save employee ercord account table
                $emp_id=Account::insertGetId(['title'=>$request->employee_name,
                'email'=>$request->employee_email,
                'assigned_to'=>$request->assigned_to,
                'phone'=>$request->employee_mobile,
                'description'=>$request->description,
                'password'=>Hash::make($request->password),
                'type'=>'3',
                'administrator'=>Session::get('user')->id]);

                # give permission to access menu
                DB::table('menu_permission')->insert(
                    ['emp_id'=>$emp_id,
                    'dashboard'=>$request->dashboard =='on' ? '1':'0',
                    'approval'=>$request->approval =='on' ? '1':'0',
                    'product_approval'=>$request->approval =='on' ? ($request->product_approval =='on' ? '1':'0'):'0',
                    'reject_slider'=>$request->approval =='on' ? ($request->reject_slider =='on' ? '1':'0'):'0',
                    'affiliation'=>$request->affiliation =='on' ? '1':'0',
                    'affiliate'=>$request->affiliation =='on' ? ($request->affiliate =='on' ? '1':'0'):'0',
                    'affiliate_keywords'=>$request->affiliation =='on' ? ($request->affiliate_keywords =='on' ? '1':'0'):'0',
                    'credit_domain_affiliation_amt'=>$request->affiliation =='on' ? ($request->credit_domain_affiliation_amt =='on' ? '1':'0'):'0',
                    'affiliate_payment'=>$request->affiliation =='on' ? ($request->affiliate_payment =='on' ? '1':'0'):'0',
                    'account_and_currency'=>$request->account_and_currency =='on' ? '1':'0',
                    'account_listing'=>$request->account_and_currency =='on' ? ($request->account_listing =='on' ? '1':'0'):'0',
                    'currency_listing'=>$request->account_and_currency =='on' ? ($request->currency_listing =='on' ? '1':'0'):'0',
                    'advance_product_order'=>$request->account_and_currency =='on' ? ($request->advance_product_order =='on' ? '1':'0'):'0',
                    'advance_product_template'=>$request->account_and_currency =='on' ? ($request->advance_product_template =='on' ? '1':'0'):'0',
                    'view_advance_product_template'=>$request->account_and_currency =='on' ? ($request->view_advance_product_template =='on' ? '1':'0'):'0',
                    'permission'=>$request->permission =='on' ? '1':'0',
                    'employee_restriction'=>$request->permission =='on' ? ($request->employee_restriction =='on' ? '1':'0'):'0',
                    'employee_listing'=>$request->permission =='on' ? ($request->employee_listing =='on' ? '1':'0'):'0',
                    'action'=>$request->permission =='on' ? ($request->action =='on' ? '1':'0'):'0',
                    'pages'=>$request->permission =='on' ? ($request->pages =='on' ? '1':'0'):'0',
                    'employee'=>$request->employee =='on' ? '1':'0',
                    'create_view_emp'=>$request->employee =='on' ? ($request->create_view_emp =='on' ? '1':'0'):'0',
                    'setting'=>$request->setting =='on' ? '1':'0',
                    'add_desciption'=>$request->setting =='on' ? ($request->add_desciption =='on' ? '1':'0'):'0']
                );

                return Redirect::back()->with('status','Created Successfully.');
           
           
        }
       
    }
    public function edit_employee($id){
        $emp = Account::where('status','1')->get();
        $permission=DB::table('menu_permission')->where('emp_id',$id)->first();
        $data=DB::table('description')->where('status','1')->get();
        $edit_emp=Account::where('id',$id)->first();
        return view('admin/employee/edit_employee')->with('data',$data)->with('edit_emp',$edit_emp)->with('permission',$permission)->with('emp',$emp);

    }
    public function update_employee(Request $request){
        Account::where('id',$request->id)->update(['title'=>$request->employee_name,
        'email'=>$request->employee_email,
        'assigned_to'=>$request->assigned_to,
        'phone'=>$request->employee_mobile,
        'description'=>$request->description,
        'type'=>'3',
        'administrator'=>Session::get('user')->id]);

             # update give permission to access menu
             DB::table('menu_permission')->where('emp_id',$request->id)->update(
                ['dashboard'=>$request->dashboard =='on' ? '1':'0',
                'approval'=>$request->approval =='on' ? '1':'0',
                'product_approval'=>$request->approval =='on' ? ($request->product_approval =='on' ? '1':'0'):'0',
                'reject_slider'=>$request->approval =='on' ? ($request->reject_slider =='on' ? '1':'0'):'0',
                'affiliation'=>$request->affiliation =='on' ? '1':'0',
                'affiliate'=>$request->affiliation =='on' ? ($request->affiliate =='on' ? '1':'0'):'0',
                'affiliate_keywords'=>$request->affiliation =='on' ? ($request->affiliate_keywords =='on' ? '1':'0'):'0',
                'credit_domain_affiliation_amt'=>$request->affiliation =='on' ? ($request->credit_domain_affiliation_amt =='on' ? '1':'0'):'0',
                'affiliate_payment'=>$request->affiliation =='on' ? ($request->affiliate_payment =='on' ? '1':'0'):'0',
                'account_and_currency'=>$request->account_and_currency =='on' ? '1':'0',
                'account_listing'=>$request->account_and_currency =='on' ? ($request->account_listing =='on' ? '1':'0'):'0',
                'currency_listing'=>$request->account_and_currency =='on' ? ($request->currency_listing =='on' ? '1':'0'):'0',
                'advance_product_order'=>$request->account_and_currency =='on' ? ($request->advance_product_order =='on' ? '1':'0'):'0',
                'advance_product_template'=>$request->account_and_currency =='on' ? ($request->advance_product_template =='on' ? '1':'0'):'0',
                'view_advance_product_template'=>$request->account_and_currency =='on' ? ($request->view_advance_product_template =='on' ? '1':'0'):'0',
                'permission'=>$request->permission =='on' ? '1':'0',
                'employee_restriction'=>$request->permission =='on' ? ($request->employee_restriction =='on' ? '1':'0'):'0',
                'employee_listing'=>$request->permission =='on' ? ($request->employee_listing =='on' ? '1':'0'):'0',
                'action'=>$request->permission =='on' ? ($request->action =='on' ? '1':'0'):'0',
                'pages'=>$request->permission =='on' ? ($request->pages =='on' ? '1':'0'):'0',
                'employee'=>$request->employee =='on' ? '1':'0',
                'create_view_emp'=>$request->employee =='on' ? ($request->create_view_emp =='on' ? '1':'0'):'0',
                'setting'=>$request->setting =='on' ? '1':'0',
                'add_desciption'=>$request->setting =='on' ? ($request->add_desciption =='on' ? '1':'0'):'0']
            );
        return Redirect::back()->with('status','Update Successfully.');
    }
    public function status_update($status,$emp_id){
        if($status == 'Active'){
            Account::where('id',$emp_id)->update(['status'=>'1']);
            return Redirect::back()->with('status','Active Successfully.');
        }else{
            Account::where('id',$emp_id)->update(['status'=>'0']);
            return Redirect::back()->with('status','Deactive Successfully.');
        }
    }

    
   
    
}
