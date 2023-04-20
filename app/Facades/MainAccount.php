<?php
namespace App\Facades;
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
use App\Models\Wallet;
use Hash;
use App\Models\Msgnotify;
use Illuminate\Http\Request;
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
use Response;


class MainAccount {
    public static function  MyUser(){
       $domainName = $_SERVER['HTTP_HOST'];
       $account = Account::where('domain', $domainName)->with(['currency'])->first();
        return $account;
    }
    public  static function categoryList(){
        return $categoryList = Category::where('account_id' , MainAccount::MyUser()->id)->whereNull('ref_id')->whereNull('deleted_at')->get();
     }
}