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

use Validator;
use Hash;
use File;
use Mail;

class AccountController extends Controller
{
    public function index() {
        
        $accountList = Account::with('currency')->get();
        return view('supperAdmin/account/index',compact('accountList'));
    }
    
    public function create() {

        $currencyList = Currency :: get();
        return view('supperAdmin/account/add',compact('currencyList'));

    }

    public function store(Request $request) {

        $input = $request->all();
        $rules = [
            'logo' => 'mimes:jpeg,bmp,png',
            'title' => 'required|max:50',
            'phone' => 'required|min:10|unique:accounts,phone|unique:affiliates,phone',
            'email' => 'required|email|unique:accounts,email|unique:affiliates,email',
            'landmark' => 'required|max:150',
            'address' => 'required|max:150',
            'pinCode' => 'required',
            'SMSUserName' => 'required',
            'SMSUserPassword' => 'required',
            'SMSUserSenderId' => 'required',          
            'SMSApi' => 'required',          
            'instamojoApiKey' => 'required',
            'instamojoAuthToken' => 'required',
            'shipyaariUserName' => 'required',
            'shipyaariClientCode' => 'required',
            'shipyaariParentCode' => 'required',
            'defaultCurrency' => 'required',
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

        $currencyList = Currency :: get();
        return view('supperAdmin/account/edit',compact('currencyList','account'));

    }

    public function update(Request $request, Account $account) {

        $input = $request->all();
        $rules = [
            'logo' => 'nullable|mimes:jpeg,bmp,png',
            'title' => 'required|max:50',
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
        ];

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
            
            if($input['password'])
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

            $account = Account::where('id',$account->id)->update($input);
            if($account)
            {
                return redirect('/admin/account');

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

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {

            $user = Account::where('phone', $input['phone'])->where('status',1)->first();
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

            $accountCheck = Account::where('phone', $phone)->first();
            if($accountCheck) {

                $OTP = rand(1,999999);

                $message = urlencode("Dear user,your OTP for forgot password is $OTP. use this OTP for change password. $accountCheck->title");
                
                $url = "http://nimbusit.co.in/api/swsendSingle.asp?username=t1thekheewa&password=100719238&sender=KHEEWA&sendto=$phone&message=$message";
                
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
        //dd($account);

        $accountId = $account->id;

        /*Affiliate Marketing Minimum Balance Calculation*/

            $productList = Product::with([
                'productvariations' => function ($query) {
                    $query->with([
                        'inventory_price' => function ($query) {
                            $query->with([
                                'orderDetails'
                            ]);
                        }
                    ]);
                }
            ])->where('account_id',$accountId)->get();
            
            $totalAmt = 0;
            $totalAffiliateAmt = 0;

            if($userType == '1' && $accountId != '1') {
                
                foreach ($productList as $key => $product) {
                    
                    foreach ($product->productvariations as $key => $price) {

                        //dd($price->inventory_price->orderDetails->affiliate_id);

                        if($price->inventory_price->qty?? '') {
                            
                            $productQty = $price->inventory_price->qty;
                            $sellingAffiliationCharge = $price->inventory_price->sellingAffiliationCharge;
                            $inquiryAffiliationCharge = $price->inventory_price->inquiryAffiliationCharge;

                            $totalAmt += ($productQty * $sellingAffiliationCharge) + ($productQty * $inquiryAffiliationCharge);

                            if(($price->inventory_price->orderDetails->affiliate_id ?? NULL)) {

                                $totalAffiliateAmt += ($price->inventory_price->orderDetails->qty * $sellingAffiliationCharge);

                            }
                        }
                    }
                }
            }
            
            $totalRecharge = AccountCreditAffiliation::where('account_id',$accountId)->sum('amount');
            $totalRecharge = $totalRecharge - $totalAffiliateAmt;
            $tenPercentage = $totalAmt*10/100;

            if($tenPercentage > $totalRecharge && 5000 > $totalRecharge)
            {
                $affiliateMsg = "You have insufficient balance for affiliate marketing please recharge.";
                Account::where('id',$accountId)->update(['affiliationLink'=>0]); //insufficient balance then hide product in affiliate panel

            } else {
                
                $affiliateMsg = "";
                Account::where('id',$accountId)->update(['affiliationLink'=>1]); //sufficient balance then show product in affiliate panel
            }
        
        /*Affiliate Marketing Minimum Balance Calculation*/

        /*Domain Dashboard*/

        if($userType == '1' && $accountId != '1')
        {
            $normalOrder = 0;
            $cancelOrder = 0;
            $reverseOrder = 0;
            $replcamentOrder = 0;

            $affiliateOrder = 0;

            $dashboardData = order::with('orderDetails')->where('account_id',$accountId)->get();
            foreach ($dashboardData as $key => $dashboard) {
                
                if($dashboard->orderStatus == 4) {

                    $normalOrder += 1;
                }

                if($dashboard->orderStatus == 18) {

                    $cancelOrder += 1;
                }

                if($dashboard->orderStatus == 9) {

                    $reverseOrder += 1;
                }

                if($dashboard->orderStatus == 19) {

                    $replcamentOrder += 1;
                }

                /*Affiliate order not depends on other status*/
                foreach ($dashboard->orderDetails as $key => $orderDetail) {
                    
                    $orderCount = $orderDetail->affiliate_id;
                    if($orderCount) {
                        $affiliateOrder += 1;
                    }
                }
                /*Affiliate order not depends on other status*/

            }

            $register = Register::where('account_id',$accountId)->get();
            $registerUser = count($register);

            $inquiry = ProductInquiry::where('account_id',$accountId)->get();
            $productInquiry = count($inquiry);

            $domainDashboard = ["userType"=>$userType,"normalOrder"=>$normalOrder,"cancelOrder"=>$cancelOrder,"reverseOrder"=>$reverseOrder,"replcamentOrder"=>$replcamentOrder,"affiliateOrder"=>$affiliateOrder,"registerUser"=>$registerUser,"productInquiry"=>$productInquiry];

        } else {

            $normalOrder = 0;
            $cancelOrder = 0;
            $reverseOrder = 0;
            $replcamentOrder = 0;

            $affiliateOrder = 0;

            $dashboardData = order::with('orderDetails')->get();
            foreach ($dashboardData as $key => $dashboard) {
                
                if($dashboard->orderStatus == 4) {

                    $normalOrder += 1;
                }

                if($dashboard->orderStatus == 18) {

                    $cancelOrder += 1;
                }

                if($dashboard->orderStatus == 9) {

                    $reverseOrder += 1;
                }

                if($dashboard->orderStatus == 19) {

                    $replcamentOrder += 1;
                }

                /*Affiliate order not depends on other status*/
                foreach ($dashboard->orderDetails as $key => $orderDetail) {
                    
                    $orderCount = $orderDetail->affiliate_id;
                    if($orderCount) {
                        $affiliateOrder += 1;
                    }
                }
                /*Affiliate order not depends on other status*/

            }

            $register = Register::get();
            $registerUser = count($register);

            $inquiry = ProductInquiry::get();
            $productInquiry = count($inquiry);

            $domainDashboard = ["userType"=>$userType,"normalOrder"=>$normalOrder,"cancelOrder"=>$cancelOrder,"reverseOrder"=>$reverseOrder,"replcamentOrder"=>$replcamentOrder,"affiliateOrder"=>$affiliateOrder,"registerUser"=>$registerUser,"productInquiry"=>$productInquiry];

        }
        
        if($userType == '2')
        {
            $domainDashboard = ["userType"=>$userType];
        }
        //dd($domainDashboard);
        /*Domain Dashboard*/

        return view('dashboard', compact('affiliateMsg','domainDashboard'));
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
        $avnkey="10393@5183";
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

}