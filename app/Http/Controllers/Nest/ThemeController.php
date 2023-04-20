<?php
namespace App\Http\Controllers\Nest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;
use Mail;
use App\Mail\ConfirmOrderMail;
use Session;
use Redirect;
use Razorpay\Api\Api;
use App\Models\Account;
use App\Models\Term;
use App\Models\Slider;
use App\Models\AdvanceProduct;
use App\Models\Purchaseoffer;
use App\Models\AdvanceProductCart;
use App\Models\Msgnotify;
use App\Models\Register;
use App\Models\RegisterAddress;
use App\Models\Coupon;
use App\Models\Membership;
use App\Models\AdvanceProductOrder;
use App\Models\AdvanceProductOrderDetail;
use App\Models\AdvanceProductSetting;
use App\Models\About;
use App\Models\Privacy;
use App\Models\Shipping;
use App\Models\Returning;
use App\Models\Affiliate;
use App\Models\Brand;
use App\Models\AccountCreditAffiliation; 
use App\Models\AffiliatePaymentHistory; 
use App\Models\ReferralScheme; 
use App\Models\OfferNormal; 
use App\Models\AdvanceProductAttribute; 
use App\Models\MembershipPage; 
use App\Models\Reviews; 
use PDF;
class ThemeController extends Controller
{
    public $theme_prefix = 'FrontEndTheme.Nest';
    public $razorpay_key    = 'rzp_live_txRWRjezURu9hd';
    public $razorpay_secret = 'fygIpUt3gpDD27b9VCKnhLU8';
    public function pdf_gen(){
		$data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y')
        ];
          
        $pdf = PDF::loadView('myPDF', $data);
    
        return $pdf->download('itsolutionstuff.pdf');
	}
    public function genrateOTP()
    {
        return 1234;
        //return rand(1000,9999);
        
    }

    public function index()
    { 
        $domainName = $this->activeDomain();
        $account = Account::where('domain', $domainName)->with(['currency'])
            ->first();
        if (!$account || $account->status == '0')
        {
            echo '<h1>Account Suspended</h1>';
            exit;
        }

        $account_id = $account->id;
        $popular_product = AdvanceProduct::select('sku', 'thumbnail', 'title', 'product_price', 'selling_price', DB::Raw("TRUNCATE((product_price - selling_price ) / selling_price * 100,2) AS discount"))->where('status', 'Active')
            ->where('account_id', $account_id)->where('qc', 1)
            ->limit(10)
            ->orderBy('id', 'desc')
            ->inRandomOrder()
            ->get();
		$deals = AdvanceProduct::select('sku', 'thumbnail', 'title', 'product_price', 'selling_price', DB::Raw("TRUNCATE((product_price - selling_price ) / selling_price * 100,2) AS discount"))->where('status', 'Active')
            ->where('account_id', $account_id)->where('qc', 1)
            ->limit(10)
            ->orderBy('id', 'desc')
            ->inRandomOrder()
            ->get();

        $advance_product = AdvanceProduct::select('sku', 'thumbnail', 'title', 'product_price', 'selling_price', DB::Raw("TRUNCATE((product_price - selling_price ) / selling_price * 100,2) AS discount"))->where('status', 'Active')
            ->where('account_id', $account_id)->where('qc', 1)
            ->limit(3)
            ->orderBy('id', 'desc')
            ->get();

        $discount = AdvanceProduct::select('sku', 'thumbnail', 'title', 'product_price', 'selling_price', DB::Raw("TRUNCATE((product_price - selling_price ) / selling_price * 100,2) AS discount"))->where('account_id', $account_id)->where('status', 'Active')
            ->where('qc', 1)
            ->limit(10)
            ->orderBy('discount', 'desc')
            ->get();

        $trending = AdvanceProduct::select('sku', 'thumbnail', 'title', 'product_price', 'selling_price', DB::Raw("TRUNCATE((product_price - selling_price ) / selling_price * 100,2) AS discount"))->where('account_id', $account_id)->where('status', 'Active')
            ->where('qc', 1)
            ->limit(3)
            ->orderBy('views', 'desc')
            ->get();

        

        $slider = DB::table('banner_home_page_slider')
		          ->where('account_id', $account_id)
				  ->where('type', 'Home'.$account->home_page)
                  ->get();
		$home6 = DB::table('banner_home_page_slider')
		          ->where('account_id', $account_id)
				  ->where('type', 'Home'.$account->home_page)
                  ->first();
		$home2right = DB::table('banner_daily_best_sell_banner')
		          ->where('account_id', $account_id)
				  ->where('type', 'Home2-Right')
                  ->first();
		$Home5RightBottom = DB::table('banner_daily_best_sell_banner')
		          ->where('account_id', $account_id)
				  ->where('type', 'Home5-RightBottom')
                  ->first();
	    $Home5RightUpper = DB::table('banner_daily_best_sell_banner')
		          ->where('account_id', $account_id)
				  ->where('type', 'Home5-RightUpper')
                  ->first();
		$dailyBestSell = DB::table('banner_daily_best_sell_banner')
		          ->where('account_id', $account_id)
				  ->where('type', 'Home'.$account->home_page)
                  ->first();
        $category_banner = DB::table('banner_category_home_page_banner')
				->where('account_id', $account_id)
				->where('type', 'Home'.$account->home_page)
				->get();
		$subCategory_banner = DB::table('banner_category_home_page_banner')
				->where('account_id', $account_id)
				->where('type', 'Home5-subCategory')
				->get();
		$categoryIcon = DB::table('banner_category_icon')
				->where('account_id', $account_id)
				->get();
        $deals_of_the_day = DB::table('banner_deals_of_the_day')->select('banner_deals_of_the_day.image', 'banner_deals_of_the_day.sku', 'banner_deals_of_the_day.date', 'advance_product.title', 'advance_product.selling_price', 'advance_product.product_price')
            ->leftJoin('advance_product', 'advance_product.sku', '=', 'banner_deals_of_the_day.sku')
            ->where('type', 'Home'.$account->home_page)
            ->where('advance_product.qc', 1)
            ->where('date','>=', date('Y-m-d'))
            ->where('banner_deals_of_the_day.account_id', $account_id)->groupBy('banner_deals_of_the_day.id')
            ->get();
        
        //var_dump($deals_of_the_day);exit;
		if($account->home_page==1||$account->home_page==2||$account->home_page==5){
			$home_page = 'index';
		}else{
			$home_page = 'index';
		}
        $return = view($this->theme_prefix . '.'.$home_page)
                  ->with('slider', $slider)
				  ->with('popular_product', $popular_product)
				  ->with('advance_product', $advance_product)
				  ->with('discount', $discount)
				  ->with('trending', $trending)
				  ->with('Home5RightBottom', $Home5RightBottom)
				  ->with('Home5RightUpper', $Home5RightUpper)
				  ->with('subCategory_banner', $subCategory_banner)
				  ->with('deals', $deals)
				  ->with('home6', $home6)
				  ->with('deals_of_the_day', $deals_of_the_day)
				  ->with('category_banner', $category_banner)
				  ->with('home2right', $home2right)
				  ->with('dailyBestSell', $dailyBestSell)
				  ->with('categoryIcon', $categoryIcon);
        if (isset($_COOKIE['recently']))
        {
            $recently = "'" . implode("','", explode(",", $_COOKIE['recently'])) . "'";
            //var_dump($recently);exit;
            $viewed = AdvanceProduct::select('sku', 'thumbnail', 'title', 'product_price', 'selling_price', DB::Raw("TRUNCATE((product_price - selling_price ) / selling_price * 100,2) AS discount"))->where('account_id', $account_id)->where('status', 'Active')
                ->whereIn('sku', explode(",", $_COOKIE['recently']))->where('qc', 1)
                ->limit(3)
                ->orderByRaw(DB::Raw(" FIELD(`sku`, " . $recently . ")"))->get();
            //dd($viewed);
            $return = $return->with('viewed', $viewed);
        }

        return $return;
    }
    public function about()
    {
        $domainName = $this->activeDomain();
        $account = Account::where('domain', $domainName)->with(['currency'])
            ->first();
        $aboutList = About::where('account_id', $account->id)
            ->first();
        $viewPath = $this->theme_prefix . '.pages.about';
        $return = view($viewPath)->with('aboutList', $aboutList);
        return $return;
    }
    public function privacy()
    {
        $domainName = $this->activeDomain();
        $account = Account::where('domain', $domainName)->with(['currency'])
            ->first();
        $privacyList = Privacy::where('account_id', $account->id)
            ->first();
        $viewPath = $this->theme_prefix . '.pages.privacy';
        $return = view($viewPath)->with('privacyList', $privacyList);
        return $return;
    }
    public function shippingPolicy()
    {
        $domainName = $this->activeDomain();
        $account = Account::where('domain', $domainName)->with(['currency'])
            ->first();
        $shippingList = Shipping::where('account_id', $account->id)
            ->first();
        $viewPath = $this->theme_prefix . '.pages.shipping';
        $return = view($viewPath)->with('shippingList', $shippingList);
        return $return;
    }
    public function returnPolicy()
    {
        $domainName = $this->activeDomain();
        $account = Account::where('domain', $domainName)->with(['currency'])
            ->first();
        $returnList = Returning::where('account_id', $account->id)
            ->first();
        $viewPath = $this->theme_prefix . '.pages.return';
        $return = view($viewPath)->with('returnList', $returnList);
        return $return;
    }
    public function productDetail($sku)
    {
        $domainName = $this->activeDomain();
        $account = Account::where('domain', $domainName)->with(['currency'])
            ->first();
        Session::put('currentAccount', $account);
        if (isset($_REQUEST['aff']))
        {
            setcookie("aff_id", $_REQUEST['aff'], time() + 31556926, '/');
            setcookie("aff_count", 5, time() + 31556926, '/');
        }

        $account = Session::get('currentAccount');
        $advance_product = AdvanceProduct::with('threeStar','oneStar','twoStar','fourStar','fiveStar')->where('sku', $sku)->first();
        if ($advance_product->status != 'Active' || (!in_array($advance_product->setting_id, explode(',', $account->subscribedTemplate))))
        {
            //echo $account->subscribedTemplate;
            echo 'Invalid link';
            // print_r($advance_product);
            exit;
        }
        $register_id = Session::getId();
        $viewPath = $this->theme_prefix . '.product-detail';
        $return = view($viewPath, compact('advance_product', 'account'));
        if ($advance_product
            ->setting->grouping != Null && $advance_product->grouping_name != Null)
        {
            $group = AdvanceProduct::where('sku', '!=', $sku)->where('account_id', $account->id)
                ->where('setting_id', $advance_product->setting_id)
				->where('advance_product.qc', 1)
                ->whereNotNull('grouping_name')
                ->where('grouping_name',$advance_product->grouping_name)
				->where('status','Active')
                ->get();

            $return = $return->with('group', $group);

        }
        if (isset($_COOKIE['recently']))
        {
            $recently = explode(',', $_COOKIE['recently']);
            array_unshift($recently, $sku);
            $recently = array_unique($recently);
            array_slice($recently, 0, 8);
            //var_dump($recently);exit;
            setcookie("recently", implode(',', $recently) , time() + 31556926, '/');
        }
        else
        {
            setcookie("recently", $sku, time() + 31556926, '/');
        }

        $new_product = AdvanceProduct::select('sku', 'thumbnail', 'title', 'product_price', 'selling_price', DB::Raw("TRUNCATE((product_price - selling_price ) / selling_price * 100,2) AS discount"))->where('status', 'Active')
            ->where('account_id', $account->id)
            ->where('qc', 1)
            ->limit(4)
            ->orderBy('id', 'desc')
            ->get();
        $rel_product = AdvanceProduct::select('sku', 'thumbnail', 'title', 'product_price', 'selling_price', DB::Raw("TRUNCATE((product_price - selling_price ) / selling_price * 100,2) AS discount"))->where('status', 'Active')
            ->where('account_id', $account->id)
            ->where('setting_id', $advance_product->setting_id)
            ->where('qc', 1)
            ->limit(4)
            ->orderBy('id', 'desc')
            ->get();
        $return = $return->with('new_product', $new_product);
        $return = $return->with('rel_product', $rel_product);
        if (isset($_REQUEST['scheme']))
        {

            $scheme = ReferralScheme::where('account_id', $account->id)
                ->where('scheme_validity', '>=', date('Y-m-d'))
                ->where('offering_product', $sku)->where('status', '1')
                ->where('id', urldecode(base64_decode($_REQUEST['scheme'])))->first();

            if (!$scheme)
            {
                echo 'You have entered invalid link or it is expired, Please <a href="' . url('/') . '">Click here</a> to go to home page.';
                exit;
            }
            else
            {
                $return = $return->with('scheme', $scheme);
            }
        }
        $catalouge = DB::table('advance_product_catalogue')
		             ->where('product_id',$advance_product->id)
		             ->where('account_id',$account->id)
					 ->get();
        AdvanceProduct::where('sku', $sku)->update(['views' => ($advance_product->views + 1) ]);
        return $return->with('catalouge',$catalouge);
    }

    public function addToCart(Request $request)
    {
        $registerId = Session::getId();
        $domainName = $this->activeDomain();
        $account = Account::where('domain', $domainName)->with(['currency'])
            ->first();
		$data = AdvanceProduct::where('id',$request->product_id)->first();
        $checkInventory = AdvanceProductCart::where('product_id', $request->product_id)
            ->where('account_id', $account->id)
            ->where('register_id', $registerId)->first();
        if ($checkInventory)
        {
            AdvanceProductCart::where('product_id', $request->product_id)
                ->where('account_id', $account->id)
                ->where('register_id', $registerId)->update([
				'qty' => $checkInventory->qty + $request->quantity,
				'price' => $data->selling_price,
				]);
        }
        else
        {
            AdvanceProductCart::insert([
			 'qty' => $request->quantity,
			 'price' => $data->selling_price,
			 'product_id'=>$request->product_id,
			 'register_id'=>$registerId,
			 'account_id' => $account->id, 'register_id' => $registerId,
			 'scheme_id'=>( isset($request->scheme_id)? $request->scheme_id : '' )
			 ]);
        }
        if (isset($request->buy_now))
        {
            return redirect('checkout');
        }
        else
        {
            return Redirect::back()
                ->with('status', 'Added Successfully.');
        }
    }
	public function updateCart(Request $request){
		$registerId = Session::getId();
        $domainName = $this->activeDomain();
        $account = Account::where('domain', $domainName)->with(['currency'])
            ->first();
		if(isset($request->id)&&count($request->id)){
		 foreach($request->id as $key=>$row){
			 $name = 'qty'.$row;
			AdvanceProductCart::where('id',$row)
                ->where('account_id', $account->id)
                ->where('register_id', $registerId)->update(['qty' => $request->$name]);
		 }
		}
		return Redirect::back()
            ->with('status', 'Product removed from cart successfully.');
	}
	public function remove_cart($id){
		$registerId = Session::getId();
        $domainName = $this->activeDomain();
        $account = Account::where('domain', $domainName)->with(['currency'])
            ->first();
		if($id=='all'){
			AdvanceProductCart::
			  where('account_id', $account->id)
            ->where('register_id', $registerId)
			->delete();
			return redirect('/');
		}else{
			AdvanceProductCart::where('id', $id)
            ->where('account_id', $account->id)
            ->where('register_id', $registerId)
			->delete();
			return Redirect::back()
            ->with('status', 'Product removed from cart successfully.');
		}
	}
	
    public function cart()
    {
        $viewPath = $this->theme_prefix . '.cart';
        $return = view($viewPath);
        return $return;
    }
    public function checkout()
    {
        $viewPath = $this->theme_prefix . '.checkout';
        $return = view($viewPath);
        $amount = 0;
        if (Session::get('register'))
        {
            $register = Session::get('register');
            $all_address = RegisterAddress::where('register_id', $register->id)
                ->whereNotNull('name')
                ->where('name', '!=', '')
                ->orderBy('id')
                ->get();
            $amount=$this->FinalAmount($register->id);
            $return = $return->with('amount', $amount);
			if(Session::get('selected_address')){
				$pin = RegisterAddress::where('id',Session::get('selected_address'))
				->first();
				$cart = AdvanceProductCart::select('advance_product_cart.product_id','advance_product_cart.id')
				->where('advance_product_cart.register_id',Session::getId())
						->leftJoin('advance_product','advance_product.id','=','advance_product_cart.product_id')
						->where('advance_product.shipping_method','Exclusive')
						->get();
				foreach($cart as $row){
					$shipping = $this->zipCodeCheck($row->product_id,$pin->zipCode);
                    print_r($shipping);
					$is_servicable = $shipping['servicable'];
					$return = $return->with('is_servicable', $is_servicable);
						AdvanceProductCart::where('id',$row->id)
						->update([
						  'shipping'=>$shipping['price']
						]);
					
				}
			}
            $return = $return->with('all_address', $all_address);
        }else{
            $return = $return->with('amount', $amount);
        }
        return $return;
    }

    public function submitMobilefromCheckoutp(Request $request)
    {
        $domainName = $this->activeDomain();
        $account = Account::where('domain', $domainName)->with(['currency'])
            ->first();
        $account_id = $account->id;
        $register = Register::where('account_id', $account->id)
            ->where('phone', $request->mobile)
            ->where('status', 1)
            ->first();
        $found = Msgnotify::where('account_id', $account_id)->where('msg_type', ($register ? 5 : 4))->first();
        $OTP = rand(1000, 9999);
        //$OTP = 123456;
        Session::put('otp', $OTP);
        $sign_up_message = $found->messages;
        $sign_up_message = str_replace('[OTP]', $OTP, $sign_up_message);
        $message = urlencode($sign_up_message);
        Session::put('loginOtp', $OTP);
        $account = Session::get('currentAccount');
        $replace = str_replace('setUsername', $account->SMSUserName, $account->SMSApi);
        $replace1 = str_replace('setPassword', $account->SMSUserPassword, $replace);
        $replace2 = str_replace('setSenderId', $account->SMSUserSenderId, $replace1);
        $replace3 = str_replace('setPhone', $request->mobile, $replace2);
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
        $result = json_decode($response, true);
        if ($register)
        {
            $array = ['error' => false, 'is_new' => false, 'message' => 'Otp sent to registered number.'];
        }
        else
        {
            $array = ['error' => false, 'is_new' => true, 'message' => 'Otp sent.'];
        }
        return $array;
    }
    public function verifyOTP(Request $request)
    {
        $domainName = $this->activeDomain();
        $account = Account::where('domain', $domainName)->with(['currency'])
            ->first();
        $account_id = $account->id;
        $register = Register::where('account_id', $account->id)
            ->where('phone', $request->mobile)
            ->where('status', 1)
            ->first();
        $found = Msgnotify::where('account_id', $account_id)->where('msg_type', ($register ? 5 : 4))->first();
        if ($request->otp == Session::get('otp'))
        {
            if (!$register)
            {
                $register = Register::create(['account_id' => $account->id, 'name' => '', 'phone' => $request->mobile, 'email' => '', 'password' => $request->password]);
            }
            Register::where('id',$register->id)->update(['last_login_at'=>date('Y-m-d H:i:s')]);
            Session::put('isLoggedIn', true);
            Session::put('register', $register);
            AdvanceProductCart::where('register_id', Session::getId())->update(['register_user_id' => $register->id]);
            Session::save();
            $array = ['error' => false, 'message' => 'OTP Verified successfully.'];
        }
        else
        {
            $array = ['error' => true, 'message' => 'Entered otp is incorrect.'];
        }
        return $array;
    }
    public function updateAddress(Request $request)
    {
        Session::put('selected_address', $request->selected_address);
        return Redirect::back()
            ->with('status', 'Updated Successfully.');
    }
	public function applyCoupon(Request $request)
    {
        return $this->applyCouponBackEnd($request->cart_value,$request->coupon_code);
    }
	public function applyCouponBackEnd($cart_value,$coupon_code){
		$account = Session::get('currentAccount'); 
        $account_id =$account->id;
        $register = Session::get('register');
        $registerId = $register->id;
	    $discountAmount = 0;
		$product_id = '';
		$check_product_counpon = AdvanceProductCart::where('register_id',Session::getId())
		                         ->select('product_discount_offer.id','product_discount_offer.per_user','advance_product_cart.qty','advance_product.selling_price','product_discount_offer.discount','product_discount_offer.maximum_discount','advance_product.id as pr_id')
		                         ->leftJoin('advance_product','advance_product.id','=','advance_product_cart.product_id')
		                         ->leftJoin('product_discount_offer','product_discount_offer.sku','=','advance_product.sku')
		                         ->where('product_discount_offer.start_date','<=',date("Y-m-d H:i:s"))
		                         ->where('product_discount_offer.end_date','>=',date("Y-m-d H:i:s"))
		                         ->where('product_discount_offer.account_id',$account_id)
		                         ->where('product_discount_offer.coupon_code',$coupon_code)
			                     ->first();
        $firsr_pr = AdvanceProductCart::where('register_id',Session::getId())->first();
        $SaleX=Coupon::where('status', 1)->where('coupon',$coupon_code)->where('template',$firsr_pr->product->setting_id)->whereDate('validity_date', '>=', date("Y-m-d"))->first();#sale x coupon 
		if($check_product_counpon){
			$used = AdvanceProductOrder::where('coupon',$coupon_code)->where('register_id',Session::get('register')->id)->count();
			if($used<$check_product_counpon->per_user){
				$msg   = "Coupon applied successfully.<a href='".url('checkout')."'>remove coupon ".$coupon_code.".</a>";
				$error = false;
				$type='product';
				$product_id=$check_product_counpon->pr_id;
				$discountAmount = ($check_product_counpon->qty*$check_product_counpon->selling_price)*($check_product_counpon->discount/100);
				if($discountAmount>$check_product_counpon->maximum_discount){
					$discountAmount = $check_product_counpon->maximum_discount;
				}
			}else{
				$msg   = "Coupon already used.";
				$error = true;
				$type='product';
			}
        }else if($SaleX) {
            /*$type='salex';
            $discountAmount = number_format($SaleX->refferal_benifit);
            $msg = 'Coupon Found';
            $product_id=$firsr_pr->product_id;
            $error = false;*/
            if($SaleX->user_type=='All'){
                $type='salex';
                $discountAmount =  ($firsr_pr->qty*$firsr_pr->product->selling_price*number_format($SaleX->refferal_benifit))/100;
                $msg = 'Coupon Found';
                $product_id=$firsr_pr->product_id;
                $error = false;
            }else{
                $checkOrder = AdvanceProductOrder::where('register_id',$registerId)->get();
                if(count($checkOrder)){
                    $type='salex';
                    $msg = 'Coupon is only avilable for new users.';
                    $error = true;
                }else{
                    $type='salex';
                    $discountAmount = ($firsr_pr->qty*$firsr_pr->product->selling_price*number_format($SaleX->refferal_benifit))/100;;
                    $msg = 'Coupon Found';
                    $product_id=$firsr_pr->product_id;
                    $error = false;
                    
                }
            }
            /*if ($discountAmount > $SaleX->refferal_benifit) {
                $discountAmount = $discountAmount;
                $msg = 'Coupon Found';
                $error = false;
            }else{
                $msg = 'Coupon not Found';
                $error = true;
            }*/
		}else{
			$type='cart';
			$product_id=Null;
		    $currentDate = date("Y-m-d");
			$datevalidity = date('Y/m/d',strtotime('-30 days',strtotime(str_replace('/', '-', $currentDate)))) . PHP_EOL;
			$offerData = OfferNormal::where('account_id',$account_id)
						 ->where('couponCode',$coupon_code)
						 ->whereDate('startDate', '<=', $currentDate)
						 ->whereDate('endDate', '>=', $currentDate)
						 ->where('status', 1)
						 ->first();
			if($offerData){
				if ($cart_value < $offerData->cartMinValue) {
					$msg = 'Coupon can be apply to minimum RS.' . $offerData->cartMinValue;
					$error = false;
				}else {
					$discountAmount = number_format(($cart_value * ($offerData->discount / 100)));
					if ($discountAmount > $offerData->cartMinValue) {
						$discountAmount = $discountAmount;
					}
					$msg = "Discount of ".$discountAmount." applied successfully, <a href='".url('checkout')."'>remove coupon ".$coupon_code.".</a>";
					$error = false;
				}
			}else{
				$msg = "Coupon does not match.";
				$error = true;
			}
		}
        if($discountAmount<0){
            $discountAmount = 0;
        }
		return array('error'=>$error,'message'=>$msg,'discount'=>$discountAmount,'type'=>$type,'product_id'=>$product_id);
	}
    public function processOrder(Request $request)
    {

        # check sale coupon
        $currentDate = date("Y-m-d");
        $firsr_pr = AdvanceProductCart::where('register_id',Session::getId())->first();
        $SaleXfor = Coupon::where('status', 1)->where('coupon', $request->coupon_code)
            ->where('template', $firsr_pr->product->setting_id)
            ->whereDate('validity_date', '>=', $currentDate)->first();
        $wallet_tr_details = [];
        if ($SaleXfor)
        {
            $xcoupondiscount = $SaleXfor->refferal_benifit;
            $refree_benifit = $SaleXfor->refree_benifit;
            $wallet_tr_details['coupon_id']       = $SaleXfor->id;
            $wallet_tr_details['xcoupondiscount'] = $SaleXfor->refferal_benifit;
            $wallet_tr_details['refree_benifit']  = $SaleXfor->refree_benifit;
            $wallet_tr_details['coupon_code']     = $request->coupon_code;
            $wallet_tr_details['send_to']         = $SaleXfor->send_to;
        }
        else
        {
            $xcoupondiscount = '0';
        }
        if (isset($refree_benifit))
        {
            $register = Session::get('register');
            $registerId = $register->id;
            $date = date('Y/m/d h:i:s A');
            $amount = ($this->FinalAmount($SaleXfor->send_to) + $refree_benifit);
            //$wallet_amount = DB::table('wallets')->insert(['transaction_id' => '', 'account_id' => $SaleXfor->send_to, 'credit' => $refree_benifit, 'amount' => $amount, 'status' => '0']);
            //Coupon::where('id', $SaleXfor->id)->update(['status' => 0, 'uesttime' => $date, 'product_id' => $request->product_id, 'product_sale_price' => '', 'used_to' => $registerId]);
        }

        $account = Session::get('currentAccount');
        $account_id = $account->id;
        $register = Session::get('register');
        $registerId = $register->id;
        $address_id = Session::get('selected_address');
        $address = RegisterAddress::where('id', $address_id)->first();
        $cartList = AdvanceProductCart::where('register_id', Session::getId())->get();

        $total = 0;
        $order_id = time();
        $array = [];
        $package_details = [];
        $totalQty = 0;
        $totalLengthArray = [];
        $totalWidthArray = [];
        $shipRocketPrArray = [];
        $delhiveryArray = [];
        $totalWeight = 0;
        $totalHeight = 0;
        $is_aff = false;
        $total_aff_amount = 0;
        $aff_release_payment = 0;
        $aff_array = [];
        $aff_insert_array = [];
        foreach ($cartList as $row)
        {
            $product_price = $row
                ->product->product_price;
            $referral_id = Null;
            if ($row->product->is_affiliation == 'Yes')
            {
                array_push($aff_array,[$row->product->id,$row->qty]);
                $is_aff = true;
                
                
                
            }
            if(isset($_COOKIE['aff_id'])){
                $aff_id = $_COOKIE['aff_id'];
                $pre_aff = Affiliate::where('code', $aff_id)->first();
                $preAmount = AccountCreditAffiliation::where('account_id', $account->id)->first();
                $aff_remaining_amount = $pre_aff->commission;
                $comp_remaining_amount = $preAmount->amount;
                if($row->product->is_affiliation == 'Yes'&&$request->transactionType==1&&$row->product->affiliation_payment_release_cod!=Null){
                    $total_aff_amount += $row->product->affiliation_price*$row->qty;
                    $aff_payment_status = 0;
                    if($row->product->affiliation_payment_release_cod=='On Order recieved'){
                        $aff_payment_status = 1;
                        $aff_release_payment += $row->product->affiliation_price*$row->qty;
                    }
                    $aff_remaining_amount  = $aff_remaining_amount+ ($row->product->affiliation_price*$row->qty);
                    $comp_remaining_amount = $comp_remaining_amount- ($row->product->affiliation_price*$row->qty);
                    array_push($aff_insert_array,['account_id' => $account->id, 'user_type' => 'affiliate', 'affiliate_id' => $aff_id, 'reference_id' => $order_id, 'type' => 'Order', 'amount' => $row->product->affiliation_price*$row->qty, 'remaining_amount' => $aff_remaining_amount,'status'=>$aff_payment_status,'sub_reference_id'=>$row->product_id,'term'=>$row->product->affiliation_payment_release_cod]);
                    array_push($aff_insert_array,['account_id' => $account->id, 'user_type' => 'seller', 'affiliate_id' => $aff_id, 'reference_id' => $order_id, 'type' => 'Order', 'amount' => $row->product->affiliation_price*$row->qty, 'remaining_amount' => $comp_remaining_amount,'status'=>$aff_payment_status,'sub_reference_id'=>$row->product_id,'term'=>$row->product->affiliation_payment_release_cod]);
                }
                /*if($row->product->is_affiliation == 'Yes'&&$request->transactionType!=1&&$row->product->affiliation_payment_release_online!=Null){
                    $total_aff_amount += $row->product->affiliation_price*$row->qty;
                    $aff_payment_status = 0;
                    if($row->product->affiliation_payment_release_cod=='On Order recieved'||$row->product->affiliation_payment_release_cod=='On Payment Received'){
                        $aff_payment_status = 1;
                        $aff_release_payment += $row->product->affiliation_price*$row->qty;
                    }
                    $aff_remaining_amount  = $aff_remaining_amount+ ($row->product->affiliation_price*$row->qty);
                    $comp_remaining_amount = $comp_remaining_amount- ($row->product->affiliation_price*$row->qty);
                    array_push($aff_insert_array,['account_id' => $account->id, 'user_type' => 'affiliate', 'affiliate_id' => $aff_id, 'reference_id' => $order_id, 'type' => 'Order', 'amount' => $row->product->affiliation_price*$row->qty, 'remaining_amount' => $aff_remaining_amount,'status'=>$aff_payment_status,'sub_reference_id'=>$row->product_id,'term'=>$row->product->affiliation_payment_release_online]);
                    array_push($aff_insert_array,['account_id' => $account->id, 'user_type' => 'seller', 'affiliate_id' => $aff_id, 'reference_id' => $order_id, 'type' => 'Order', 'amount' => $row->product->affiliation_price*$row->qty, 'remaining_amount' => $comp_remaining_amount,'status'=>$aff_payment_status,'sub_reference_id'=>$row->product_id,'term'=>$row->product->affiliation_payment_release_online]);
                }*/
            }

            $row_total = 0;
            $special_charges_label = $special_charges = '';
            if (!$row->scheme_id)
            {
				if($row->product->dynamic_selling_price!=0&& date("Y-m-d H:i:s",strtotime("-15 minutes ".$row->created_at)) < date("Y-m-d H:i:s")){
					$product_price = $row
                        ->product->dynamic_selling_price;
				}else{
					$product_price = $row
                        ->product->selling_price;
				}
                if ($row
                    ->product->tax_method != 'Inclusive')
                {
                    $row_total = $row->qty * ($product_price + $row
                        ->product
                        ->product_tax_value);
                }
                else
                {
                    $row_total = $row->qty * ($product_price);
                }
				$row_total += $row->qty*$row->shipping;
            }
            else
            {
                $row_total = $row
                    ->ReferralScheme->special_charges ;
                $special_charges_label = $row
                    ->ReferralScheme->special_charges_label;
                $special_charges = $row
                    ->ReferralScheme->special_charges;
                $product_price = $row
                    ->ReferralScheme->special_charges;
                $referral_id = $row
                    ->ReferralScheme->id;
            }
            $total += $row_total;

            $array[] = ['order_id' => $order_id, 'product_id' => $row
                ->product->id, 'title' => $row
                ->product->title, 'thumbnail' => $row
                ->product->thumbnail, 'product_price' => $product_price, 'shipping_charges' => $row
                ->qty*$row
                ->shipping, 'selling_price' => $product_price, 'product_tax' => $row
                ->product->product_tax_value, 'tax_method' => $row
                ->product->tax_method, 'cess' => 0, 'height' => $row
                ->product->height, 'width' => $row
                ->product->width, 'length' => $row
                ->product->length, 'weight' => $row
                ->product->weight, 'total' => $row_total, 'qty' => $row->qty, 'offerDescription' => Null, 'is_aff' => (isset($_COOKIE['aff_id']) && $row
                ->product->is_affiliation == 'Yes' ? 1 : 0) , 'aff_id' => (isset($_COOKIE['aff_id']) && $row
                ->product->is_affiliation == 'Yes' ? $_COOKIE['aff_id'] : Null) , 
                'aff_amount' => (isset($_COOKIE['aff_id']) && $row->product->is_affiliation == 'Yes' ? ($row->product->affiliation_price*$row->qty) : Null) , 
                'special_charges_label' => $special_charges_label, 'special_charges' => $special_charges, 'referral_id' => $referral_id];
            array_push($package_details, ["name" => $row
                ->product->title, "total" => $row->qty * $product_price, "qty" => $row->qty, "sku" => $row
                ->product->sku, "hsn" => $row
                ->product->hsn_code]);
            array_push($shipRocketPrArray, ["name" => $row
                ->product->title, "sku" => $row
                ->product->sku, "units" => $row->qty, "selling_price" => $row->qty * $product_price, "discount" => 0, "tax" => $row
                ->product->product_tax_value * $row->qty, "hsn" => $row
                ->product->hsn_code]);
                $delhiVeryPayload = [
                    "shipments"=>[
                                     [
                                      "add" => $address->address.', '.$address->landmark,
                                      "phone" =>$address->phone,
                                      "payment_mode" => ($request->transactionType == 1 ? 'COD' : 'Prepaid'),
                                      "name" => $address->name,
                                      "pin" => $address->zipCode,
                                      "order" => $order_id,
                                      "shipping_mode" => "Express",
                                      "weight"=>$row->product->weight,
                                      "shipment_height"=>$row->product->height,
                                      "shipment_width"=>$row->product->width,
                                      "shipment_length"=>$row->product->length,
                                      "state"=>$address->stateId,
                                      "total_amount"=>$row->qty * $product_price,
                                      "city"=>$address->cityId,
                                      "products_desc"=>$row->product->title,
                                      "order_date"=>date("Y-m-d H:i:s"),
                                      "quantity"=>$row->qty,
                                      "country"=>"India"
                                     ]
                                 ],
                    "pickup_location"=>[
                      "name"=> "Streamline Pharma Pvt Ltd"
                    ]
                ];
            $totalQty += $row->qty;
            $totalWeight += $row
                ->product->weight;
            $totalHeight += $row
                ->product->height;
            array_push($totalLengthArray, $row
                ->product
                ->length);
            array_push($totalWidthArray, $row
                ->product
                ->width);
            /****************************************/
            if ($row
                ->product->purchase_product_offer && $row->qty >= $row
                ->product
                ->purchase_product_offer
                ->qty)
            {
                $offerered_qty = intdiv($row->qty, $row
                    ->product
                    ->purchase_product_offer
                    ->qty);
                /**********************free product***************/
                $row_total = 0;
                if ($row
                    ->product
                    ->purchase_product_offer
                    ->offerProduct->tax_method != 'Inclusive')
                {
                    $row_total = $offerered_qty * ($row
                        ->product
                        ->purchase_product_offer
                        ->offerProduct->selling_price + $row
                        ->product
                        ->purchase_product_offer
                        ->offerProduct
                        ->product_tax_value);
                }
                else
                {
                    $row_total = $offerered_qty * ($row
                        ->product
                        ->purchase_product_offer
                        ->offerProduct
                        ->selling_price);
                }

                $array[] = ['order_id' => $order_id, 'product_id' => $row
                    ->product
                    ->purchase_product_offer
                    ->offerProduct->id, 'title' => $row
                    ->product
                    ->purchase_product_offer
                    ->offerProduct->title, 'thumbnail' => $row
                    ->product
                    ->purchase_product_offer
                    ->offerProduct->thumbnail, 'product_price' => $row
                    ->product
                    ->purchase_product_offer
                    ->offerProduct->product_price, 'shipping_charges' => $row
                    ->product
                    ->purchase_product_offer
                    ->offerProduct->shipping_charges, 'selling_price' => $row
                    ->product
                    ->purchase_product_offer
                    ->offerProduct->selling_price, 'product_tax' => $row
                    ->product
                    ->purchase_product_offer
                    ->offerProduct->product_tax_value, 'tax_method' => $row
                    ->product
                    ->purchase_product_offer
                    ->offerProduct->tax_method, 'cess' => 0, 'height' => $row
                    ->product
                    ->purchase_product_offer
                    ->offerProduct->height, 'width' => $row
                    ->product
                    ->purchase_product_offer
                    ->offerProduct->width, 'length' => $row
                    ->product
                    ->purchase_product_offer
                    ->offerProduct->length, 'weight' => $row
                    ->product
                    ->purchase_product_offer
                    ->offerProduct->weight, 'total' => $row_total, 'qty' => $offerered_qty, 'offerDescription' => $row
                    ->product
                    ->purchase_product_offer
                    ->sceheme->title, 'is_aff' => Null, 'aff_id' => Null, 'aff_amount' => Null, 'special_charges_label' => Null, 'special_charges' => Null, 'referral_id' => Null];
                array_push($package_details, ["name" => $row
                    ->product
                    ->purchase_product_offer
                    ->offerProduct->title, "total" => $offerered_qty * $row
                    ->product
                    ->purchase_product_offer
                    ->offerProduct->selling_price, "qty" => $offerered_qty, "sku" => $row
                    ->product
                    ->purchase_product_offer
                    ->offerProduct->sku, "hsn" => $row
                    ->product
                    ->purchase_product_offer
                    ->offerProduct->hsn_code]);
                array_push($shipRocketPrArray, ["name" => $row
                    ->product
                    ->purchase_product_offer
                    ->offerProduct->title, "sku" => $row
                    ->product
                    ->purchase_product_offer
                    ->offerProduct->sku, "units" => $offerered_qty, "selling_price" => $row->qty * $row
                    ->product
                    ->purchase_product_offer
                    ->offerProduct->selling_price, "discount" => 0, "tax" => $row
                    ->product
                    ->purchase_product_offer
                    ->offerProduct->product_tax_value * $offerered_qty, "hsn" => $row
                    ->product
                    ->purchase_product_offer
                    ->offerProduct->hsn_code]);
                $totalQty += $offerered_qty;
                $totalWeight += $row
                    ->product
                    ->purchase_product_offer
                    ->offerProduct->weight;
                $totalHeight += $row
                    ->product
                    ->purchase_product_offer
                    ->offerProduct->height;
                array_push($totalLengthArray, $row
                    ->product
                    ->purchase_product_offer
                    ->offerProduct
                    ->length);
                array_push($totalWidthArray, $row
                    ->product
                    ->purchase_product_offer
                    ->offerProduct
                    ->width);
                /**********************free product***************/

            }
            /****************************************/

        }
        if(isset($_COOKIE['aff_id'])){
            Affiliate::where('code', $aff_id)->update(['commission' => $aff_remaining_amount]);
            AccountCreditAffiliation::where('account_id', $account->id)->update(['amount' => $comp_remaining_amount ]);
            AffiliatePaymentHistory::insert($aff_insert_array);
            if($aff_release_payment!=0){
                $aff_deatil = Affiliate::where('code', $aff_id)->first();
                if($aff_deatil->razorpay_account_id!=Null){
                        $ref_pay_array = [
                                            "account_number" => "4564563058857171",
                                            "fund_account_id" => $aff_deatil->razorpay_account_id,
                                            "amount" => ($aff_release_payment*100),
                                            "currency" => "INR",
                                            "mode" => "IMPS",
                                            "purpose" => "payout",
                                            "queue_if_low_balance" => true,
                                            "reference_id" => $order_id,
                                            "narration" => $order_id.' AFF Payment'
                                        ];
                        
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL,"https://api.razorpay.com/v1/payouts");
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_USERPWD, env('RAZORPAY_X_KEY').':'.env('RAZORPAY_X_SECRET'));
                        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($ref_pay_array));
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $server_output = curl_exec($ch);
                        
                        //var_dump($server_output);exit;
                        curl_close ($ch);
                    }
            }
        }

        $coupon = Null;
		$discount_coupon_amount = 0;
		if(isset($request->coupon_code)){
			$coupon_return = $this->applyCouponBackEnd($total,$request->coupon_code);
			if($coupon_return['error']==false){
				//$total = $total - $coupon_return['discount'];
				$coupon = $request->coupon_code;
				$discount_coupon_amount = $coupon_return['discount'];
			}
		}
        $productData = ["package_weight" => $totalWeight, "package_length" => max($totalLengthArray) , "package_width" => max($totalWidthArray) , "package_height" => $totalHeight, "total" => $total-$discount_coupon_amount, "total_qty" => $totalQty, "package_details" => $package_details, ];

        $shipyaariPayLoad = ["username" => base64_encode($account->shipyaariUserName) , "insurance" => base64_encode('no') , "order_id" => base64_encode($order_id) , "from_contact_number" => base64_encode($account->phone) , "from_pincode" => base64_encode($account->pinCode) , "from_landmark" => base64_encode($account->landmark) , "from_address" => base64_encode($account->address) , "from_address2" => base64_encode('') , "to_pincode" => base64_encode($address->zipCode) , "to_landmark" => base64_encode($address->landmark) , "to_address" => base64_encode($address->address) , "to_address2" => base64_encode('') , "customer_name" => base64_encode($address->name) , "customer_email" => base64_encode($address->email) , "customer_contact_no" => base64_encode($address->phone) , "ship_date" => base64_encode(date('Y-m-d')) , "package_type" => base64_encode("identical") , "total_invoice_value" => base64_encode($total-$discount_coupon_amount) , "created_by" => base64_encode($account->shipyaariClientCode) , "avnkey" => base64_encode($account->shipyaariClientCode . "@" . $account->shipyaariParentCode) , "payment_mode" => base64_encode(($request->transactionType == 1 ? 'COD' : 'Online')) , "no_of_packages" => base64_encode(1) , "total_price_set" => $total, "channel" => "API", "product_data" => [$productData]];
        $shipRocketPayLoad = array(
            'order_id' => $order_id,
            'order_date' => date('Y-m-d H:i:s') ,
            'pickup_location' => $account->shiprocketPickupLocation,
            'billing_customer_name' => $address->name,
            'billing_last_name' => $address->name,
            'billing_address' => $address->address,
            'billing_address_2' => $address->landmark,
            'billing_city' => $address->cityId,
            'billing_pincode' => $address->zipCode,
            'billing_state' => $address->stateId,
            'billing_country' => 'India',
            'billing_email' => $address->email,
            'billing_phone' => $address->phone,
            'shipping_is_billing' => true,
            'shipping_customer_name' => '',
            'shipping_last_name' => '',
            'shipping_address' => '',
            'shipping_address_2' => '',
            'shipping_city' => '',
            'shipping_pincode' => '',
            'shipping_country' => '',
            'shipping_state' => '',
            'shipping_email' => '',
            'shipping_phone' => '',
            'order_items' => $shipRocketPrArray,
            'payment_method' => ($request->transactionType == 1 ? "COD" : "Prepaid") ,
            'shipping_charges' => 0,
            'giftwrap_charges' => 0,
            'transaction_charges' => 0,
            'total_discount' => $discount_coupon_amount,
            'sub_total' => $total,
            'length' => max($totalLengthArray) ,
            'breadth' => max($totalWidthArray) ,
            'height' => $totalHeight,
            'weight' => $totalWeight,
        );
        /***********************************************/
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://seller.shipyaari.com/logistic/webservice/SearchAvailability_new.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'pickup_pincode=' . $account->pinCode . '&delivery_pincode=' . $address->zipCode . '&weight=' . $totalWeight . '&paymentmode=' . ($request->transactionType == 1 ? 'COD' : 'Online') . '&invoicevalue=' . ($total-$discount_coupon_amount) . '&avnkey=' . $account->shipyaariClientCode . "@" . $account->shipyaariParentCode . '&service_type=normal&service=Standard&length=' . max($totalLengthArray) . '&width=' . max($totalWidthArray) . '&height=' . $totalHeight . '&weight=' . $totalWeight,
        ));
        $shipyaariAvailability = curl_exec($curl);
        curl_close($curl);
        $shipRocketAvailability = '';
        if ($account->shiprocketStatus == 1)
        {
            $shiprocketAvailabilityPayLoad = 'pickup_postcode=' . $account->pinCode . '&delivery_postcode=' . $address->zipCode . '&weight=' . $totalWeight . '&length=' . max($totalLengthArray) . '&breadth=' . max($totalWidthArray) . '&height=' . $totalHeight . '&declared_value=' . ($total-$discount_coupon_amount) . '&cod=' . ($request->transactionType == '1' ? 1 : 0);
            $ship_rocket_token = $this->shipRocketToken($account_id);
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/courier/serviceability/?' . $shiprocketAvailabilityPayLoad,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $ship_rocket_token
                ) ,
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $shipRocketAvailability = $response;
        }
        /***********************************************/
        if (isset($request->pay_with_wallet))
        {
            $payamount = ($total-$discount_coupon_amount - $xcoupondiscount);
            $walletamount = ($this->FinalAmount($registerId));
            if ($payamount <= $walletamount)
            {
                # debit full amount in wallet
                $productData = json_encode($productData);
                $amount = ($this->FinalAmount($registerId) - $payamount);
                //$wallet_amount = DB::table('wallets')->insert(['transaction_id' => '', 'account_id' => $registerId, 'debit' => $payamount, 'amount' => $amount, 'status' => '0', 'order_id' => $order_id, 'description' => $productData]);
                $order_status = 1;
                $payble_amount = 0;
                $return = redirect('orderList');

                $payble_amount = 0;
                $do_to_wallet = $payamount;
            }
            else
            {
                $payble_amount = $payamount - $walletamount;
                # debit benifit amount in wallet
                $productData = json_encode($productData);
                $amount = ($this->FinalAmount($registerId) - $walletamount);
                //$wallet_amount = DB::table('wallets')->insert(['transaction_id' => '', 'account_id' => $registerId, 'debit' => $walletamount, 'amount' => $amount, 'status' => '0', 'order_id' => $order_id, 'description' => $productData]);
                $do_to_wallet = $walletamount;
                $shipRocketPayLoad['sub_total'] = $total-$do_to_wallet;
            }
            
        }
        else
        {
            $payble_amount = 0;
            $do_to_wallet = 0;
            // $payble_amount <= 0 ? $grandTotal*100 - $xcoupondiscount : $payble_amount;
            //$payble_amount <= 0 ? $total - $couponDiscountAmt - $xcoupondiscount : $payble_amount;
            
        }
        /********************************************** */
        if (isset($_COOKIE['aff_id']))
        {
            $aff_id = $_COOKIE['aff_id'];
            
        }
        else
        {
            $aff_id = Null;
        }
        if ($request->transactionType == 1)
        {
            
            $return = redirect('orders');
            $order_status = 0;
        }
        else if ($request->transactionType == 2)
        {

            $order_status = 1;
            $api = new Api($account->razorPayApiKey, $account->razorPayApiSecret);
            $couponDiscountAmt = 0;
            $grandTotal = $total-$discount_coupon_amount;
            $order = $api
                ->order
                ->create(['receipt' => $address->name, 'amount' => $payble_amount <= 0 ? $grandTotal * 100 - $xcoupondiscount : $payble_amount*100, 'currency' => 'INR', ]);

            $razorpay_order_id = $order->id;

            Session::put('razorpay_order_id', $order->id);
            Session::put('account_order_id', $order_id);
            $account = Session::get('currentAccount');
            $user_data = ['name' => $address->name, 'contact' => $address->phone, 'email' => $address->email];
            $viewPath = 'theams/theam' . $account->theme . '/razorpayView';
            $return = view($viewPath)->with('account', $account)->with('razorpay_order_id', $razorpay_order_id)->with('user_data', $user_data);
        }
        else if ($request->transactionType == 3)
        {
            $order_status = 1;
            $ApiKey = $account->instamojoApiKey;
            $AuthToken = $account->instamojoAuthToken;
            //$url = 'https://test.instamojo.com/api/1.1/';
            $url = 'https://www.instamojo.com/api/1.1/';
            $api = new \Instamojo\Instamojo($ApiKey, $AuthToken, $url);
            $couponDiscountAmt = 0;
            $grandTotal = $payble_amount <= 0 ? $total - $couponDiscountAmt-$discount_coupon_amount - $xcoupondiscount : $payble_amount;
            $customURL = url('instamojo_handler');
            $response = $api->paymentRequestCreate(array(
                "purpose" => "Payment to $account->domain",
                "amount" => $grandTotal,
                "buyer_name" => $address->name,
                "send_email" => true,
                "email" => $address->email,
                "phone" => $address->phone,
                "redirect_url" => $customURL,
            ));
            Session::put('account_order_id', $order_id);
            $return = Redirect::to($response['longurl']);
        }

        
		
        AdvanceProductOrder::insert(['account_id' => $account->id, 'register_id' => $registerId, 'order_id' => $order_id, 'transactionType' => $request->transactionType, 'transactionId' => $request->razorpay_payment_id, 'status' => $order_status, 'name' => $address->name, 'phone' => $address->phone, 'email' => $address->email, 'landmark' => $address->landmark, 'address' => $address->address, 'zipCode' => $address->zipCode, 'cityId' => $address->cityId, 'stateId' => $address->stateId, 'grand_total' => $total, 'shipyaariPayLoad' => json_encode($shipyaariPayLoad) , 'shipRocketPayLoad' => json_encode($shipRocketPayLoad) , 'shipyaariAvailability' => $shipyaariAvailability, 'shipRocketAvailability' => $shipRocketAvailability,
        
        // 'is_aff' => ( $is_aff ? 1 : 0 ),
        'aff_id' => $aff_id,
        'wallet_tr_details'=>(count($wallet_tr_details) ? json_encode($wallet_tr_details): Null),
        'aff_amount' => $total_aff_amount, 'coupon' => $coupon , 'discount_coupon_amount' => $discount_coupon_amount, 'do_to_wallet' => $do_to_wallet
        ,'delhiVeryPayload'=>json_encode($delhiVeryPayload)
    ]);

        if ($request->transactionType == 1){
            $this->distibuteWalletAmout($order_id);
        }
        AdvanceProductOrderDetail::insert($array);
        AdvanceProductCart::where('register_id', Session::getId())->delete();
        if ($request->transactionType == 1)
        {
            $this->confirmOrderNotification($order_id);
            
        }

        #refree_benifit
        if (isset($refree_benifit))
        {
            echo "one";
            $register = Session::get('register');
            $registerId = $register->id;
            $date = date('Y/m/d h:i:s A');
            $amount = ($this->FinalAmount($SaleXfor->send_to) + $refree_benifit);
            //$wallet_amount = DB::table('wallets')->insert(['transaction_id' => '', 'account_id' => $SaleXfor->send_to, 'credit' => $refree_benifit, 'amount' => $amount, 'status' => '0']);
            //Coupon::where('id', $SaleXfor->id)->update(['status' => 0, 'uesttime' => $date, 'product_id' => $request->product_id, 'product_sale_price' => '', 'used_to' => $registerId]);
        }
        else
        {
            //echo "two";
            
        }
        //echo 'Ordered';
        return $return;
    }
	public function order_r_process(Request $request,$inputData=''){
		if (isset($request->error)){
			return Redirect('checkout')->withErrors([$request->error['description'].' , Please try again.']);
		}else{
            
			$account = Session::get('currentAccount');
			
			$sign = hash_hmac('SHA256',Session::get('razorpay_order_id').'|'.$request->razorpay_payment_id,$account->razorPayApiSecret);
			
			
			if(hash_equals($sign,$request->razorpay_signature)){
				
				$account = Session::get('currentAccount');
				AdvanceProductOrder::where('account_id',$account->id)
				                     ->where('order_id',Session::get('account_order_id'))
				                     ->update([
									   'transactionId' => $request->razorpay_payment_id,
									   'status' => 0
									   ]);
                $this->releaseAffPaymentAfterTransactionComplete(Session::get('account_order_id'));
                $this->distibuteWalletAmout(Session::get('account_order_id'));
				$this->confirmOrderNotification(Session::get('account_order_id'));
				Session::put('razorpay_order_id','');
				Session::put('account_order_id','');
				return redirect('orders');
			}
		}
		
	}
    public function confirmOrderNotification($order_id=''){
		//$order_id = '1629040049';
		$account = Session::get('currentAccount');
		$account_id = $account->id;
		$data = AdvanceProductOrder::where('account_id',$account->id)
		        ->where('order_id', $order_id)
				->first();
		$order_type = 'Prepaid';
		if($data->transactionType=='1'){
			$order_type = 'COD';
		}
		    $found = Msgnotify::where('account_id', $account_id)->where('msg_type', '1')->first();
			if($found){
				$message = $found->messages;
				$message = str_replace('[CUSTOMER_NAME]',$data->name,$message);
				$message = str_replace('[ORDER_NO]',$data->order_id,$message);
				$message = str_replace('[Order_Number]',$data->order_id,$message);
				$message = str_replace('[Order_Amount]',$data->grand_total,$message);
				$message = str_replace('[Order Type]',$order_type,$message);
				$message = str_replace('[GRAND_TOTAL]',$data->grand_total,$message);
				$message = str_replace('[Date_of_Order]',date('Y-m-d'),$message);
				$message = str_replace('[User_Mobile_Number]',$data->phone,$message);
				$message = urlencode($message);
				$replace = str_replace('setUsername', $account->SMSUserName, $account->SMSApi);
				$replace1 = str_replace('setPassword', $account->SMSUserPassword, $replace);
				$replace2 = str_replace('setSenderId', $account->SMSUserSenderId, $replace1);
				$replace3 = str_replace('setPhone', $data->phone, $replace2);
				$replace4 = str_replace('setMessage', $message, $replace3);
				$replace5 = str_replace('setTEMPLATEID', $found->template_id,$replace4);
				$url = $replace5;
				$post = curl_init();
				curl_setopt($post, CURLOPT_URL, $url);
				curl_setopt($post, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($post, CURLOPT_CUSTOMREQUEST, 'GET');
				$response = curl_exec($post);
				curl_close($post);
				$result = json_decode($response, true);
			}
			
			
			
			$found = Msgnotify::where('account_id', $account_id)->where('msg_type', '8')->first();
			if($found){
				$message = $found->messages;
				$message = str_replace('[CUSTOMER_NAME]',$data->name,$message);
				$message = str_replace('[ORDER_NO]',$data->order_id,$message);
				$message = str_replace('[Order_Number]',$data->order_id,$message);
				$message = str_replace('[Order_Amount]',$data->grand_total,$message);
				$message = str_replace('[GRAND_TOTAL]',$data->grand_total,$message);
				$message = str_replace('[Order Type]',$order_type,$message);
				$message = str_replace('[Date_of_Order]',date('Y-m-d'),$message);
				$message = str_replace('[User_Mobile_Number]',$data->phone,$message);
				$message = str_replace('[Product_Name]',$data->products[0]->title,$message);
				$message = urlencode($message);
				$replace = str_replace('setUsername', $account->SMSUserName, $account->SMSApi);
				$replace1 = str_replace('setPassword', $account->SMSUserPassword, $replace);
				$replace2 = str_replace('setSenderId', $account->SMSUserSenderId, $replace1);
				$replace3 = str_replace('setPhone', $account->phone, $replace2);
				$replace4 = str_replace('setMessage', $message, $replace3);
				$replace5 = str_replace('setTEMPLATEID', $found->template_id,$replace4);
				$url = $replace5;
				$post = curl_init();
				curl_setopt($post, CURLOPT_URL, $url);
				curl_setopt($post, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($post, CURLOPT_CUSTOMREQUEST, 'GET');
				$response = curl_exec($post);
				curl_close($post);
				$result = json_decode($response, true);
			}
			
			$email = 'webzaun@gmail.com';
			$email = $data->email;
			$logo = $account->domain.'/'.$account->logo;
            $email_data = ['data'=>['orderData'=>$data, 'account' => $account, 'logo' => $logo]];
            $resipent_data = ['to'=>$email,'subject'=>'Confirm Order Email :'.$order_id,'title'=>$account->title,'domain'=>$account->domain];
			Mail::send('emails.confirmOrder', $email_data, function($message) use($resipent_data){
                $message->to($resipent_data['to'])->subject
                    ($resipent_data['subject']);
                $message->from('noreply@'.$resipent_data['domain'],$resipent_data['title']);
            });
            $resipent_data = ['to'=>$email,'subject'=>'Confirm Order Email :'.$order_id,'title'=>$account->title,'domain'=>$account->domain];
            Mail::send('emails.confirmOrder', $email_data, function($message) use($resipent_data){
                $message->to($resipent_data['to'])->subject
                    ($resipent_data['subject']);
                $message->from('noreply@'.$resipent_data['domain'],$resipent_data['title']);
            });
			
	}
    public function test_email(){
        $order_id = '1671561018';
		$account = Session::get('currentAccount');
		$account_id = $account->id;
		$data = AdvanceProductOrder::where('account_id',$account->id)
		        ->where('order_id', $order_id)
				->first();
		$order_type = 'Prepaid';
		if($data->transactionType=='1'){
			$order_type = 'COD';
		}
        $logo = $account->domain.'/'.$account->logo;
        $email = 'webzaun@gmail.com';
        $email_data = ['data'=>['orderData'=>$data, 'account' => $account, 'logo' => $logo]];
        $resipent_data = ['to'=>$email,'subject'=>'Confirm Order Email :'.$order_id];
        Mail::send('emails.confirmOrder', $email_data, function($message) use($resipent_data){
            $message->to($resipent_data['to'])->subject
                ($resipent_data['subject']);
            $message->from('noreply@streamlinepharma.ltd','Streamlinepharma');
        });
        //Mail::to($email)->send(new ConfirmOrderMail(['orderData'=>$data, 'account' => $account, 'logo' => $logo]));
    }
    public function login()
    {
        $viewPath = $this->theme_prefix . '.login';
        $return = view($viewPath);
        return $return;
    }
    public function login_check(Request $request)
    {
        $domainName = $this->activeDomain();
        $account = Account::where('domain', $domainName)->with(['currency'])
            ->first();
        $account_id = $account->id;
        $check = Register::where('account_id', $account_id)->where(function ($query) use ($request)
        {
            $query->where('email', $request->email)
                ->orWhere('phone', $request->email);
        })
            ->first();
        if ($check)
        {
            if (Hash::check($request->password, $check->password))
            {
				AdvanceProductCart::where('register_id',Session::getId())
					                    ->update(['register_user_id'=>$check->id]);
                Session::put('isLoggedIn', true);
                Session::put('register', $check);
                Register::where('id',$check->id)->update(['last_login_at'=>date('Y-m-d H:i:s')]);
                $return = array(
                    'error' => false,
                    'message' => 'Logged in.'
                );
            }
            else
            {
                $return = array(
                    'error' => true,
                    'message' => 'password is incorect.'
                );
            }
        }
        else
        {
            $return = array(
                'error' => true,
                'message' => 'mobile or email is invalid'
            );
        }
        return $return;
    }
    public function initiateSignUP(Request $request)
    {
        $domainName = $this->activeDomain();
        $account = Account::where('domain', $domainName)->with(['currency'])
            ->first();
        $account_id = $account->id;
        $check = Register::where('account_id', $account_id)->where(function ($query) use ($request)
        {
            $query->where('email', $request->email)
                ->orWhere('phone', $request->phone);
        })
            ->first();
        if ($check)
        {
            $return = array(
                'error' => true,
                'message' => 'accoutn with same mobile or email is already exist.<br>'
            );
        }
        else
        {
            if (is_numeric($request->phone) != 1 || strlen($request->phone) != 10)
            {
                $return = array(
                    'error' => true,
                    'message' => 'please enter valid mobile.<br>'
                );
            }
            else
            {
                if (isset($request->otp) && Session::get('otp'))
                {
                    if ($request->otp == Session::get('otp'))
                    {
                        $register = Register::create(['account_id' => $account_id, 'name' => $request->name, 'email' => $request->email, 'phone' => $request->phone, 'password' => bcrypt($request->password) , ]);
						
						AdvanceProductCart::where('register_id',Session::getId())
					                    ->update(['register_user_id'=>$register->id]);
                        Register::where('id',$register->id)->update(['last_login_at'=>date('Y-m-d H:i:s')]);
                        Session::put('isLoggedIn', true);
                        Session::put('register', $register);
                        $return = array(
                            'error' => false,
                            'is_logged' => true,
                            'message' => 'please enter valid otp.<br>'
                        );
                    }
                    else
                    {
                        $return = array(
                            'error' => true,
                            'message' => 'please enter valid otp.<br>'
                        );
                    }
                }
                else
                {
                    $otp = $this->genrateOTP();
                    Session::put('otp', $otp);
                    $return = array(
                        'error' => false,
                        'is_logged' => false,
                        'message' => 'OTP sent on mobile, please verify to login..<br>'
                    );
                }
            }
        }
        return $return;
    }

    public function sign_up_process(Request $request)
    {

    }
    public function save_address(Request $request)
    {
        $register = Session::get('register');
		if(isset($request->address_id)){
			 $data = RegisterAddress::where(DB::Raw("md5(id)"),$request->address_id)
		           ->where('register_id', Session::get('register')->id)->first();
			 $id = $data->id;
			 RegisterAddress::where(DB::Raw("md5(id)"),$request->address_id)
		           ->where('register_id', Session::get('register')->id)
				   ->update([ 
				   'name' => $request->name, 
				   'phone' => $request->mobile, 
				   'email' => $request->email, 
				   'landmark' => $request->landmark, 
				   'address' => $request->address, 
				   'cityId' => $request->city, 
				   'stateId' => $request->state, 
				   'countryId' => $request->country, 
				   'zipCode' => $request->zip, 
				   ]);
		}else{
			$id = RegisterAddress::insertGetId([
		           'register_id' => $register->id, 
				   'name' => $request->name, 
				   'phone' => $request->mobile, 
				   'email' => $request->email, 
				   'landmark' => $request->landmark, 
				   'address' => $request->address, 
				   'cityId' => $request->city, 
				   'stateId' => $request->state, 
				   'countryId' => $request->country, 
				   'zipCode' => $request->zip, 
				   ]);
		}
        
        Session::put('selected_address', $id);
        return Redirect::back()->with('status', 'Updated Successfully.');
    }

    public function dashboard()
    {
        if (Session::get('register'))
        {
            $domainName = $this->activeDomain();
            $account = Account::where('domain', $domainName)->with(['currency'])
                ->first();
            $privacyList = Privacy::where('account_id', $account->id)
                ->first();
            $viewPath = $this->theme_prefix . '.account.dashboard';
            $return = view($viewPath)->with('privacyList', $privacyList);
            return $return;
        }
        else
        {
            return redirect('login');
        }
    }
    public function orders()
    {
        if (Session::get('register'))
        {
            $domainName = $this->activeDomain();
            $account = Account::where('domain', $domainName)->with(['currency'])
                ->first();
            $orders = AdvanceProductOrder::where('register_id', Session::get('register')->id)
                ->orderBy('id', 'desc')
                ->get();
            $viewPath = $this->theme_prefix . '.account.orders';
            $return = view($viewPath)->with('orders', $orders);
            return $return;
        }
        else
        {
            return redirect('login');
        }
    }

    public function myAddress()
    {
        if (Session::get('register'))
        {
            $domainName = $this->activeDomain();
            $account = Account::where('domain', $domainName)->with(['currency'])
                ->first();
            $address = RegisterAddress::where('register_id', Session::get('register')->id)
                ->whereNotNull('name')
                ->where('name', '!=', '')
                ->orderBy('id', 'desc')
                ->get();
            $viewPath = $this->theme_prefix . '.account.address';
            $return = view($viewPath)->with('address', $address);
            return $return;
        }
        else
        {
            return redirect('login');
        }
    }
    public function accountDetail()
    {
        if (Session::get('register'))
        {
            $domainName = $this->activeDomain();
            $account = Account::where('domain', $domainName)->with(['currency'])
                ->first();
            $viewPath = $this->theme_prefix . '.account.account';
            $return = view($viewPath);
            return $return;
        }
        else
        {
            return redirect('login');
        }
    }
    public function logout()
    {
        Session::forget('register');
        return redirect('/');
    }
    /*public function shop(){
      $domainName = $this->activeDomain();
    $account = Account::where('domain', $domainName)->with(['currency'])->first();
    $viewPath = $this->theme_prefix.'.shop';
    $return   = view($viewPath);
    return $return;
    }*/

    public function shop($id = '', $sub_id = '', $template_id = '', Request $request)
    {   
	    //echo $id.'/'.$sub_id.'/'.$template_id;exit;
        $domainName = $this->activeDomain();
        $account = Account::where('domain', $domainName)->with(['currency'])
            ->first();
        $account_id = $account->id;
        $advance_product = AdvanceProduct::select("advance_product_category.banner")
		    ->where('advance_product.account_id', $account_id)
		    ->where('advance_product.status', 'Active')
            ->whereIn('advance_product.setting_id',explode(',', $account->subscribedTemplate))->leftJoin('advance_product_category', function ($join) use ($account_id)
			{
				$join->on('advance_product_category.setting_id', '=', 'advance_product.setting_id')
					->where('advance_product_category.account_id', $account_id);
			})
			->where('advance_product.setting_id',$template_id)
			->first();
        $all_color = $this->all_color();
        $brand = Brand::where('account_id', $account_id)->get();
        $viewPath = $this->theme_prefix . '.shop';

        $pricing = AdvanceProduct::select(DB::Raw('min(uc_advance_product.selling_price) as min_price') , DB::Raw('max(uc_advance_product.selling_price) as max_price') , DB::Raw("group_concat(uc_advance_product.color) as color"))
		    //->where('advance_product.status', 'Active')
            ->where('advance_product.account_id', $account_id)
			->whereIn('advance_product.setting_id', explode(',', $account->subscribedTemplate));
			/*->leftJoin('advance_product_category', function ($join) use ($account_id)
        {
            $join->on('advance_product_category.setting_id', '=', 'advance_product.setting_id')
                ->where('advance_product_category.account_id', $account_id);
        });*/
        if ($id != ''&&$id != '0')
        {
            $pricing = $pricing->where('advance_product.category', $id);
        }
        if ($sub_id != ''&& $sub_id != '0')
        {
            $pricing = $pricing->where('advance_product.sub_category', $sub_id);
        }
        $return = view($viewPath, compact('account', 'brand', 'id', 'sub_id', 'template_id'));
        if ($template_id != ''&& $template_id!= '0')
        {
            //$pricing = $pricing->where('advance_product.setting_id',$template_id);
            $AdvanceProductSetting = AdvanceProductSetting::where('id', $template_id)->first();
            $return = $return->with('setting', $AdvanceProductSetting);
        }
        $pricing = $pricing->first();
        $all_color = array_unique(explode(',', $pricing->color));

        $new_product = AdvanceProduct::select('sku', 'thumbnail', 'title', 'product_price', 'selling_price', DB::Raw("TRUNCATE((product_price - selling_price ) / selling_price * 100,2) AS discount"))->where('status', 'Active')
            ->where('account_id', $account_id)->where('qc', 1)
            ->limit(3)
            ->orderBy('id', 'desc')
            ->get();

        $return = $return->with('pricing', $pricing)->with('all_color', $all_color)->with('new_product', $new_product)->with('advance_product_banner', $advance_product);
        return $return;
    }

    public function filterProduct(Request $request)
    {
        $domainName = $this->activeDomain();
        $account = Account::where('domain', $domainName)->with(['currency'])
            ->first();
        $account_id = $account->id;
        $advance_product = AdvanceProduct::select('sku', 'thumbnail', 'title', 'product_price', 'selling_price', DB::Raw("TRUNCATE((product_price - selling_price ) / selling_price * 100,2) AS discount"))->leftJoin('advance_product_category', function ($join) use ($account_id)
        {
            $join->on('advance_product_category.setting_id', '=', 'advance_product.setting_id')
                ->where('advance_product_category.account_id', $account_id);
        })->where('advance_product.qc', 1)
            ->where('advance_product.account_id', $account_id)->where('advance_product.status', 'Active')
            ->whereIn('advance_product.setting_id', explode(',', $account->subscribedTemplate));
        if (isset($request->id) && $request->id != ''&& $request->id != '0')
        {
            $advance_product = $advance_product->where('advance_product.category', $request->id);
        }
        if (isset($request->search_key) && $request->search_key != '')
        {
            $advance_product = $advance_product->where(function ($query) use ($request)
            {
                $query->where('search_key_words', 'like', '%' . $request->search_key . '%')
                    ->orWhere('title', 'like', '%' . $request->search_key . '%');
            });
        }
        if (isset($request->sub_id) && $request->sub_id != ''&& $request->sub_id != '0')
        {
            $advance_product = $advance_product->where('advance_product.sub_category', $request->sub_id);
        }
        if (isset($request->template_id) && $request->template_id != '' && $request->template_id != '0')
        {
            $advance_product = $advance_product->where('advance_product.setting_id', $request->template_id);
        }
        if (isset($request->minmumAmt))
        {
            $advance_product = $advance_product->where('advance_product.selling_price', '>=', $request->minmumAmt);
        }
        if (isset($request->maximumAmt))
        {
            $advance_product = $advance_product->where('advance_product.selling_price', '<=', $request->maximumAmt);
        }
        if (isset($request->brand))
        {
            $advance_product = $advance_product->whereIn('advance_product.brand', $request->brand);
        }
        if (isset($request->color))
        {
            $advance_product = $advance_product->whereIn('advance_product.color', $request->color);
        }

        if (isset($request->multi_add_filter))
        {
            $tmp_id = AdvanceProductAttribute::select(DB::Raw("group_concat(advance_product_id) as advance_product_id"));
            //var_dump($request->multi_add_filter);exit;
            foreach ($request->multi_add_filter as $key => $row)
            {
                $tmp_id = $tmp_id->whereRaw(DB::Raw("value REGEXP CONCAT('(^|,)(', REPLACE('" . implode(',', $row) . "', ',', '|'), ')(,|$)')"));
                $tmp_id = $tmp_id->where('attribute', $key);
            }

            $tmp_id = $tmp_id->first();
            if ($tmp_id)
            {
                $advance_product = $advance_product->whereIn('advance_product.id', explode(',', $tmp_id->advance_product_id));
            }

        }

        if (isset($request->single_add_filter) && count($request->single_add_filter))
        {
            $tmp_id = AdvanceProductAttribute::select(DB::Raw("group_concat(advance_product_id) as advance_product_id"));
            //var_dump($request->multi_add_filter);exit;
            foreach ($request->single_add_filter as $key => $row)
            {
                $tmp_id = $tmp_id->where('value', $row);
                $tmp_id = $tmp_id->where('attribute', $key);
            }

            $tmp_id = $tmp_id->first();
            if ($tmp_id)
            {
                //$advance_product = $advance_product->whereIn('advance_product.id',explode(',',$tmp_id->advance_product_id));
                
            }

        }

        if (isset($request->sortby))
        {
            $advance_product = $advance_product->orderBy('advance_product.selling_price', $request->sortby);
        }
        $advance_product = $advance_product->get();
        return $advance_product;
    }
    public function contact()
    {
        $domainName = $this->activeDomain();
        $account = Account::where('domain', $domainName)->with(['currency'])
            ->first();
        $viewPath = $this->theme_prefix . '.pages.contact';
        $return = view($viewPath);
        return $return;
    }
    public function userOrderCancel($id)
    {
        $domainName = $this->activeDomain();
        $account = Account::where('domain', $domainName)->with(['currency'])
            ->first();
        $refund_transaction_id = time();
        $data = AdvanceProductOrder::where('account_id', $account->id)
            ->where('order_id', $id)->first();
		if($data->aff_amount!=0){
			$pre_aff = Affiliate::where('code', $data->aff_id)->first();
			$preAmount = AccountCreditAffiliation::where('account_id', $account->id)
                    ->first();
			AccountCreditAffiliation::where('account_id', $account->id)
                    ->update(['amount' => ($preAmount->amount + $data->aff_amount) ]);
			Affiliate::where('code', $data->aff_id)->update(['commission' => ($pre_aff->commission-$data->aff_amount) ]);
			AffiliatePaymentHistory::where('reference_id',$id)
			                         ->where('account_id', $account->id)
									 ->update(['status'=>2]);
		}
        if ($data->transactionType == 3 && $data->status == 0)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/refunds/');
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "X-Api-Key:" . $account->instamojoApiKey,
                "X-Auth-Token:" . $account->instamojoAuthToken
            ));
            $payload = Array(
                'transaction_id' => $refund_transaction_id,
                'payment_id' => $data->transactionId,
                'type' => 'TAN',
                'body' => 'Event was canceled/changed',
                'refund_amount' => $data->grand_total
            );
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
            $response = curl_exec($ch);
            curl_close($ch);
            AdvanceProductOrder::where('account_id', $account->id)
                ->where('order_id', $id)->update(['refund_status' => 1, 'refund_transaction_id' => $refund_transaction_id, 'status' => 6, 'refund_responce' => $response]);
        }
        else
        {
			$update = ['refund_status' => 1, 'status' => 6];
			if($data->transactionType==2){
				$api = new Api($account->razorPayApiKey, $account->razorPayApiSecret);
				$order = $api->payment->fetch($data->transactionId)->refund([
				               "amount"=> ($data->grand_total*100), 
							   "speed"=>"normal", 
							   "notes"=>[
							              "notes_key_1"=>"Refund of Order ".$data->order_id,
										  "notes_key_2"=>""
										], 
								"receipt"=>time()
								]);
				$update['refund_status'] = 1;
				$update['refund_transaction_id'] = $order->payment_id;
				$update['refund_responce'] = json_encode($order);

			}
            AdvanceProductOrder::where('account_id', $account->id)
                ->where('order_id', $id)->update($update);
        }
        //echo $response;
        return Redirect('orders');
    }
    public function forogotPassword()
    {
        $viewPath = $this->theme_prefix . '.forogot-password';
        $return = view($viewPath);
        return $return;
    }
    public function forgot_password_otp_genrate(Request $request)
    {
        $domainName = $this->activeDomain();
        $account = Account::where('domain', $domainName)->with(['currency'])
            ->first();
        $account_id = $account->id;
        $register = Register::where('account_id', $account->id)->where(function ($query) use ($request)
        {
            $query->where('email', $request->email)
                ->orWhere('phone', $request->email);
        })
            ->where('status', 1)
            ->first();
        if ($register)
        {
            $found = Msgnotify::where('account_id', $account_id)->where('msg_type', 6)
                ->first();
            $OTP = rand(1000, 9999);
            //$OTP = 123456;
            Session::put('forgot_otp', $OTP);
            Session::put('forgot_mobile', $request->email);
            $sign_up_message = $found->messages;
            $sign_up_message = str_replace('[OTP]', $OTP, $sign_up_message);
            $message = urlencode($sign_up_message);
            Session::put('loginOtp', $OTP);

            $replace = str_replace('setUsername', $account->SMSUserName, $account->SMSApi);
            $replace1 = str_replace('setPassword', $account->SMSUserPassword, $replace);
            $replace2 = str_replace('setSenderId', $account->SMSUserSenderId, $replace1);
            $replace3 = str_replace('setPhone', $request->email, $replace2);
            $replace4 = str_replace('setMessage', $message, $replace3);
            $replace5 = str_replace('setTEMPLATEID', $found->template_id, $replace4);
            $url = $replace5;
            
            $post = curl_init();
            curl_setopt($post, CURLOPT_URL, $url);
            curl_setopt($post, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($post, CURLOPT_CUSTOMREQUEST, 'GET');
            $response = curl_exec($post);
            curl_close($post);
            $result = json_decode($response, true);
            $array = ['error' => false, 'message' => 'Otp sent to registered number.<br><br>'];
        }
        else
        {
            $array = ['error' => true, 'message' => 'Mobile or Email is invalid, Please check and try again<br><br>'];
        }
        return $array;
    }
    public function submitNewForgotPassoword(Request $request)
    {
        if (Session::get('forgot_otp') == $request->otp && Session::get('forgot_mobile') == $request->email)
        {
            if (strlen($request->new_password) >= 6)
            {
                $domainName = $this->activeDomain();
                $account = Account::where('domain', $domainName)->with(['currency'])
                    ->first();
                $account_id = $account->id;
                $register = Register::where('account_id', $account->id)->where(function ($query) use ($request)
                {
                    $query->where('email', $request->email)
                        ->orWhere('phone', $request->email);
                })
                    ->where('status', 1)
                    ->first();
                Register::where('id', $register->id)
                    ->update(['password' => Hash::make($request->new_password) ]);
                $array = ['error' => false, 'message' => 'Password CHanged.Please login with new password.'];
            }
            else
            {
                $array = ['error' => true, 'message' => 'Please enter new password atleast 6 digit.<br><br>'];
            }
        }
        else
        {
            $array = ['error' => true, 'message' => 'OPT entered is invalid, Please check and try again.<br><br>'];
        }
        return $array;
    }
	public function wallet()
    {
	  if (Session::get('register')){
        $domainName = $this->activeDomain();
            $account = Account::where('domain', $domainName)->with(['currency'])
                ->first();
        $viewPath = $this->theme_prefix . '.account.wallet';

        $account_id = $account->id;
        $register_id = Session::getId();

        $register = Session::get('register');
        $registerId = $register->id;
       
        $phone = null;
		//echo Session::get('register')->memebership_id;exit;
        $membership = Membership::where('id',Session::get('register')->memebership_id)->first();
        $amount=$this->FinalAmount($account_id);
        $wallet_amount=DB::table('wallets')->where('account_id',$registerId)->where('status','0')->get();
        $amount=$this->FinalAmount($registerId);
        return view($viewPath, compact('phone','membership','wallet_amount','amount'));
		}else{
            return redirect('login');
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
	public function set_delivery_location($pincode){
		Session::put('delivery_location',$pincode);
		return Redirect::back()
                ->with('status', 'Added Successfully.');
	}
	public function set_mannual_pincode(Request $request){
		Session::put('delivery_location',$request->pincode);
		return Redirect::back()
                ->with('status', 'Added Successfully.');
	}
	public function zipCodeCheck($id,$pincode)
    {   
        $price = 0;	
	    $servicable = false;
	    $message = "Not deliverable.";
	    $product = AdvanceProduct::where('id',$id)->first();
        $domainName = $this->activeDomain();
        $account = Account::where('domain', $domainName)->with(['currency'])
            ->first();
        $pickupPinCode = $account->pinCode;
		if($pincode!=''){
            $zipCode = $pincode;
		}else{
			$zipCode = Session::get('delivery_location');
		}
        if($account->delhivehryStatus==1){
            $curl = curl_init();
            curl_setopt_array($curl, [
              CURLOPT_URL => "https://track.delhivery.com/api/kinko/v1/invoice/charges/.json?md=E&cgm=".$product->weight."&o_pin=142026&d_pin=".$zipCode."&ss=RTO",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
              CURLOPT_HTTPHEADER => [
                "Authorization: Token 34a20527fc1f62f083fc8e192c6ab5b4dd33457d",
                "Content-Type: application/json",
                "accept: application/json"
              ],
            ]);
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if (!$err) {
              $data = json_decode($response,true);
              $servicable = true;
              $price = $data['0']['total_amount'];
                if($product->shipping_method=='Exclusive'){
                    $message = "₹$price shipping charges.";
                }else{
                    $message = "Free Shipping.";
                }
            }
            return array('servicable'=>$servicable,'price'=>$price,"message"=>$message);
        }
        if($account->shipyaariStatus==1){
			$paymentmode="cod";
			$invoicevalue=$product->selling_price;
			$avnkey = $account->shipyaariClientCode."@".$account->shipyaariParentCode;
			$insurance="no"; //yes
			$service_type="normal";
			$partner="";
			$service="economy"; //standard
			$request_url ='https://seller.shipyaari.com/logistic/webservice/SearchAvailability_new.php';

			$post_data="&pickup_pincode=".$pickupPinCode."&delivery_pincode=".$zipCode."&weight=".$product->weight."&paymentmode=".$paymentmode."&invoicevalue=".$invoicevalue."&avnkey=".$avnkey."&service_type=".$service_type."&partner=".$partner."&service=".$service."&length=".$product->length."&width=".$product->width."&height=".$product->height;
			$post = curl_init();
			curl_setopt($post, CURLOPT_URL, $request_url);
			curl_setopt($post, CURLOPT_POST,TRUE);
			curl_setopt($post, CURLOPT_POSTFIELDS, json_encode($post_data));
			curl_setopt($post, CURLOPT_RETURNTRANSFER, TRUE);
			$response = curl_exec($post);
			//print_r($response);
			curl_close($post);
			$result = json_decode($response, true);
			if($pincode!=''){
			  return $result;
			}else{ 
			  return response()->json($result, 200);
			}
		}
		if($account->shiprocketStatus==1){
			$shiprocketAvailabilityPayLoad = 'pickup_postcode=' . $account->pinCode . '&delivery_postcode=' . $zipCode . '&weight=' . $product->weight . '&length=' . $product->length . '&breadth=' . $product->width . '&height=' . $product->height . '&declared_value=' . $product->selling_price . '&cod=' . 1;
            $ship_rocket_token = $this->shipRocketToken($account->id);
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/courier/serviceability/?' . $shiprocketAvailabilityPayLoad,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $ship_rocket_token
                ) ,
            ));
            $response = json_decode(curl_exec($curl),true);
            curl_close($curl);
			
            if(array_key_exists("data",$response)&&$response['data']['available_courier_companies'][0]['rate']){
				$price = $response['data']['available_courier_companies'][0]['rate'];
				$servicable = true;
				if($product->shipping_method=='Exclusive'){
					$message = "₹$price shipping charges.";
				}else{
					$message = "Free Shipping.";
				}
			}
		}
		return array('servicable'=>$servicable,'price'=>$price,"message"=>$message);
    }
	public function cancel_payment(){
		return Redirect('checkout')->withErrors(['Payment Cancelled , Please try again.']);
	}
	public function invoice($orderNo)
    {
        $domainName = $this->activeDomain();
        $account = Account::where('domain', $domainName)->with(['currency'])
            ->first();
        $register = Session::get('register');
        $registerId = $register->id;
        $orderList = AdvanceProductOrder::where('order_id',$orderNo)
		->where('account_id',$account->id)
		->where('register_id',$registerId)
		->orderBy('id', 'desc')
		->first();
        
        //dd($orderList);
		$data = [
            'orderList' => $orderList,
            'account' => $account
        ];
          
        $pdf = PDF::loadView('admin/income/productOrder/orderPrint', $data);
    
        return $pdf->download('invoice-'.$orderList->order_id.'.pdf');
        
    }
	public function term()
    {
        $domainName = $this->activeDomain();
        $account = Account::where('domain', $domainName)->with(['currency'])->first();
        
        $termList = Term::where('account_id', $account->id)->first();
		$viewPath = $this->theme_prefix . '.pages.term';
        return view($viewPath, compact('termList'));
    }
	public function u_referral_scheme(){
        $domainName = $this->activeDomain();
        $account = Account::where('domain', $domainName)
	              ->with(['currency'])
				  ->first();      
        $register = Session::getId();
		$viewPath = $this->theme_prefix . '.u_referral_scheme';
		$membership = Membership::where('account_id',$account->id)
		                          ->whereNotNull('razorpay_subscription_id')
								  ->get();
		$data = MembershipPage::where('account_id',$account->id)->get();var_dump($data);exit;
		return view($viewPath)->with('account',$account)->with('membership',$membership)->with('m_data',$data);
	  
	}
	public function offer(){
		 $domainName = $this->activeDomain();
         $account = Account::where('domain', $domainName)
	              ->with(['currency'])
				  ->first();
		 $account_id = $account->id;
		 $register_id = Session::getId();
		 $deals = Purchaseoffer::
			         where('account_id',$account_id)
					 ->where('startDate','<=',date('Y-m-d H:i:s'))
		             ->where('endDate','>=',date('Y-m-d H:i:s'))->get();
		 
		 $viewPath = $this->theme_prefix . '.offer';
		 
		return view($viewPath)->with('deals',$deals)->with('offer_page_title',$account->offer_page_title)->with('account',$account);
	}
	public function rating_save(Request $request){
		  $domainName = $this->activeDomain();
          $account = Account::where('domain', $domainName)
	              ->with(['currency'])
				  ->first();
		  $advance_pridct = AdvanceProduct::where('id',$request->product_id)->first();
		  $account_id = $account->id;
		  $allowed = ['jpeg','jpg','pdf','png'];
		  $new_name = Null;
		  if($request->hasFile('ImageUpload')){
		    $file = $request->file('photo');
		    $ext  = $file->getClientOriginalExtension();
			$new_name = "review".$registerId.'_'.time().'.'.$ext;
			$file->move("review",$new_name);
			if(!in_array(strtolower($ext),$allowed)){
				return redirect('product-detail/'.$advance_pridct->sku.'#Reviews-tab')->with('status','Invalid file uploaded');
				exit;
			}
		  }
		  $register = Session::get('register');
          $registerId = $register->id;
		  
			  
			  Reviews::insert([
			      'account_id'=>$account_id,
			      'register_id'=>$registerId,
			      'product_id'=>$request->product_id,
			      'rating'=>$request->rating,
			      'headline'=>$request->headline,
			      'review'=>$request->review,
			      'photo'=>$new_name,
			  ]);
			  $message = 'Your review has been submitted successfully and will be published after review.';
		  
		return redirect('product-detail/'.$advance_pridct->sku.'#Reviews-tab')->with('status',$message);
	}
	public function deleted_address($id){
		if (Session::get('register')){
		  RegisterAddress::where(DB::Raw("md5(id)"),$id)
		    ->where('register_id', Session::get('register')->id)
			->delete();
			return Redirect::back()
                ->with('status', 'Deleted Successfully.');
		}
	}
	public function getAddress(Request $request){
		if (Session::get('register')){
		  $data = RegisterAddress::where(DB::Raw("md5(id)"),$request->id)
		    ->where('register_id', Session::get('register')->id)
			->first();
			return $data;
		}
	}
    public function direct_transfer(){
        $account = Session::get('currentAccount');
        $api = new Api('rzp_live_TS3paSIuurMzsF', 'hAn4JSEE3gq3EZh8MvJXWf1K');
        //$api = new Api('rzp_test_P6fn1Yx9KPkR10', 's7M6FlvjSNJ7alFHgn8AczD3');
        $api->transfer->create(array('account' => 'acc_KifKhtDLZPzdOp', 'amount' => 1000, 'currency' => 'INR'));
    }

    public function releaseAffPaymentAfterTransactionComplete($order_id){
       $account = Session::get('currentAccount');
       $order   = AdvanceProductOrder::where('order_id',$order_id)->whereNotNull('aff_id')->first();
       $product = AdvanceProductOrderDetail::where('order_id',$order_id)->whereNotNull('aff_amount')->get();
       $aff_insert_array = [];
       $aff_release_payment = 0;
       $total_aff_amount = 0;
       if(count($product)){
            $aff_deatil = Affiliate::where('code', $order->aff_id)->first();
            $aff_id = $order->aff_id;
            $pre_aff = Affiliate::where('code', $aff_id)->first();
            $preAmount = AccountCreditAffiliation::where('account_id', $account->id)->first();
            $aff_remaining_amount = $pre_aff->commission;
            $comp_remaining_amount = $preAmount->amount;
            foreach($product as $row){
                $total_aff_amount += $row->aff_amount;
                $aff_payment_status = 0;
                if($row->product->affiliation_payment_release_online=='On Order recieved'||$row->product->affiliation_payment_release_online=='On Payment Received'){
                    $aff_payment_status = 1;
                    $aff_release_payment += $row->aff_amount;
                }
                $aff_remaining_amount  = $aff_remaining_amount  + ($row->aff_amount);
                $comp_remaining_amount = $comp_remaining_amount - ($row->aff_amount);
                array_push($aff_insert_array,['account_id' => $account->id, 'user_type' => 'affiliate', 'affiliate_id' => $aff_id, 'reference_id' => $order_id, 'type' => 'Order', 'amount' => $row->aff_amount, 'remaining_amount' => $aff_remaining_amount, 'status'=>$aff_payment_status,'sub_reference_id'=>$row->product_id,'term'=>$row->product->affiliation_payment_release_online]);
                array_push($aff_insert_array,['account_id' => $account->id, 'user_type' => 'seller',    'affiliate_id' => $aff_id, 'reference_id' => $order_id, 'type' => 'Order', 'amount' => $row->aff_amount, 'remaining_amount' => $comp_remaining_amount,'status'=>$aff_payment_status,'sub_reference_id'=>$row->product_id,'term'=>$row->product->affiliation_payment_release_online]);
            }


            Affiliate::where('code', $aff_id)->update(['commission' => $aff_remaining_amount]);
            AccountCreditAffiliation::where('account_id', $account->id)->update(['amount' => $comp_remaining_amount ]);
            AffiliatePaymentHistory::insert($aff_insert_array);
            AdvanceProductOrder::where('order_id',$order_id)->update(['aff_amount'=>$total_aff_amount]);
            if($aff_release_payment!=0){
                if($aff_deatil->razorpay_account_id!=Null){
                        $ref_pay_array = [
                                            "account_number" => "4564563058857171",
                                            "fund_account_id" => $aff_deatil->razorpay_account_id,
                                            "amount" => ($aff_release_payment*100),
                                            "currency" => "INR",
                                            "mode" => "IMPS",
                                            "purpose" => "payout",
                                            "queue_if_low_balance" => true,
                                            "reference_id" => $order_id,
                                            "narration" => $order_id.' AFF Payment'
                                        ];
                        
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL,"https://api.razorpay.com/v1/payouts");
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_USERPWD, env('RAZORPAY_X_KEY').':'.env('RAZORPAY_X_SECRET'));
                        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($ref_pay_array));
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $server_output = curl_exec($ch);
                        
                        //var_dump($server_output);exit;
                        curl_close ($ch);
                    }
            }
       }
    }
    public function distibuteWalletAmout($order_id){
        $data = AdvanceProductOrder::where('order_id',$order_id)->first(); 
        if($data->wallet_tr_details!=Null){
            $tr = json_decode($data->wallet_tr_details,true);
            $amount = ($this->FinalAmount($tr['send_to']) + $tr['refree_benifit']);
            $wallet_amount = DB::table('wallets')->insert(['transaction_id' => '', 'account_id' => $tr['send_to'], 'credit' => $tr['refree_benifit'], 'amount' => $amount, 'status' => '0']);
            Coupon::where('id', $tr['coupon_id'])->update(['status' => 0, 'uesttime' => date('Y/m/d h:i:s A'), 'product_id' => Null, 'product_sale_price' => '', 'used_to' => $data->register_id]);
        }
        if($data->do_to_wallet!=Null){
            $amount = ($this->FinalAmount($data->register_id) - $data->do_to_wallet);
            DB::table('wallets')->insert(['transaction_id' => '', 'account_id' => $data->register_id, 'debit' => $data->do_to_wallet, 'amount' => $amount, 'status' => '0', 'order_id' => $order_id]);
        }
    }
    public function mySchemes(){
        if (Session::get('register'))
        {
            $domainName = $this->activeDomain();
            $account = Account::where('domain', $domainName)->with(['currency'])
                ->first();
            $orders = DB::table('coupon_assign')
                      ->leftJoin('fore_sale_xs','fore_sale_xs.id','=','coupon_assign.sale_x_id')
                      ->where('coupon_assign.send_to',Session::get('register')->id)
                      ->get();
            $data = DB::table('coupon_assign')
                      ->select('fore_sale_xs.scheme_name','fore_sale_xs.template_array','coupon_assign.set_no')
                      ->leftJoin('fore_sale_xs','fore_sale_xs.id','=','coupon_assign.sale_x_id')
                      ->where('coupon_assign.send_to',Session::get('register')->id)
                      ->get();
            $viewPath = $this->theme_prefix . '.account.my-schemes';
            $return = view($viewPath)->with('data', $data)->with('otherdata',app('App\Http\Controllers\ForeSaleXController'));
            return $return;
        }
        else
        {
            return redirect('login');
        }
    }
}

