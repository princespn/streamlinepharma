<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\Register;
use App\Models\Account;
use App\Models\RegisterAddress;
use App\Models\Coupon;
use App\Models\ForeSaleX;
use App\Http\Controllers\ForeSaleXController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;
use DB;

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
        $data = Account::where('id',Session::get('user')->id)->first();
        $array = [];
        if($data->users_listing_coloumn!=Null){
            $array = explode(',',$data->users_listing_coloumn);
        }
        $registerList = Register::where('account_id',$account_id)->get();
        return view('admin/users/register/index',compact('registerList'))->with('array',$array);
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
    public function show(Register $register,$id)
    {
        $account=Register::find($id);
        $account_id = Session::get('user')->id;;
        $orderData = order::with(['orderDetails' => function ($query) {
            $query->with(['orderOffers' => function ($query) {
                $query->with('offer');
            }]);
        }])->where('account_id', $account_id)->where('register_id',$id);

		
        $orderList = $orderData->orderBy('id', 'desc')->get();
		
		$address=RegisterAddress::where('register_id', $id)->get();
        $template=DB::table('coupon_assign')->where('send_to',$id)->first();
        $sale_x_id= ($template ? $template->sale_x_id : '');
        $no=($template ? $template->set_no-1 : '');
        $coupon=ForeSaleX::where('id',$sale_x_id)->first();
        return view('admin/users/register/detail',compact('account','orderList','address','coupon'))->with('otherdata',(new ForeSaleXController))->with('no',$no);
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
	public function memeber_list(){
		$user = Register::select('registers.*','memberships.charges','memberships.charge_recurring')
		        ->where('registers.account_id',Session::get('user')->id)
		        ->leftJoin('memberships','memberships.id','=','registers.memebership_id')
		        ->whereNotNull('registers.memebership_id')
				->get();
		return view('admin/users/memeber_list')->with('user',$user);
	}
}
