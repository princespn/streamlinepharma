<?php

namespace App\Http\Controllers\Front;
 
use App\Http\Controllers\Controller;
use App\Http\Controllers\ForeSaleXController;
use App\Models\About;
use App\Models\ExtraService;
use App\Models\Account;
use App\Models\Category;
use App\Models\GeneralInquiry;
use App\Models\Label;
use App\Models\Privacy;
use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\ProductPrice;
use App\Models\ProductInquiry;
use App\Models\ProductSearchKeyword;
use App\Models\Register;
use App\Models\RegisterAddress;
use App\Models\Returning;
use App\Models\Shipping;
use App\Models\Slider;
use App\Models\SocialMedia;
use App\Models\Tag;
use App\Models\Term;
use App\Models\cartTemporary;
use App\Models\Affiliate;
use App\Models\order;
use App\Models\orderDetail;
use App\Models\orderOffer;
use App\Models\Coupon;
use App\Models\changeAddress;
use App\Models\OfferNormal;
use App\Models\ProductOffer;
use App\Models\Membership;
use App\Models\MembershipPage;
use App\Models\AdvanceProductCart;
use App\Mail\WelcomeMail;
use App\Mail\ConfirmOrderMail;
use App\Mail\LoginMail;
use App\Models\AdvanceProduct;
use App\Models\AdvanceProductOrder;
use App\Models\AdvanceProductOrderDetail;
use App\Models\AdvanceProductSetting;
use App\Models\AdvanceProductAttribute;
use App\Models\HomeBanner;
use App\Models\OfferBanner;
use App\Models\Wallet;
use Hash;
use App\Models\Msgnotify;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Mail;
use Validator;
use DB;
use App\Models\Purchaseoffer; 
use App\Models\Brand; 
use App\Models\AccountCreditAffiliation; 
use App\Models\AffiliatePaymentHistory; 
use Razorpay\Api\Api;
use Redirect;
use Cookie;

use App\Models\ReferralScheme;
use App\Facades\MainAccount;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)

    {
           //echo Cookie::get('aff_id');exit;
        
          
           $account = MainAccount::MyUser();
         
           if($account->status=='0'){
               echo '<h1>Account Suspended</h1>';exit;
           }
           if ($account) {
               //$categoryList = Category ::where('account_id',MainAccount::MyUser()->id)->whereStatus(1)->get();
               $categoryList = Category ::where('account_id',MainAccount::MyUser()->id)->with(['parentCategory'=> function($query){
                $query->with('parentCategory');
            }])
            ->get();
               $sliderList = Slider::where('account_id', $account->id)->where('status', 1)->where('qc',1)->get();
  
   
               $viewPath = 'theams/Front' . $account->theme . '/index';
               Session::put('currentAccount', $account);
   
               $account_id = $account->id;
               $register_id = Session::getId();
   
               $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();
               
               /*$categoryProductList = Category::where('account_id', $account->id)
               ->where('level', 1)
               ->where('status', 1)
               ->orderBy('id', 'asc')
               ->with(['productlevel2' => function ($query) {
   
                   $query->where('status', 1)->orderBy('id', 'desc')->with(['productvariations' => function ($query) {
   
                       $query->where('qc', 4)
                           ->where('status', 1)
                           ->orderBy('id', 'desc')
                           ->with(['inventory_price' => function ($query) {
   
                       }]);
                   }]);
               }])
               ->get();*/

               #
              
               
       
               $extraServiceList = ExtraService ::where('account_id',$account_id)->get();
   
               //dd($extraServiceList);
               //topselling is working ..
               $topselling = AdvanceProduct::select('sku','thumbnail','title','product_price','selling_price',DB::Raw("TRUNCATE((product_price - selling_price ) / selling_price * 100,2) AS discount"))->where('account_id',$account_id)->where('status','Active')->where('qc',1)->inRandomOrder()->limit(4)->orderBy('views','desc')->get();
               $advance_product1 = AdvanceProduct::select('sku','thumbnail','title','product_price','selling_price',DB::Raw("TRUNCATE((product_price - selling_price ) / selling_price * 100,2) AS discount"))->where('status','Active')->where('account_id',$account_id)->where('qc',1)->inRandomOrder()->limit(15)->orderBy('id','desc')->get();
               $advance_product = AdvanceProduct::select('sku','thumbnail','title','product_price','selling_price',DB::Raw("TRUNCATE((product_price - selling_price ) / selling_price * 100,2) AS discount"))->where('status','Active')->where('account_id',$account_id)->where('qc',1)->limit(4)->orderBy('id','desc')->get();
               $discount = AdvanceProduct::select('sku','thumbnail','title','product_price','selling_price',DB::Raw("TRUNCATE((product_price - selling_price ) / selling_price * 100,2) AS discount"))->where('account_id',$account_id)->where('status','Active')->where('qc',1)->limit(4)->orderBy('discount','desc')->get();
               $trending = AdvanceProduct::select('sku','thumbnail','title','product_price','selling_price',DB::Raw("TRUNCATE((product_price - selling_price ) / selling_price * 100,2) AS discount"))->where('account_id',$account_id)->where('status','Active')->where('qc',1)->limit(4)->orderBy('views','desc')->get();
               $deals = Purchaseoffer::
                        where('account_id',$account_id)
                        ->where('startDate','<=',date('Y-m-d H:i:s'))
                        ->where('endDate','>=',date('Y-m-d H:i:s'))->limit(8)->get();
                         
               $return = view($viewPath, compact('account','cartList','sliderList','extraServiceList','advance_product','discount','deals','trending','categoryList','advance_product1','topselling'));
               if(isset($_COOKIE['recently'])){
                   $recently = "'".implode("','",explode(",",$_COOKIE['recently']))."'";
                   //var_dump($recently);exit;
                   $viewed = AdvanceProduct::select('sku','thumbnail','title','product_price','selling_price',DB::Raw("TRUNCATE((product_price - selling_price ) / selling_price * 100,2) AS discount"))->where('account_id',$account_id)->where('status','Active')->whereIn('sku',explode(",",$_COOKIE['recently']))->where('qc',1)->limit(4)->orderByRaw(DB::Raw(" FIELD(`sku`, ".$recently.")"))->get();
                   //dd($viewed);
                    $return = $return->with('viewed',$viewed);
               }
               return $return;
   
           } else {
   
               return view('theams/fail');
           }
        //return view('Front/index');
    }
    public function shopWishlist($sku=''){
        if(isset(Session::get('register')->id )){

        
        $skuproduct= array();
        if(isset($sku)){
            $array = array(
                'sku'=>$sku,
                'ragister_id'=>Session::get('register')->id 
             );
             
            $count=DB::table('wishlist')->where('sku',$sku)->where('ragister_id',Session::get('register')->id)->count();
            if($count <=0){
             $data=DB::table('wishlist')->insert($array);
            }
        }
       
        $count=DB::table('wishlist')->select('sku')->where('ragister_id',Session::get('register')->id)->count();
       if($count >= 1){
        $skuwish=DB::table('wishlist')->select('sku')->where('ragister_id',Session::get('register')->id)->get(); 
        foreach($skuwish as $k=> $skuwish){
            $skuproduct[$k]=$skuwish->sku;
        }
        $wish_product = AdvanceProduct::select('sku','thumbnail','title','product_price','selling_price',DB::Raw("TRUNCATE((product_price - selling_price ) / selling_price * 100,2) AS discount"))->where('status','Active')->where('qc',1)->whereIn('sku',$skuproduct)->get();
        
        
       }
       return view('theams/Front1/shopWishlist')->with('wish_product',$wish_product);
        }else{
          $wish_product= array();  
        return view('theams/Front1/shopWishlist')->with('wish_product',$wish_product);  
        }
       
       
    }

    public function shopCompare(){
        return view('theams/Front1/shop-compare');
    }

    public function ourAccount(){
        $account = MainAccount::MyUser();
      
      
        return view('theams/Front1/page-account');
    }

    public function ourContact(){
        return view('theams/Front1/our-contact');
    }

    public function ProductSingleShop($sku){

        $account = MainAccount::MyUser();
		Session::put('currentAccount', $account);
		if(isset($_REQUEST['aff'])&&!isset($_COOKIE['aff_id'])){
			 setcookie("aff_id",$_REQUEST['aff'],time()+31556926 ,'/');
			 setcookie("aff_count",5,time()+31556926 ,'/');
		}  
		
		
		
		$account = Session::get('currentAccount');
		$advance_product = AdvanceProduct::where('sku',$sku)->first();
        if($advance_product->status!='Active'|| (!in_array($advance_product->setting_id,explode(',',$account->subscribedTemplate))) ){
           //echo $account->subscribedTemplate;
            echo 'Invalid link';
           // print_r($advance_product);
	        exit;
		}		
		$register_id = Session::getId();
        $advance_product->setting_id;
        $Relatedproducts = AdvanceProduct::select('sku','thumbnail','title','product_price','selling_price',DB::Raw("TRUNCATE((product_price - selling_price ) / selling_price * 100,2) AS discount"))->where('account_id',$account->id)->where('status','Active')->where('qc',1)->where('setting_id',$advance_product->setting_id)->where('sku','!=',$sku)->inRandomOrder()->limit(4)->orderBy('views','desc')->get();
        $viewPath = 'theams/Front' . $account->theme . '/product-single-shop';
		$return = view($viewPath, compact('advance_product','account','Relatedproducts'));
		if($advance_product->setting->grouping!=Null&&$advance_product->grouping_name!=Null){
			$group = AdvanceProduct::where('sku','!=',$sku)
			                         ->where('account_id',$account->id)
			                         ->where('setting_id',$advance_product->setting_id)
			                         ->whereNotNull('grouping_name')
									 ->get();
			
			$return = $return->with('group',$group);
			
		}
		if(isset($_COOKIE['recently'])){
		  $recently = explode(',',$_COOKIE['recently']);
		  array_unshift($recently,$sku);
		  $recently = array_unique($recently);
		  array_slice($recently,0,8);
		  //var_dump($recently);exit;
		  setcookie("recently",implode(',',$recently),time()+31556926 ,'/');
		}else{
			setcookie("recently",$sku,time()+31556926 ,'/');
		}
		
		
		if(isset($_REQUEST['scheme'])){
			
			$scheme = ReferralScheme::where('account_id',$account->id)
			->where('scheme_validity','>=',date('Y-m-d'))
			->where('offering_product',$sku)
			->where('status','1')
			->where('id',urldecode(base64_decode($_REQUEST['scheme'])))
			->first();  
			if(!$scheme){
				echo 'You have entered invalid link or it is expired, Please <a href="'.url('/').'">Click here</a> to go to home page.';
				exit;
			}else{
				$return = $return->with('scheme',$scheme);
			}
		}
		
		AdvanceProduct::where('sku',$sku)->update(['views'=>($advance_product->views+1)]);
		return $return;
       
    }

    public function showShop($id='',$sub_id='',$template_id='',Request $request){
        $account = Session::get('currentAccount'); 
		$account_id = $account->id;
		$advance_product = AdvanceProduct::where('advance_product.account_id',$account_id)->where('advance_product.status','Active')->whereIn('advance_product.setting_id',explode(',',$account->subscribedTemplate))->leftJoin('advance_product_category', function ($join) use($account_id) {
                  $join->on('advance_product_category.setting_id', '=', 'advance_product.setting_id')
                  ->where('advance_product_category.account_id',$account_id);
                });
        
		$all_color = $this->all_color();
		$brand = Brand::where('account_id',$account_id)->get();
		$viewPath = 'theams/Front' . $account->theme . '/show-shop';
		
		$pricing = AdvanceProduct::select(DB::Raw('min(uc_advance_product.selling_price) as min_price'),DB::Raw('max(uc_advance_product.selling_price) as max_price'),DB::Raw("group_concat(uc_advance_product.color) as color"))->where('advance_product.status','Active')->where('advance_product.account_id',$account_id)->whereIn('advance_product.setting_id',explode(',',$account->subscribedTemplate))
		->leftJoin('advance_product_category', function ($join) use($account_id) {
                  $join->on('advance_product_category.setting_id', '=', 'advance_product.setting_id')
                  ->where('advance_product_category.account_id',$account_id);
                });
		if($id!=''){
			$pricing = $pricing->where('advance_product_category.category',$id);
		}
		if($sub_id!=''){
			$pricing = $pricing->where('advance_product_category.sub_category',$sub_id);
		}
		$return = view($viewPath,compact('account','brand','id','sub_id','template_id'));
		if($template_id!=''){
			$pricing = $pricing->where('advance_product.setting_id',$template_id);
			$AdvanceProductSetting = AdvanceProductSetting::where('id',$template_id)->first();
			$return = $return->with('setting',$AdvanceProductSetting);
		}
		$pricing = $pricing->first();
		$all_color = array_unique(explode(',',$pricing->color));
		$return = $return->with('pricing',$pricing)->with('all_color',$all_color);
		return $return;
       // return view('theams/Front1/show-shop');
    }
    public function shopCart(Request $request)
    {
        $account = Session::get('currentAccount');
        $viewPath = 'theams/Front' . $account->theme . '/shop-cart';
        $account_id = $account->id;
        $register_id = Session::getId();
        return view($viewPath, compact('account'));
    }
    public function login()
    {
        $account = Session::get('currentAccount');
        $viewPath = 'theams/Front' . $account->theme . '/login';


        $account_id = $account->id;
        $register_id = Session::getId();

        $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();

        return view($viewPath, compact('account','cartList'));
    }
    public function loginSubmit(Request $request)
    {
        $account = Session::get('currentAccount');
        $account_id = $account->id;
        
        $input = $request->all();

        $rules = [
            'phone' => 'required',
             'password' => 'required_if:login_otp,"=",null',
            'login_otp' => 'required_if:password,"=",null'
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {

            $phone = $input['phone'];
            $password = $input['password'];
			$otp = $input['login_otp'];
            $isOtpLogin=false;
            if($otp && Session::get('loginOtp')==$otp){
                $isOtpLogin=true;
            }

            unset($input['_token']);
            unset($input['phone']);
            unset($input['password']);
           
            $register = Register::where('account_id', $account_id)->where('phone', $phone)->where('status', 1)->first();
            if($isOtpLogin && $register){
                Session::put('isLoggedIn', true);
                Session::put('register', $register);
                Session::save();
                AdvanceProductCart::where('register_id',Session::getId())
					                    ->update(['register_user_id'=>$register->id]);
                $email = $register['email'];
                if ($email) {
                    $logo = $account->domain . '/' . $account->logo;
                    Mail::to($email)->send(new LoginMail(['register' => $register, 'account' => $account, 'logo' => $logo]));
                }
                return redirect('/');
            }else if ($register) {
                
                if (!Hash::check($password, $register->password)) {

                    return back()->withErrors(['Enter correct password']);

                } else {


                    Session::put('isLoggedIn', true);
                    Session::put('register', $register);
                    Session::save();
                    AdvanceProductCart::where('register_id',Session::getId())
					                    ->update(['register_user_id'=>$register->id]);
                    $email = $register['email'];
                    if($email)
                    {
                        $logo = $account->domain.'/'.$account->logo;
                        Mail::to($email)->send(new LoginMail(['register'=>$register, 'account' => $account, 'logo' => $logo]));
                    }

                    return redirect('/Front');
                }

            } else {

                return back()->withErrors(['You are not registered with this contact number.']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
        
    }
    public function register()
    {
        $account = Session::get('currentAccount');
        $viewPath = 'theams/Front' . $account->theme . '/register';
        
        $account_id = $account->id;
        $register_id = Session::getId();

        $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();

        return view($viewPath, compact('account','cartList'));
    }
    public function registerSubmit(Request $request)
    {

        
        $input = $request->all();

        $rules = [
            'name' => 'required',
            'phone' => 'required|min:10|max:10',
            'email' => 'required',
            'password' => 'required',
            'landmark' => 'required',
            'address' => 'required',
            'zipCode' => 'required',
        ];
      

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {

            $account = Session::get('currentAccount');
            $phone = $input['phone'];

            $registerCheck = Register::where('account_id', $account->id)->where('phone', $phone)->first();
            if($registerCheck) {

                return back()->withErrors(['This number is already registered.']);

            } else {

                $name = $input['name'];            
                $email = $input['email'];
                $password = bcrypt($input['password']);
                $landmark = $input['landmark'];
                $address = $input['address'];
                $zipCode = $input['zipCode'];

                // unset($input['_token']);
                // unset($input['name']);
                // unset($input['phone']);
                // unset($input['email']);
                // unset($input['password']);
                // unset($input['landmark']);
                // unset($input['address']);
                // unset($input['zipCode']);

                $register = Register::create(['account_id' => $account->id, 'name' => $name, 'phone' => $phone, 'email' => $email, 'password' => $password]);
                if ($register) {
                    
                    RegisterAddress::create(['register_id' => $register->id, 'name' => $name, 'phone' => $phone, 'email' => $email, 'password' => $password, 'landmark' => $landmark, 'address' => $address, 'zipCode' => $zipCode]);

                    $logo = $account->domain.'/'.$account->logo;
                    Mail::to($input['email'])->send(new WelcomeMail(['input'=>$input, 'account' => $account, 'logo' => $logo]));
                    
                    Session::put('isLoggedIn', true);
                    Session::put('register', $register);
                    Session::save();
                    return redirect('/');

                } else {

                    return back()->withErrors(['Something went wrong']);
                }
            }

        } else {

            $errors = $validation->errors();
            //dd($errors);
            return back()->withErrors($errors);
        }
    }
    public function FinalAmount($account_id){
        $creditAmount=DB::table('wallets')->where('account_id',$account_id)->where('status','0')->sum('credit');
        $debitAmount=DB::table('wallets')->where('account_id',$account_id)->where('status','0')->sum('debit');
       
        if(($creditAmount-$debitAmount) <= 0){
            return '0';
        }else{
            return  $creditAmount-$debitAmount;
        }
    }
    public function logOutClick(Request $request)
    {

        $request->session()->flush();
        return redirect('/Front');

    }
    public function checkOut(Request $request)
    {
        $account = Session::get('currentAccount');
		if(Session::get('register')){
		
        $viewPath = 'theams/Front' . $account->theme . '/checkOut';

        $account_id = $account->id;
        $register_id = Session::getId();

        $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get(); 
		
		if(Session::get('register')){
        $account = Session::get('currentAccount');
        $pickupPinCode = $account->pinCode;
        //$viewPath = 'theams/theam' . $account->theme . '/checkOut';cartList
        $account_id = $account->id;
        $register_id = Session::getId();
        $register = Session::get('register');

        $amount=$this->FinalAmount($register->id);
		 $totalWeight = 0;
            $totalInvoicevalue = 0;
            $isShippingInclude = false;
            $itemID=null;
		$allAddresses = RegisterAddress::where('register_id', $register->id)->orderBy('id')->get();
		 $addresses = null;
            $deliveryPinCode = null;
		   if ($allAddresses && $allAddresses->count() == 1) {
                $addresses = $allAddresses[0];
                $deliveryPinCode = $addresses->zipCode;
                Session::put('addressCode',$deliveryPinCode);
            }
            if(Session::get('addressCode')){
                $deliveryPinCode = Session::get('addressCode');
            }
		    $addresses = null;
            $deliveryPinCode = null;
            $allAddresses = RegisterAddress::where('register_id', $register->id)->orderBy('id')->get();
			//dd($allAddresses);
            if ($allAddresses && $allAddresses->count() == 1) {
                $addresses = $allAddresses[0];
                $deliveryPinCode = $addresses->zipCode;
                Session::put('addressCode',$deliveryPinCode);
            }
            if(Session::get('addressCode')){
                $deliveryPinCode = Session::get('addressCode');
            }
            
       /* $addresses = RegisterAddress :: where('register_id', $register->id)->first();
        $deliveryPinCode = $addresses->zipCode;
        $deliveryPinCode = 226026;*/
		if ($deliveryPinCode) {
        $avnkey = $account->shipyaariClientCode."@".$account->shipyaariParentCode;
        $insurance="no"; //yes
        $service_type="normal";
        $service="economy"; //standard
        $partner="";
        $request_url ='https://seller.shipyaari.com/logistic/webservice/SearchAvailability_new.php';

        $cartList = cartTemporary::with('inventoryPrice','cartInventory','inventoryPackaging','inventoryOffer')->where('account_id', $account_id)->where('register_id', $register_id)->get();
        $totalLengthArray = array();
        $totalWidthArray = array();
        foreach ($cartList as $key => $value) {
            //dd($value->inventoryPackaging);
            if($value->inventoryPackaging->includeShipping == 0)
            {
				$isShippingInclude = true;
                $weight = $value->inventoryPackaging->weight;
                $length = $value->inventoryPackaging->length;
                $width = $value->inventoryPackaging->width;
                $height = $value->inventoryPackaging->height;
                $total = $value->inventoryPrice->sprice;
                $qty = $value->qty;
                $invoicevalue = ($total * $qty) + ($total * ($value->cartInventory->ProductTax->includeTax == 0 ? $value->cartInventory->ProductTax->tax : 0)/100);
				array_push($totalLengthArray,$length);
                array_push($totalWidthArray,$width);
                //dd($invoicevalue);
                $codMode="COD";
				$totalWeight = $totalWeight + $weight;
				 $totalInvoicevalue = $totalInvoicevalue + $invoicevalue;
                
               
				$itemID=$value->id;
                        cartTemporary::where('id', $value->id)->update(['shipmentCOD' => null, 'shipmentOnline' => null]);
                
            } else {

               // cartTemporary::where('id', $value->id)->update(['shipmentCOD' => null,'shipmentOnline' => null]);
            }
            
        }
		
		}  
         
		
        return view($viewPath, compact('account','register','addresses', 'allAddresses','amount'));
		}else{
			return view($viewPath, compact('account'));
			
		}
    }else {

            $viewPath = 'theams/Front' . $account->theme . '/login';

         

            return view($viewPath);

        }
    }
    public function confirmOrder(Request $request){

        $input = $request->all();

        $rules = [
            'name' => 'required',
            'phone' => 'required|min:10',
            'email' => 'required',
            'landmark' => 'required',
            'address' => 'required',
            'zipCode' => 'required',
        ];

        $validation = Validator::make($input, $rules);
		
		 $isAddressSelected = false;
        if (isset($input['shipping_address']) && $input['shipping_address']) {
            $shipAddress = RegisterAddress::where('id', $input['shipping_address'])->first()->toArray();
            if ($shipAddress && !empty($shipAddress)) {
                $isAddressSelected = true;
                $input['name'] = $shipAddress['name'];
                $input['phone'] = $shipAddress['phone'];
                $input['email'] = $shipAddress['email'];
                $input['landmark'] = $shipAddress['landmark'];
                $input['address'] = $shipAddress['address'];
                $input['zipCode'] = $shipAddress['zipCode'];
                $input['cityId'] = $shipAddress['cityId'];
                $input['stateId'] = $shipAddress['stateId'];
            }
        } else {
            $register = Session::get('register');
            if ($register) {
                RegisterAddress::create(['register_id' => $register->id, 'name' => $input['name'], 'phone' => $input['phone'], 'email' => $input['email'], 'landmark' => $input['landmark'], 'address' => $input['address'], 'zipCode' => $input['zipCode'], 'cityId' => $input['cityId'], 'stateId' => $input['stateId']]);
            }
        }

        if ($validation->passes() || $isAddressSelected) {
			Session::put('addressCode','');
			Session::put('addressCodeID','');
            $inputData = base64_encode(json_encode($input));
            $customURL = url('/')."/confirmOrderProcess/".$inputData;
            
            if($input['transactionType'] == 1) {

                return redirect()->to($customURL);
                
            }else if($input['transactionType'] == 3){
                $api = new Api('rzp_test_MA9crdJykVQCcK', 'j9U0lJtfMywUIYP5iCn0q8ip');	
                $couponDiscountAmt=(isset($input['coupon_amount']) ? $input['coupon_amount'] : 0);
                $grandTotal = $input['grandTotal'] - $couponDiscountAmt;				
			    $order  = $api->order->create([
						  'receipt'         => $input['name'],
						  'amount'          => $grandTotal*100, 
						  'currency'        => 'INR',
						]);
				$razorpay_order_id = $order->id;
				Session::put('razorpay_order_id',$order->id);	
			    $account = Session::get('currentAccount');
				$user_data = ['name'=>$input['name'],'contact'=>$input['phone'],'email'=>$input['email']];
                $viewPath = 'theams/theam' . $account->theme . '/razorpayView';
				return view($viewPath)->with('account',$account)->with('inputData',$inputData)->with('razorpay_order_id',$razorpay_order_id)->with('user_data',$user_data);
			}else {
                
                $account = Session::get('currentAccount');
                
                $ApiKey = $account->instamojoApiKey;
                $AuthToken = $account->instamojoAuthToken;

                if($account->id<3) {

                    $url = 'https://test.instamojo.com/api/1.1/';

                } else {
                
                    $url = 'https://www.instamojo.com/api/1.1/';
                }
                
                $api = new \Instamojo\Instamojo(
                    
                    // config('services.instamojo.api_key'),
                    // config('services.instamojo.auth_token'),
                    // config('services.instamojo.url')

                    // 'dee8187d62c63d2955baf37889e35860',
                    // 'df569c61770b6a55f7dec9cc5d89ce9a',
                    $ApiKey,
                    $AuthToken,
                    $url
                );

                try {
					$couponDiscountAmt=(isset($input['coupon_amount']) ? $input['coupon_amount'] : 0);
                    $grandTotal = $input['grandTotal'] - $couponDiscountAmt;
                    $response = $api->paymentRequestCreate(array(
                        "purpose" => "Payment to $account->domain",
                        "amount" =>  $grandTotal,
                        "buyer_name" => $input['name'],
                        "send_email" => true,
                        "email" => $input['email'],
                        "phone" => $input['phone'],
                        "redirect_url" =>  $customURL,
                        ));
                        
                        header('Location: ' . $response['longurl']);
                        exit();

                } catch (\Exception $e) {
                    
                    return back()->withErrors(['Failed to pay. please try again.']);
                }
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }
    public function pinCodeCheck(Request $request)
    {
        $account = Session::get('currentAccount');
        $account_id = $account->id;
        $pickupPinCode = $account->pinCode;

        $input = $request->all();
        $pinCode = $input['data']['pinCode'];

        $paymentmode="online";
        $invoicevalue=rand(1,999999);
        $avnkey=$account->shipyaariClientCode.'@'.$account->shipyaariParentCode;
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
        // print_r($response);
        curl_close($post);

        // $validate = $response[0];
		//return $post_data;exit;
        $result = json_decode($response, true);
        // print_r($result);exit;
        return response()->json($result, 200);
    }
	
	 public function addressCode(Request $request)
    {   
        $account = Session::get('currentAccount');
        $input = $request->all();
        $addressCode = $input['data']['pinCode'];
        $addressCodeId = $input['data']['pinCodeId'];
        if($addressCode){
            Session::put('addressCode',$addressCode);
            Session::put('addressCodeID',$addressCodeId);
        }
        return response()->json(['status'=>'success'],200);
    }
    public function delwish($sku){

   
        DB::table('wishlist')->where('sku',$sku)->where('ragister_id',Session::get('register')->id)->delete();
        return back()->withErrors(['Failed to pay. please try again.']);
    }
    public function filterProduct(Request $request){
		$account = Session::get('currentAccount'); 
		$account_id = $account->id;
		$advance_product = AdvanceProduct::select('sku','thumbnail','title','product_price','selling_price',DB::Raw("TRUNCATE((product_price - selling_price ) / selling_price * 100,2) AS discount"))
		->leftJoin('advance_product_category', function ($join) use($account_id) {
                  $join->on('advance_product_category.setting_id', '=', 'advance_product.setting_id')
                  ->where('advance_product_category.account_id',$account_id);
                })
		->where('advance_product.account_id',$account_id)
		->where('advance_product.status','Active')
		->whereIn('advance_product.setting_id',explode(',',$account->subscribedTemplate));
		if(isset($request->id)&&$request->id!=''){
			$advance_product = $advance_product->where('advance_product_category.category',$request->id);
		}
        if(isset($request->search_key)&&$request->search_key!=''){
			$advance_product = $advance_product->where('search_key_words','like','%'.$request->search_key.'%');
		}
		if(isset($request->sub_id)&&$request->sub_id!=''){
			$advance_product = $advance_product->where('advance_product_category.sub_category',$request->sub_id);
		}
		if(isset($request->template_id)&&$request->template_id!=''){
			$advance_product = $advance_product->where('advance_product.setting_id',$request->template_id);
		}
		if(isset($request->minmumAmt)){
		   $advance_product = $advance_product->where('advance_product.selling_price','>=',$request->minmumAmt);
		}
		if(isset($request->maximumAmt)){
		$advance_product = $advance_product->where('advance_product.selling_price','<=',$request->maximumAmt);
		}
		if(isset($request->brand)){
		  $advance_product = $advance_product->whereIn('advance_product.brand',$request->brand);	
		}
		if(isset($request->color)){
		  $advance_product = $advance_product->whereIn('advance_product.color',$request->color);	
		}
		
		
		if(isset($request->multi_add_filter)){
			$tmp_id = AdvanceProductAttribute::select(DB::Raw("group_concat(advance_product_id) as advance_product_id"));
			//var_dump($request->multi_add_filter);exit;
			foreach($request->multi_add_filter as $key=>$row){
				$tmp_id = $tmp_id->whereRaw(DB::Raw("value REGEXP CONCAT('(^|,)(', REPLACE('".implode(',',$row)."', ',', '|'), ')(,|$)')"));
				$tmp_id = $tmp_id->where('attribute',$key);
			}
			
			$tmp_id = $tmp_id->first();
			if($tmp_id){
				$advance_product = $advance_product->whereIn('advance_product.id',explode(',',$tmp_id->advance_product_id));
			}
		  
		}
		
	
		if(isset($request->single_add_filter)&&count($request->single_add_filter)){
			$tmp_id = AdvanceProductAttribute::select(DB::Raw("group_concat(advance_product_id) as advance_product_id"));
			//var_dump($request->multi_add_filter);exit;
			foreach($request->single_add_filter as $key=>$row){
				$tmp_id = $tmp_id->where('value',$row);
				$tmp_id = $tmp_id->where('attribute',$key);
			}
			
			$tmp_id = $tmp_id->first();
			if($tmp_id){
				//$advance_product = $advance_product->whereIn('advance_product.id',explode(',',$tmp_id->advance_product_id));
			}
		  
		}
		
		if(isset($request->sortby)){
			$advance_product = $advance_product->orderBy('advance_product.selling_price',$request->sortby);
		}
		$advance_product = $advance_product->get();
		return $advance_product;
	}

    public function UserAbout(){
        $account = Session::get('currentAccount');
        $viewPath = 'theams/Front' . $account->theme . '/about';

        $account_id = $account->id;
        $register_id = Session::getId();

        $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();

        $aboutList = About::where('account_id', $account->id)->first();

        return view($viewPath, compact('account','cartList','aboutList'));
    }
    public function OverPrivacy(){
        $account = Session::get('currentAccount');
        $viewPath = 'theams/Front' . $account->theme . '/privacy';

        $account_id = $account->id;
        $register_id = Session::getId();

        $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();

        $privacyList = Privacy::where('account_id', $account->id)->first();
        return view($viewPath, compact('account','cartList', 'privacyList'));
    }
    public function ShippingPrivacy(){
            $account = Session::get('currentAccount');
            $viewPath = 'theams/Front' . $account->theme . '/shipping';

            $account_id = $account->id;
            $register_id = Session::getId();

            $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();

            $shippingList = Shipping::where('account_id', $account->id)->first();

            return view($viewPath, compact('account','cartList', 'shippingList'));
    }

    public function ReturnPrivacy(){
        $account = Session::get('currentAccount');
        $viewPath = 'theams/Front' . $account->theme . '/return';

        $account_id = $account->id;
        $register_id = Session::getId();

        $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();

        $returnList = Returning::where('account_id', $account->id)->first();

        return view($viewPath, compact('account','cartList', 'returnList'));
    }
   
    public function OrderList(){

    }
    public function ContactUs(){

    }
    public function TermsConditions(){

        $account = Session::get('currentAccount');
        $viewPath = 'theams/Front' . $account->theme . '/term';

        $account_id = $account->id;
        $register_id = Session::getId();

        $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();
        
        $termList = Term::where('account_id', $account->id)->first();
        return view($viewPath, compact('account','cartList', 'termList'));
    }
    public function Account(Request $request){
        $account = Session::get('currentAccount');
        $account_id = $account->id;

        $register = Session::get('register');
        $register_id = Session::getId();

        if($register) {

            $viewPath = 'theams/Front'. $account->theme . '/address';
            $allQuery = $request->all();
			$addressId = (isset($allQuery['address'])?$allQuery['address']:'');
            $allAddresses = null;
            $addresses =null;
            if($addressId){
                $addresses =  RegisterAddress::where('register_id', $register->id)->where('id',$addressId)->first();
            }else{
                $allAddresses = RegisterAddress::where('register_id', $register->id)->get();
            }
            $data = AdvanceProductOrder::where('register_id',$register->id)->orderBy('id','desc')->get();
            $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();

            ## coupon 
            $phone = null;
            //echo Session::get('register')->memebership_id;exit;
            $membership = Membership::where('id',Session::get('register')->memebership_id)->first();
            // Coupons 
            $currentDate = date('Y/m/d');
            $dataCoupon=DB::table('coupons')
            ->select('coupons.*','advance_product.title','advance_product.name as templatename','advance_product.selling_price','registers.name as username')
            ->leftJoin('advance_product','coupons.product_id','=','advance_product.id')
            ->leftJoin('registers','coupons.used_to','=','registers.id')
        
            ->where('coupons.send_to',$register->id)
            ->whereDate('coupons.validity_date', '>=', $currentDate)
            ->orderby('coupons.uesttime','DESC')->get();

            ## scheme
            $register_id = $register->id;
            $scheme = ReferralScheme::where('account_id',$account->id)->where('scheme_validity','>=',date('Y-m-d'))->whereRaw('FIND_IN_SET('.$register_id.',shared_with)')->get();

            return view($viewPath, compact('account','cartList','register','addresses','allAddresses','data','dataCoupon','membership','register_id','scheme'));

        } else {

            $viewPath = 'theams/Front' . $account->theme . '/login';

            $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();

            return view($viewPath, compact('account','cartList'));

        }
    }
    public function Contact(){
        $account = Session::get('currentAccount');
        $account_id = $account->id;

      

        $viewPath = 'theams/Front' . $account->theme . '/contact';
        
        $account_id = $account->id;
        $register_id = Session::getId();

        $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();
        
        $socialList = SocialMedia::where('account_id', $account->id)->first();
        
        return view($viewPath, compact('account','cartList', 'socialList'));
    }
    public function contactSubmit(Request $request)
    {
        $input = $request->all();

        $rules = [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'title' => 'required',
            'description' => 'required',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {

            $account = Session::get('currentAccount');
            //dd($account);
            $viewPath = 'theams/Front' . $account->theme . '/contact';

            $input['account_id'] = $account->id;
            unset($input['_token']);
            $logo = $account->domain.'/'.$account->logo;
            
            $contact = GeneralInquiry::create($input);
            if ($contact) {

                $register_id = Session::getId();
                $socialList = SocialMedia::where('account_id', $account->id)->first();

                $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account->id)->where('register_id', $register_id)->get();
                
                Mail::to($input['email'])->send(new WelcomeMail(['input'=>$input, 'account' => $account, 'logo' => $logo]));
                return view($viewPath, compact('account', 'socialList','cartList'));

            } else {

                return back()->withErrors(['Something went wrong']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }
    function return() {

        $account = Session::get('currentAccount');
        $viewPath = 'theams/Front' . $account->theme . '/returns-policy';

        $account_id = $account->id;
        $register_id = Session::getId();

        $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();

        $returnList = Returning::where('account_id', $account->id)->first();

        return view($viewPath, compact('account','cartList', 'returnList'));
    }
    public function orderCancel(Request $request)
    {
        $account = Session::get('currentAccount');

        $input = $request->all();
        $orderNo = $input['data']['orderNo'];
        $shipyaariId = $input['data']['shipyaariId']; // courierType

        if($shipyaariId != 'courierType') {

            //$avnkey="10393@5183";
            $avnkey = $account->shipyaariClientCode."@".$account->shipyaariParentCode;
                
            $request_url ='https://seller.shipyaari.com/avn_ci/siteadmin/cancel_consignment/';

            $post_data = ['avn_key' => $avnkey,'ids' =>[$shipyaariId]];

            $post = curl_init();
            curl_setopt($post, CURLOPT_URL, $request_url);
            curl_setopt($post, CURLOPT_POST,TRUE);
            curl_setopt($post, CURLOPT_POSTFIELDS, json_encode($post_data));
            curl_setopt($post, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($post, CURLOPT_HTTPHEADER, array('Accept:application/json' , 'Content-Type:application/json'));
            $response = curl_exec($post);
            curl_close($post);
            $result = json_decode($response, true);

            order::where('account_id', $account->id)->where('orderNo', $orderNo)->update(['orderStatus' =>18,'shipyaariCancel' =>$response]);

        } else {

            $response = 'Order Canceled';
            order::where('account_id', $account->id)->where('orderNo', $orderNo)->update(['orderStatus' =>18,'shipyaariCancel' =>'Order Canceled']);
        }
        
        return response()->json($response, 200);
    }


    public function forgotPassword()
    {

        $account = Session::get('currentAccount');
        $viewPath = 'theams/Front' . $account->theme . '/forgotPassword';

        $account_id = $account->id;
        $register_id = Session::getId();

        $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account_id)->where('register_id', $register_id)->get();
        $OTP = null;
        $phone = null;

        return view($viewPath, compact('account','cartList','OTP','phone'));
    }
    public function forgotPasswordSubmit(Request $request)
    {
        $input = $request->all();

        $rules = [
            'phone' => 'required|min:10',
        ];

        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {

            $account = Session::get('currentAccount');
            //dd($account);
            $viewPath = 'theams/Front' . $account->theme . '/forgotPassword';
            $phone = $input['phone'];

            $registerCheck = Register::where('account_id', $account->id)->where('phone', $phone)->first();
            if($registerCheck) {

                $register_id = Session::getId();
                $found = Msgnotify::where('account_id', $account->id)->where('msg_type', '6')->first();
                $cartList = cartTemporary::with('inventoryPrice','cartInventory')->where('account_id', $account->id)->where('register_id', $register_id)->get();

                $OTP = rand(1,999999);
                $sign_up_message = $found->messages;
				$sign_up_message = str_replace('[OTP]',$OTP,$sign_up_message);
                $message = urlencode($sign_up_message);
                
                //$url = "http://nimbusit.co.in/api/swsendSingle.asp?username=t1thekheewa&password=100719238&sender=KHEEWA&sendto=$phone&message=$message";
                //$url = "http://nimbusit.co.in/api/swsendSingle.asp?username=$account->SMSUserName&password=$account->SMSUserPassword&sender=$account->SMSUserSenderId&sendto=$phone&message=$message";
                
                $replace = str_replace('setUsername', $account->SMSUserName, $account->SMSApi);
                $replace1 = str_replace('setPassword', $account->SMSUserPassword, $replace);
                $replace2 = str_replace('setSenderId', $account->SMSUserSenderId, $replace1);
                $replace3 = str_replace('setPhone', $phone, $replace2);
                $replace4 = str_replace('setMessage', $message, $replace3);
                $replace5 = str_replace('setTEMPLATEID', $found->template_id,$replace4);
                $url = $replace5;
                //dd($url);
                $post = curl_init();
                curl_setopt($post, CURLOPT_URL, $url);
                curl_setopt($post, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($post, CURLOPT_CUSTOMREQUEST, 'GET');
                $response = curl_exec($post);
                curl_close($post);
                $result = json_decode($response, true);
                
                //dd($response);
                
                return view($viewPath, compact('account','cartList','OTP','phone'));

            } else {
                
                return back()->withErrors(['Enter Valid Number.']);
            }

        } else {

            $errors = $validation->errors();
            return back()->withErrors($errors);
        }
    }
    
    
	
}