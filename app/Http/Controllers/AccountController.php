<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Affiliate;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\order;
use App\Models\orderDetail;
use App\Models\Employee;
use App\Models\EmpRestriction;
use App\Models\AccountCreditAffiliation;
use App\Mail\affiiatePayDetail;
use App\Models\Register;
use App\Models\ProductInquiry;
use App\Models\AdvanceProductOrder;
use App\Models\AffiliatePaymentHistory;
use App\Http\Controllers\ProductOrderController;
use Validator;
use Hash;
use File;
use Mail;
use App\Mail\OtpEmail;
use Redirect;
use App\Models\Msgnotify;
class AccountController extends Controller
{
    public function index() {
        
        $accountList = Account::with('currency')->get();
        return view('supperAdmin/account/index',compact('accountList'));
    }
	public function chat(){
		return view('admin.chat.index');
	}

	public function accountDetail($id){
		$rechargeList = AccountCreditAffiliation::where('account_id',$id)->orderBy('created_at', 'asc')->get();
		$account = Account::where('id', $id)->with(['currency'])->first();
		
		
		$account_id = $id;
        $orderData = order::with(['orderDetails' => function ($query) {
            $query->with(['orderOffers' => function ($query) {
                $query->with('offer');
            }]);
        }])->where('account_id', $account_id);

		
        $orderList = $orderData->orderBy('id', 'desc')->get();
        $registerList = Register ::where('account_id',$account_id)->get();
		return view('supperAdmin/account/detail',compact('rechargeList','account','orderList','registerList')); 
	}
    
    public function create() {

        $currencyList = Currency :: get();
        return view('supperAdmin/account/add',compact('currencyList'));

    }

    public function store(Request $request) {

        $input = $request->all();
        $rules = [
            'logo' => 'mimes:jpeg,bmp,png',
            'account_type' => 'required',
            'title' => 'required|max:50',
            'phone' => 'required|min:10|unique:accounts,phone|unique:affiliates,phone',
            'email' => 'required|email|unique:accounts,email|unique:affiliates,email',
            'landmark' => 'required|max:150',
            'address' => 'required|max:150',
            'pinCode' => 'required',
            
            
            'type' => 'required',
            'theme' => 'required',
            'color' => 'required',
            'domain' => 'required|unique:accounts',
            'charge' => 'required',
            'password' => 'required|min:6',
        ];

        $validation = Validator::make($input, $rules);
        //dd($validation);
        
        if ($validation->passes()) {

            $image_path = public_path('assets/images/account/');

            if (!File::isDirectory($image_path)) {

                File::makeDirectory($image_path, 0777, true, true);
            }

            $image_extension = $request->file('logo')->getClientOriginalExtension();
            $image_name = uniqid() . '.' . $image_extension;
            $imageUploaded = $request->file('logo')->move($image_path, $image_name);

            if ($imageUploaded) {
                
                $imagePath = 'assets/images/account/'.$image_name;

                $input['logo'] = $imagePath;
                $input['password'] = bcrypt($input['password']);
                
                unset($input['_token']);

                $account = Account::insert($input);
                if($account)
                {
                    return redirect('/admin/account');

                } else {

                    return back()->withErrors(['Something went wrong']);
                }

            } else {

                return back()->withErrors(['logo not upload']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);

        }
    }

    public function show(Account $account) {
        //
    }

    public function edit(Account $account) {
        echo 'Not Available';exit;
        $currencyList = Currency :: get();
        return view('supperAdmin/account/edit',compact('currencyList','account'));

    }

    public function update(Request $request, Account $account) {
        
        $input = $request->all();
		$rules = [];
		if(isset($input['actionType'])&&$input['actionType']=='shipyaariUpdate'){
			if(isset($input['shipyaariStatus'])){
				$rules = [
					'shipyaariUserName' => 'required',
					'shipyaariClientCode' => 'required',
					'shipyaariParentCode' => 'required'
				];
				$input['shipyaariStatus'] = 1;
			}else{
				$input['shipyaariStatus'] = 0;
			}
		}else if(isset($input['actionType'])&&$input['actionType']=='delhiveryUpdate'){
			if(isset($input['delhivehryStatus'])){
				$rules = [
					'delhivehry_token' => 'required'
				];
				$input['delhivehryStatus'] = 1;
			}else{
			    $input['delhivehryStatus'] = 0;
			}
		}else if(isset($input['actionType'])&&$input['actionType']=='razorPayUpdate'){
			$rules = [
				'razorPayDisplayName' => 'required',
				'razorPayApiKey' => 'required',
				'razorPayApiSecret' => 'required'
			];
		}else if(isset($input['actionType'])&&$input['actionType']=='shiprocketUpdate'){
			if(isset($input['shiprocketStatus'])){
				$rules = [
					'shiprocketEmail' => 'required',
					'shiprocketPassword' => 'required'
				];
				$input['shiprocketStatus'] = 1;
			}else{
			    $input['shiprocketStatus'] = 0;
			}
		}else if(isset($input['actionType'])&&$input['actionType']=='instaMojoUpdate'){
			$rules = [
				'instamojoApiKey' => 'required',
				'instamojoAuthToken' => 'required'
			];
		}else if(isset($input['actionType'])&&$input['actionType']=='smsUpdate'){
			$rules = [
				'SMSUserName' => 'required',
				'SMSUserPassword' => 'required',
				'SMSUserSenderId' => 'required',  
				'SMSApi' => 'required',
			];
		}else if(isset($input['actionType'])&&$input['actionType']=='passwordUpdate'){
			$rules = [
				'password' => 'required'
			];
		}else if(isset($input['actionType'])&&$input['actionType']=='chatEnable'){
			$rules = [
				'chat_enable' => 'required'
			];
		}else{
			$rules = [
				'logo' => 'nullable|mimes:jpeg,bmp,png',
				'title' => 'required|max:50',
				'account_type' => 'required',
				'address' => 'required|max:150',
				'pinCode' => 'required',
				'SMSUserName' => 'required',
				'SMSUserPassword' => 'required',
				'SMSUserSenderId' => 'required',  
				'SMSApi' => 'required',  
				'defaultCurrency' => 'required',
				'type' => 'required',
				'theme' => 'required',
				'color' => 'required',
				'domain' => 'required',
				'charge' => 'required',
				'landmark' => 'required|max:150',
				'shipyaariUserName' => 'required',
				'shipyaariClientCode' => 'required',
				'shipyaariParentCode' => 'required',
				'shiprocketEmail' => 'required',
				'shiprocketPassword' => 'required',
				'defaultShippingMethod' => 'required',
			];
        }
		
        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {

            $imagePath = null;

            if($request->file('logo')) {

                $image_path = public_path('assets/images/account/');

                if (!File::isDirectory($image_path)) {

                    File::makeDirectory($image_path, 0777, true, true);
                }

                $image_extension = $request->file('logo')->getClientOriginalExtension();
                $image_name = uniqid() . '.' . $image_extension;
                $imageUploaded = $request->file('logo')->move($image_path, $image_name);

                $imagePath = 'assets/images/account/'.$image_name;                
            }
                
            if($imagePath) {

                $input['logo'] = $imagePath;
            }
            
            if(isset($input['password'])&&$input['password'])
            {
                if(property_exists((object)$input,'password'))
                {
                    $input['password'] = bcrypt($input['password']);
                }

            } else {

                unset($input['password']);
            }                        
            
            unset($input['_token']);
            unset($input['_method']);
            unset($input['actionType']);

            if(isset($input['chat_enable'])&&$input['chat_enable'])
            {
                $input['chat_enable'] = 1;
            } else {
                $input['chat_enable'] = 0;
            } 

            $account = Account::where('id',$account->id)->update($input);
            if($account)
            {
                return Redirect::back();

            } else {

                return back()->withErrors(['Something went wrong']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }
    
    public function destroy(Account $account) {

        //dd($account);
        $result = $account->delete();
        if($result == 1) {

            return redirect('/admin/account');

        } else  {

            return back()->withErrors(['failed to delete']);
        }
    }    

    public function loginCheck(Request $request) {

        $input = $request->all();
        $rules = [
            'phone' => 'required|string',
            'password' => 'required',
        ];
        $activeDomain = $this->activeDomain();
		
        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {

            $user = Account::where('phone', $input['phone'])->where('status',1);
			if($activeDomain!='admin.uniqueandcommon.com/new/public'){
				$user = $user->where('domain',$activeDomain);
			}
			$user = $user->first();
            $affiliateUser = Affiliate::where('phone', $input['phone'])->where('status',1)->first();
            $employee = Employee::where('phone', $input['phone'])->where('status',1)->first();
            
            if ($user) {

                if (!Hash::check($input['password'], $user->password)) {

                    return back()->withErrors(['Invalid Credentials']);

                } else {
                    Session::put('isLoggedIn', true);
                    Session::put('userType', 1);
                    Session::put('user', $user);
                    Session::save();

                    return redirect('/admin/dashboard');
                }

            } else if ($affiliateUser){

                if (!Hash::check($input['password'], $affiliateUser->password)) {

                    return back()->withErrors(['Invalid Credentials']);

                } else {
                    Session::put('isLoggedIn', true);
                    Session::put('userType', 2);
                    Session::put('user', $affiliateUser);
                    Session::save();

                    return redirect('/admin/dashboard');
                }
            } else if ($employee){

                if (!Hash::check($input['password'], $employee->password)) {

                    return back()->withErrors(['Invalid Credentials']);

                } else {
                    Session::put('isLoggedIn', true);
                    Session::put('userType', 3);

                    $restrictions = EmpRestriction::where('employee_id', $employee->id)->get();  
                    // dd($restrictions); 
                    Session::put('user', $employee);
                    Session::put('restrictions',$restrictions);
                    Session::put('page_id',$restrictions);
                   

                    Session::save();

                    return redirect('/admin/dashboard');
                }
            } else {

                return back()->withErrors(['Invalid Credentials']);
            }

        } else {
            
            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }

    public function logOut(Request $request) {

        $request->session()->flush();
        return redirect('/admin');
    }

    public function forgotPasswordAdmin() {

        return view('forgotPasswordAdmin');

    }

    public function forgotPasswordAdminSubmit(Request $request)
    {
        $input = $request->all();

        $rules = [
            'phone' => 'required|min:10',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {

            
            $phone = $input['phone'];
            $activeDomain = $this->activeDomain();
            $accountCheck = Account::where('phone', $phone)->where('domain',$activeDomain)->first();
			
            if($accountCheck) {

                $OTP = rand(1,999999);

                $message = "Dear user,your OTP for forgot password is ".$OTP.". use this OTP for change password. Kheewa Incorporation";
                
				
				/*************************/
				$logo = $accountCheck->domain.'/'.$accountCheck->logo;
                Mail::to($accountCheck->email)->send(new OtpEmail(['message'=>$message, 'logo' => $logo,'account'=>$accountCheck]));
				/*************************/
				$message = urlencode($message);
				
				
                $url = "http://nimbusit.co.in/api/swsendSingle.asp?username=t1thekheewa&password=100719238&sender=KHEEWA&sendto=$phone&templateID=1707161708350841238&message=$message";
                
                $post = curl_init();
                curl_setopt($post, CURLOPT_URL, $url);
                curl_setopt($post, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($post, CURLOPT_CUSTOMREQUEST, 'GET');
                $response = curl_exec($post);
                curl_close($post);
                $result = json_decode($response, true);
                
                Session::put('OTP', $OTP);
                Session::put('phone', $phone);
                Session::save();
                
                return redirect('/admin/forgotPasswordAdmin');

            } else {
                
                return back()->withErrors(['Enter Valid Number.']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }

    public function forgotPasswordAdminUpdate(Request $request)
    {
        $input = $request->all();
        $password = bcrypt($input['data']['password']);
        $phone = Session::get('phone');

        Account::where('phone', $phone)->update(['password' => $password]);
        $request->session()->flush();
        return response()->json("Done", 200);
    }

    public function dashboard() {

        $account = Session::get('user');
        $userType = Session::get('userType');
		$accountId = $account->id;
        $orders = AdvanceProductOrder::where('status',7);
        $cancel_orders = AdvanceProductOrder::where('status',6);
        $aff_orders = AdvanceProductOrder::whereNotNull('aff_id');
        $registers = Register::where('account_id','!=','');
		if($accountId!=1){
			$orders = $orders->where('account_id',$accountId);
			$cancel_orders = $cancel_orders->where('account_id',$accountId);
			$aff_orders = $aff_orders->where('account_id',$accountId);
			$registers = $registers->where('account_id',$accountId);
		}
	
		    $orders = $orders->count();
			$cancel_orders = $cancel_orders->count();
			$aff_orders = $aff_orders->count();
			$registers = $registers->count();
            $revers_order  = 0;
            $replace_order = 0;
            $total_enq = 0;
            $income_aff  = 0;
	    $return = view('dashboard', compact('orders','cancel_orders','aff_orders','registers','revers_order','replace_order','total_enq','userType'));
		if($userType==2){
			$income_aff = Affiliate::where('id',$accountId)->first();
			$aff = Affiliate::where('id',$accountId)->first();
			$income_aff_hold = AffiliatePaymentHistory::where('affiliate_id',$aff->code)
			                   ->where('status',0)
							   ->where('user_type','affiliate')
							   ->sum('amount');
			$return = $return->with('income_aff_hold',$income_aff_hold);
			$income_aff = $income_aff->commission;
		}
        return $return->with('income_aff',$income_aff);
    }

    public function sessionManage() {

        if ((Session::get('isLoggedIn')) && (Session::get('user'))) {

            return redirect('/admin/dashboard');

        } else {

            return view('login');
        }

    }
    
    public function pinCodeCheck(Request $request)
    {
        $account = Session::get('user');
        $pickupPinCode = $account->pinCode;

        $input = $request->all();
        $pinCode = $input['data']['pinCode'];

        $paymentmode="online";
        $invoicevalue=rand(1,999999);
        $avnkey="14851@13700";
        $insurance="yes";
        $service_type="normal";
        $partner="";
        $service="standard";
        $request_url ='https://seller.shipyaari.com/logistic/webservice/SearchAvailability_new.php';

        $post_data="&pickup_pincode=".$pickupPinCode."&delivery_pincode=".$pinCode."&weight=1.00&paymentmode=".$paymentmode."&invoicevalue=".$invoicevalue."&avnkey=".$avnkey."&service_type=".$service_type."&partner=".$partner."&service=".$service."&length=1.00&width=1.00&height=1.00";
        $post = curl_init();

        curl_setopt($post, CURLOPT_URL, $request_url);
        curl_setopt($post, CURLOPT_POST,TRUE);
        curl_setopt($post, CURLOPT_POSTFIELDS, json_encode($post_data));
        curl_setopt($post, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($post);
        //print_r($response);
        curl_close($post);

        $validate = $response[0];
        $result = json_decode($response, true);
        //console.log($result);
        return response()->json($result, 200);
    }

    public function affiliatePayDetail(Request $request){
        
        $input = $request->all();
       // $account = Account::first();
        $account = Session::get('user');
        $logo = $account->domain.'/'.$account->logo;
        
        $email = 'contact@kheewa.in';

        Mail::to($email)->send(new affiiatePayDetail(['input'=>$input, 'account' => $account, 'logo' => $logo]));       
        //return view('dashboard');
        return redirect('/admin/dashboard');
    }
	public function getShipRocketPickUpLocation($id){
		$ship_rocket_token = $this->shipRocketToken($id);
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/settings/company/pickup',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
			'Authorization: Bearer '.$ship_rocket_token
		  ),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		$response = json_decode($response,true);
		if(!array_key_exists('message',$response)){
			$tmp_array = $response['data']['shipping_address'];
			$tmp_array = array_map(function ($tmp_array) {
							 return ['pin_code'=>$tmp_array['pin_code'],'pickup_location'=>$tmp_array['pickup_location']];
							}, $tmp_array);
			$pickup_data = json_encode($tmp_array);
			Account::where('id',$id)->update([
			    'shiprocketPickupLocationAll'=>$pickup_data
			]);
		}
		return $response;
	}
    public function user_action($id,$status){
		Account::where('id',$id)
		->update(['status'=>$status]);
		return Redirect::back()->with('status','Updated Successfully.');
	}
	public function profile(){
		$account_id = Session::get('user')->id;
		$account = Account::where('id', $account_id)->first();
		return view('admin/profile/index',compact('account')); 
	}
	public function upload_logo(Request $request){
		$account_id = Session::get('user')->id;
		$array = [
		          'address'=>$request->address,
				  'title'=>$request->title
				  ];
		if($request->hasFile('logo')){
			$rules = [
				'logo' => 'required|mimes:jpeg,bmp,png'
			];
			$input = $request->all();
			$validation = Validator::make($input, $rules);
			if($validation->passes()){
				$imagePath = null;
				if($request->file('logo')) {

					$image_path = public_path('assets/images/account/');

					if (!File::isDirectory($image_path)) {

						File::makeDirectory($image_path, 0777, true, true);
					}

					$image_extension = $request->file('logo')->getClientOriginalExtension();
					$image_name = uniqid() . '.' . $image_extension;
					$imageUploaded = $request->file('logo')->move($image_path, $image_name);

					$imagePath = 'assets/images/account/'.$image_name;  
					$array['logo'] = $imagePath;					
				}
				
			}
		}
		Account::where('id', $account_id)
					->update($array); 
		return Redirect::back()->with('status','Updated Successfully.');
	}
	public function homePageSetting(){
		$account_id = Session::get('user')->id;
		$home = Account::where('id', $account_id)->first();
		return view('admin/users/home-page-setting')->with('home',$home);
	}
	public function homePageSettingPost(Request $request){
		$account_id = Session::get('user')->id;
		Account::where('id', $account_id)
					->update(['home_page'=>$request->home_page]); 
		return Redirect::back()->with('status','Updated Successfully.');
	}
	public function checkSmsSetting($id){
		$found = Msgnotify::where('account_id', $id)->where('msg_type', 5)->first();
        $OTP = rand(1000, 9999);
        $OTP = 123456;
        Session::put('otp', $OTP);
        $sign_up_message = $found->messages;
        $sign_up_message = str_replace('[OTP]', $OTP, $sign_up_message);
        $message = urlencode($sign_up_message);
        Session::put('loginOtp', $OTP);
        $account = Account::where("id",$id)->first();
        $replace = str_replace('setUsername', $account->SMSUserName, $account->SMSApi);
        $replace1 = str_replace('setPassword', $account->SMSUserPassword, $replace);
        $replace2 = str_replace('setSenderId', $account->SMSUserSenderId, $replace1);
        $replace3 = str_replace('setPhone', '8726777887', $replace2);
        $replace4 = str_replace('setMessage', $message, $replace3);
        $replace5 = str_replace('setTEMPLATEID', $found->template_id, $replace4);
        $url = $replace5;
        //dd($url);
        $post = curl_init();
        curl_setopt($post, CURLOPT_URL, $url);
        curl_setopt($post, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($post, CURLOPT_CUSTOMREQUEST, 'GET');
        $response = curl_exec($post);
        curl_close($post);
        $result = $response;
		return $result;
	}

    public function register_users_listing_coloumn(){
        $data = Account::where('id',Session::get('user')->id)->first();
        $array = [];
        if($data->users_listing_coloumn!=Null){
            $array = explode(',',$data->users_listing_coloumn);
        }
        return view('admin.users.register_users_listing_coloumn')->with('array',$array);
    }
    public function register_users_listing_coloumn_post(Request $request){
        Account::where('id',Session::get('user')->id)
                 ->update(['users_listing_coloumn'=>(isset($request->users_listing_coloumn)&&count($request->users_listing_coloumn) ? implode(',',$request->users_listing_coloumn) : Null)]);
        return Redirect::back()->with('status','Updated Successfully.');
    }
}