<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use View;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\Models\AdvanceProductCart;
use App\Models\RegisterAddress;
use App\Models\DynamicMenu;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
		view()->composer('*', function($view) {
		$domainName = (new Controller)->activeDomain();
        $referral_page = [];
        $account = DB::table('accounts') 
		           ->where('domain', $domainName)->first();
		if($account){
		   $referral_page = DB::table('referral_pages')
		                 ->where('account_id',$account->id)
						 ->get();
           $dynamic_menu = DB::table('faq')
		                   ->where('account_id',$account->id)
						   ->get();
			$register = Session::get('register');
			if($register){
              $registerId = $register->id;
			  $loadAddress = RegisterAddress::where('register_id',$registerId)
			  ->where('zipCode','!=','')->get();
			  if(!Session::get('delivery_location')&&count($loadAddress)){
				  Session::put('delivery_location',$loadAddress[0]->zipCode);
			  }
			  View::share('loadAddress', $loadAddress);
			}else{
            $registerId = '';
			}
			$dynamic_menu_auth = DynamicMenu::where('account_id',$account->id)
			                     ->where(DB::Raw(" ( 
								   (category != Null) or  
								   ( category = Null and sub_category != Null ) or
								   ( category = Null and sub_category = Null and setting != Null )
								   ) "))
								 ->groupBy('category')
								 ->orderBy('id')
								 ->get();
			$cartList      = AdvanceProductCart::where('register_id',Session::getId())
			                 ->get();
			$cartListQty      = AdvanceProductCart::where('register_id',Session::getId())
			                 ->sum('qty');
			$auth_home_page_lower_slide = DB::table('banner_home_page_lower_slide')->where('account_id',$account->id)->where('type','Home'.$account->home_page)
			   ->first();
			$auth_banner_footer_slide = DB::table('banner_footer_slide')->where('account_id',$account->id)->where('type','Home'.$account->home_page)
			   ->get();
            View::share('dynamic_menu', $dynamic_menu);
            View::share('dynamic_menu_auth', $dynamic_menu_auth);
            
            View::share('cartList', $cartList);
            View::share('cartListQty', $cartListQty);
            View::share('auth_home_page_lower_slide', $auth_home_page_lower_slide);
            View::share('auth_banner_footer_slide', $auth_banner_footer_slide);
		}
		    $order_status = [
			                 'Order Placed',
							 'Payment',
							 'Rejected',
							 'Accepted',
							 'Shipped',
							 'Shipping Cancelled',
							 'Order Cancelled',
							 'Delivered'
							 ];
			$review_status = [
			                 'Under Review',
							 'Approved',
							 'Rejected'
							 ];
			$shipping_gateway = [
			                 '1'=>'Shipyaari',
							 '2'=>'Shiprocket',
							 '3'=>'Delhivery'
							 ];
			$payment_gateway = [
			                 '1'=>'COD',
							 '2'=>'Razorpay',
							 '3'=>'Instamojo',
							 ];
			$qc = [
			                 '0'=>'Awaiting Review',
							 '1'=>'Approved',
							 '2'=>'Declined',
							 ];
			$qc_color = [
			                 '0'=>'yellow',
							 '1'=>'green',
							 '2'=>'red',
							 ];
			$aff_amount_status = [
			                 '0'=>'Hold',
							 '1'=>'Released',
							 '2'=>'Reversed'
							 ];
			
			View::share('constant_order_status', $order_status);
			View::share('constant_review_status', $review_status);
            View::share('shipping_gateway', $shipping_gateway);
            View::share('payment_gateway', $payment_gateway);
			View::share('referral_page', $referral_page);
			View::share('qc', $qc);
			View::share('qc_color', $qc_color);
			View::share('account', $account);
			View::share('aff_amount_status', $aff_amount_status);
			
		});
		
    }
}
