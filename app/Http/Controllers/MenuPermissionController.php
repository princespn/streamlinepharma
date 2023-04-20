<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
use Validator;
use Redirect;
use App\Models\Account;

class MenuPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id='')
    {
        $emp = Account::where('type','3')->get();
        $permission=DB::table('menu_permission')->where('emp_id',$id)->first();
        return view('supperAdmin/Permission/given_permission')->with('emp',$emp)->with('permission',$permission);
    }
    public function give_menu_permission(Request $request){
        DB::table('menu_permission')->updateOrInsert(
            ['emp_id'=>$request->employee],
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
        return Redirect::back()->with('status','Addedd Successfully');
      
        

    }

  
    
}
