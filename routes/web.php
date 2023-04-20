<?php


use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => '/'
],function(){
	Route::get('/','Nest\ThemeController@index');
	Route::get('product-detail/{sku}','Nest\ThemeController@productDetail');
	Route::post('add-to-cart','Nest\ThemeController@addToCart');
	Route::get('cart','Nest\ThemeController@cart');
	Route::get('checkout','Nest\ThemeController@checkout');
	Route::post('submitMobilefromCheckoutp','Nest\ThemeController@submitMobilefromCheckoutp');
	Route::post('verifyOTP','Nest\ThemeController@verifyOTP');
	Route::post('updateAddress','Nest\ThemeController@updateAddress');
	Route::post('processOrder','Nest\ThemeController@processOrder');
	Route::get('about','Nest\ThemeController@about');
	Route::get('contact','Nest\ThemeController@contact');
	Route::get('privacy','Nest\ThemeController@privacy');
	Route::get('shipping-policy','Nest\ThemeController@shippingPolicy');
	Route::get('return-policy','Nest\ThemeController@returnPolicy');
	Route::get('dashboard','Nest\ThemeController@dashboard');
	Route::get('orders','Nest\ThemeController@orders');
	Route::get('my-address','Nest\ThemeController@myAddress');
	Route::get('account-detail','Nest\ThemeController@accountDetail');
	Route::get('logout','Nest\ThemeController@logout');
	Route::get('forogot-password', 'Nest\ThemeController@forogotPassword');
	Route::post('forgot_password_otp_genrate', 'Nest\ThemeController@forgot_password_otp_genrate');
	Route::post('submitNewForgotPassoword', 'Nest\ThemeController@submitNewForgotPassoword');
	Route::get('userOrderCancel/{id}', 'Nest\ThemeController@userOrderCancel');
	/***************************/
    Route::get('login','Nest\ThemeController@login');
    Route::post('login_check','Nest\ThemeController@login_check');
    Route::post('initiate_sign_up','Nest\ThemeController@initiateSignUP');
    Route::post('sign_up_process','Nest\ThemeController@sign_up_process');
    Route::post('save_address','Nest\ThemeController@save_address');
    Route::get('wallet','Nest\ThemeController@wallet');
	/***************************/
	Route::get('shop/{id?}/{sub_id?}/{template?}','Nest\ThemeController@shop' );
	Route::get('filterProduct',  [ 'as' => 'filterProduct', 'uses' => 'Nest\ThemeController@filterProduct'] );
	Route::get('testNote',  'Nest\ThemeController@testNote' );
	Route::get('remove_cart/{id}',  'Nest\ThemeController@remove_cart' );
	Route::post('update-cart',  'Nest\ThemeController@updateCart' );
	Route::get('set_delivery_location/{id}',  'Nest\ThemeController@set_delivery_location' );
	Route::get('set_mannual_pincode',  'Nest\ThemeController@set_mannual_pincode' );
	Route::get('checkServiceAvailibity/{id}',  'Nest\ThemeController@zipCodeCheck' );
	Route::get('cancel_payment', 'Nest\ThemeController@cancel_payment');
	Route::post('order_r_process/{id?}', 'Nest\ThemeController@order_r_process');
	Route::get('confirmOrderNotification', 'Nest\ThemeController@confirmOrderNotification');
	Route::any('applyCoupon',  'Nest\ThemeController@applyCoupon');
	Route::get('invoice/{orderNo}','Nest\ThemeController@invoice');
	Route::get('term',  'Nest\ThemeController@term' );
	Route::get('pdf_gen',  'Nest\ThemeController@pdf_gen' );
	Route::get('getTrackingDetail/{id}',  'OrderController@getTrackingDetail');
	Route::get('u_referral_scheme', 'Nest\ThemeController@u_referral_scheme');
	Route::get('offer','Nest\ThemeController@offer');
	Route::post('rating_save','Nest\ThemeController@rating_save');
	Route::get('deleted_address/{id}','Nest\ThemeController@deleted_address');
	Route::any('getAddress','Nest\ThemeController@getAddress');
    Route::any('direct_transfer','Nest\ThemeController@direct_transfer'); 
    Route::any('test_email','Nest\ThemeController@test_email'); 
    Route::get('my-schemes','Nest\ThemeController@mySchemes');
});

Route::get('/test', 'WebSite\ThemeController@index');
#front Pages Routs start
Route::group([
    'prefix' => 'old/'
],function(){

Route::get('/Front', 'Front\FrontController@index');
Route::get('shop-wishlist/{sku?}', 'Front\FrontController@shopWishlist');
Route::get('shop-compare', 'Front\FrontController@shopCompare');
Route::get('our-account', 'Front\FrontController@ourAccount');
Route::get('our-contact', 'Front\FrontController@ourContact');
Route::get('product-single-shop/{sku}', 'Front\FrontController@ProductSingleShop');
Route::get('shop-cart', [ 'as' => 'shop-cart', 'uses' => 'Front\FrontController@shopCart']);
Route::get('products-shop/{id?}/{sub_id?}/{template?}',  [ 'as' => 'product', 'uses' => 'Front\FrontController@showShop']);
Route::get('userlogin',  [ 'as' => 'userlogin', 'uses' => 'Front\FrontController@login'] );
Route::post('userloginSubmit', [ 'as' => 'userloginSubmit', 'uses' => 'Front\FrontController@loginSubmit']);



Route::get('useregister',  [ 'as' => 'register', 'uses' => 'Front\FrontController@register'] );
Route::post('useregisterSubmit', [ 'as' => 'useregisterSubmit', 'uses' => 'Front\FrontController@registerSubmit']);
Route::post('zipCodeCheck', [ 'as' => 'zipCodeCheck', 'uses' => 'Front\FrontController@zipCodeCheck']);
Route::post('orderCancel', [ 'as' => 'orderCancel', 'uses' => 'Front\FrontController@orderCancel']);
Route::post('updateRegister', [ 'as' => 'updateRegister', 'uses' => 'Front\FrontController@updateRegister']);
Route::post('filterInventory', [ 'as' => 'filterInventory', 'uses' => 'Front\FrontController@filterInventory']);

Route::get('checkOutCart', [ 'as' => 'checkOutCart', 'uses' => 'Front\FrontController@checkOut']);
Route::post('confirmOrderProcessed', [ 'as' => 'confirmOrderProcessed', 'uses' => 'Front\FrontController@confirmOrder']);
Route::get('delwish/{sku}', 'Front\FrontController@delwish');

Route::get('filterProducts',  [ 'as' => 'filterProducts', 'uses' => 'Front\FrontController@filterProduct'] );
Route::get('About-me',  [ 'as' => 'About-me', 'uses' => 'Front\FrontController@UserAbout'] );
Route::get('ReturnPrivacy',  [ 'as' => 'ReturnPrivacy', 'uses' => 'Front\FrontController@ReturnPrivacy'] );
Route::get('ShippingPrivacy',  [ 'as' => 'ShippingPrivacy', 'uses' => 'Front\FrontController@ShippingPrivacy'] );
Route::get('MyAddress',  [ 'as' => 'MyAddress', 'uses' => 'Front\FrontController@MyAddress'] );
Route::get('OrderList',  [ 'as' => 'OrderList', 'uses' => 'Front\FrontController@OrderList'] );
Route::get('ContactUs',  [ 'as' => 'ContactUs', 'uses' => 'Front\FrontController@Contact'] );
Route::get('TermsConditions',  [ 'as' => 'TermsConditions', 'uses' => 'Front\FrontController@TermsConditions'] );
Route::get('OverPrivacy',  [ 'as' => 'OverPrivacy', 'uses' => 'Front\FrontController@OverPrivacy'] );
Route::get('OurAccount',  [ 'as' => 'OurAccount', 'uses' => 'Front\FrontController@Account'] );

Route::get('OurAddress', [ 'as' => 'OurAddress', 'uses' => 'Front\FrontController@address']);
Route::post('contactUsSubmit', [ 'as' => 'contactUsSubmit', 'uses' => 'Front\FrontController@contactSubmit']);
Route::get('ReturnsPolicy',  [ 'as' => 'ReturnsPolicy', 'uses' => 'Front\FrontController@return'] );

Route::get('UserOrderCancel/{id}', 'Front\FrontController@userOrderCancel');

Route::get('logOutClickok', [ 'as' => 'logOutClickok', 'uses' => 'Front\FrontController@logOutClick']);


Route::get('forgotPasswordUser',  [ 'as' => 'forgotPasswordUser', 'uses' => 'Front\FrontController@forgotPassword']);
Route::post('forgotPasswordSubmitUser',  [ 'as' => 'forgotPasswordSubmitUser', 'uses' => 'Front\FrontController@forgotPasswordSubmit']);
Route::post('forgotPasswordUpdateUser',  [ 'as' => 'forgotPasswordUpdateUser', 'uses' => 'Front\FrontController@forgotPasswordUpdate']);



#front Pages Routs End 

Route::get('/', 'WebSite\ThemeController@index');
Route::get('home_dummy', 'WebSite\ThemeController@home_dummy');
Route::get('mannual_aff_calculation', 'WebSite\ThemeController@mannual_aff_calculation');

Route::get('detail/{sku}', 'WebSite\ThemeController@advance_product_detail');
Route::get('my_schemes/', 'WebSite\ThemeController@my_schemes');
Route::get('userOrderCancel/{id}', 'WebSite\ThemeController@userOrderCancel');
Route::post('addToCartAdvance', 'WebSite\ThemeController@addToCartAdvance');
Route::post('process_order', 'WebSite\ThemeController@process_order');
Route::get('confirmOrderNotification', 'WebSite\ThemeController@confirmOrderNotification');

Route::get('instamojo_handler', 'WebSite\ThemeController@instamojo_handler');
Route::get('ap_product', 'WebSite\ThemeController@ap_product');
Route::get('ap_details/{id}', 'WebSite\ThemeController@ap_details');
Route::get('ap_cart/{id}', 'WebSite\ThemeController@ap_cart');
Route::post('order_r_process/{id?}', 'WebSite\ThemeController@order_r_process');
Route::get('cancel_payment', 'WebSite\ThemeController@cancel_payment');
Route::get('subscription/{id}', 'WebSite\ThemeController@subscription');
Route::get('subscription_plan', 'WebSite\ThemeController@subscription_plan');
Route::get('u_referral_scheme', 'WebSite\ThemeController@u_referral_scheme');
Route::post('subscriptionPlanR', 'WebSite\ThemeController@subscriptionPlanR');
Route::get('canel_subscription', 'WebSite\ThemeController@canel_subscription');
Route::get('about',  [ 'as' => 'about', 'uses' => 'WebSite\ThemeController@about'] );
Route::get('offer',  [ 'as' => 'offer', 'uses' => 'WebSite\ThemeController@offer'] );
Route::get('privacy',  [ 'as' => 'privacy', 'uses' => 'WebSite\ThemeController@privacy'] );
Route::get('shipping',  [ 'as' => 'shipping', 'uses' => 'WebSite\ThemeController@shipping'] );
Route::get('return',  [ 'as' => 'return', 'uses' => 'WebSite\ThemeController@return'] );

Route::get('contact',  [ 'as' => 'contact', 'uses' => 'WebSite\ThemeController@contact'] );
Route::post('contactSubmit', [ 'as' => 'contactSubmit', 'uses' => 'WebSite\ThemeController@contactSubmit']);

Route::get('term',  [ 'as' => 'term', 'uses' => 'WebSite\ThemeController@term'] );
Route::get('product/{id?}/{sub_id?}/{template?}',  [ 'as' => 'product', 'uses' => 'WebSite\ThemeController@product'] );
Route::get('filterProduct',  [ 'as' => 'filterProduct', 'uses' => 'WebSite\ThemeController@filterProduct'] );
Route::get('search',  [ 'as' => 'search', 'uses' => 'WebSite\ThemeController@search'] );
Route::get('detail',  [ 'as' => 'detail', 'uses' => 'WebSite\ThemeController@detail'] );

Route::get('login',  [ 'as' => 'login', 'uses' => 'WebSite\ThemeController@login'] );
Route::get('check_mobile',  [ 'as' => 'check_mobile', 'uses' => 'WebSite\ThemeController@check_mobile'] );
Route::get('ajaxSignUp',  [ 'as' => 'ajaxSignUp', 'uses' => 'WebSite\ThemeController@ajaxSignUp'] );
Route::get('checkLoginDetails',  [ 'as' => 'checkLoginDetails', 'uses' => 'WebSite\ThemeController@checkLoginDetails'] );
Route::post('loginSubmit', [ 'as' => 'loginSubmit', 'uses' => 'WebSite\ThemeController@loginSubmit']);

Route::post('optionFilter', [ 'as' => 'optionFilter', 'uses' => 'WebSite\ThemeController@optionFilter']);
Route::post('inquirySubmit', [ 'as' => 'inquirySubmit', 'uses' => 'WebSite\ThemeController@inquirySubmit']);
Route::post('addToCart', [ 'as' => 'addToCart', 'uses' => 'WebSite\ThemeController@addToCart']);
Route::post('updateCart', [ 'as' => 'updateCart', 'uses' => 'WebSite\ThemeController@updateCart']);
Route::get('cartList', [ 'as' => 'cartList', 'uses' => 'WebSite\ThemeController@cartList']);
Route::post('removeProduct', [ 'as' => 'removeProduct', 'uses' => 'WebSite\ThemeController@removeProduct']);
Route::get('checkOut', [ 'as' => 'checkOut', 'uses' => 'WebSite\ThemeController@checkOut']);
Route::post('couponCodeCodeCheck', [ 'as' => 'couponCodeCodeCheck', 'uses' => 'WebSite\ThemeController@couponCodeCodeCheck']);
Route::post('confirmOrder', [ 'as' => 'confirmOrder', 'uses' => 'WebSite\ThemeController@confirmOrder']);
Route::get('confirmOrderProcess/{userData}', [ 'as' => 'confirmOrderProcess', 'uses' => 'WebSite\ThemeController@confirmOrderProcess']);
Route::get('orderList', [ 'as' => 'orderList', 'uses' => 'WebSite\ThemeController@orderList']);
Route::get('orderReturn',  [ 'as' => 'orderReturn', 'uses' => 'WebSite\ThemeController@orderReturn'] );
Route::get('orderReplacement',  [ 'as' => 'orderReplacement', 'uses' => 'WebSite\ThemeController@orderReplacement'] );

Route::get('logOutClick', [ 'as' => 'logOutClick', 'uses' => 'WebSite\ThemeController@logOutClick']);

Route::get('register',  [ 'as' => 'register', 'uses' => 'WebSite\ThemeController@register'] );
Route::post('registerSubmit', [ 'as' => 'registerSubmit', 'uses' => 'WebSite\ThemeController@registerSubmit']);
Route::post('zipCodeCheck', [ 'as' => 'zipCodeCheck', 'uses' => 'WebSite\ThemeController@zipCodeCheck']);
Route::post('orderCancel', [ 'as' => 'orderCancel', 'uses' => 'WebSite\ThemeController@orderCancel']);
Route::post('updateRegister', [ 'as' => 'updateRegister', 'uses' => 'WebSite\ThemeController@updateRegister']);
Route::post('filterInventory', [ 'as' => 'filterInventory', 'uses' => 'WebSite\ThemeController@filterInventory']);

Route::get('address', [ 'as' => 'address', 'uses' => 'WebSite\ThemeController@address']);
Route::get('pages/{id}', 'WebSite\ThemeController@pages');
Route::post('addressSubmit',  [ 'as' => 'addressSubmit', 'uses' => 'WebSite\ThemeController@addressSubmit']);

Route::get('changePassword',  [ 'as' => 'changePassword', 'uses' => 'WebSite\ThemeController@changePassword']);
Route::get('wallet',  [ 'as' => 'wallet', 'uses' => 'WebSite\ThemeController@wallet']);
Route::post('changePasswordSubmit',  [ 'as' => 'changePasswordSubmit', 'uses' => 'WebSite\ThemeController@changePasswordSubmit']);

Route::get('my_coupon',  [ 'as' => 'my_coupon', 'uses' => 'WebSite\ThemeController@my_coupon']);

Route::get('forgotPassword',  [ 'as' => 'forgotPassword', 'uses' => 'WebSite\ThemeController@forgotPassword']);
Route::post('forgotPasswordSubmit',  [ 'as' => 'forgotPasswordSubmit', 'uses' => 'WebSite\ThemeController@forgotPasswordSubmit']);
Route::post('forgotPasswordUpdate',  [ 'as' => 'forgotPasswordUpdate', 'uses' => 'WebSite\ThemeController@forgotPasswordUpdate']);
});
Route::get('admin', 'AccountController@sessionManage');
Route::post('admin/logIn', [ 'as' => 'logIn', 'uses' => 'AccountController@loginCheck']);
Route::get('admin/forgotPasswordAdmin', [ 'as' => 'forgotPasswordAdmin', 'uses' => 'AccountController@forgotPasswordAdmin']);
Route::post('admin/forgotPasswordAdminSubmit', [ 'as' => 'forgotPasswordAdminSubmit', 'uses' => 'AccountController@forgotPasswordAdminSubmit']);
Route::post('admin/forgotPasswordAdminUpdate', [ 'as' => 'forgotPasswordAdminUpdate', 'uses' => 'AccountController@forgotPasswordAdminUpdate']);
Route::get('check_coupon',  [ 'as' => 'check_coupon', 'uses' => 'WebSite\ThemeController@check_coupon'] );
Route::get('request_otp',  [ 'as' => 'request_otp', 'uses' => 'WebSite\ThemeController@request_otp'] );

Route::post('delivery/pincode', 'WebSite\ThemeController@pinCodeCheck')->name('deliverycode');
Route::post('delivery/addressCode', 'WebSite\ThemeController@addressCode')->name('addresscode');


Route::group([

    'prefix' => 'admin/',
    'middleware' => 'checkuser'

], function () {

    #BannerController
    
    Route::get('download_qr_aff/{sku}/{code}', 'QrCodeController@download_qr_aff');
    Route::get('reviews','ReviewController@reviews');
    Route::get('review_status/{id}/{status}','ReviewController@review_status');
    Route::get('ProductPageBanner','ProductPageBannerController@index');
    Route::post('ProductPageBanner/SetProuctPageBanner','ProductPageBannerController@SetProuctPageBanner');
    Route::get('ProductPageBanner/edit/{id}','ProductPageBannerController@edit');
    Route::get('ProductPageBanner/show','ProductPageBannerController@show');
    Route::post('ProductPageBanner/update/{id}','ProductPageBannerController@update');
    Route::delete('ProductPageBannerDelete/{id}','ProductPageBannerController@deleted');

    Route::get('Productlistingpagebanner','ProductlistingpagebannerController@index');
    Route::post('Productlistingpagebanner/SetBanner','ProductlistingpagebannerController@store');
    Route::get('Productlistingpagebanner/edit/{id}','ProductlistingpagebannerController@edit');
    Route::get('Productlistingpagebanner/show','ProductlistingpagebannerController@show');
    Route::post('Productlistingpagebanner/update/{id}','ProductlistingpagebannerController@update');
    Route::delete('ProductlistingpagebannerDelete/{id}','ProductlistingpagebannerController@deleted');
  

    Route::get('banner/home_banner','BannerController@banner');
    Route::get('banner','BannerController@index');
    Route::get('banner_edit/{id}','BannerController@edit');
    Route::post('store_banner','BannerController@store_banner');
    Route::post('update_banner/{id}','BannerController@update_banner');
    Route::delete('delbanner/{id}','BannerController@delbanner');


    Route::get('banner/offer_banner','OfferBannerController@banner');
    Route::post('offerbanner','OfferBannerController@offer_banner');
    Route::get('offer/banner','OfferBannerController@index');
    Route::get('offer_banner_edit/{id}','OfferBannerController@edit');
    Route::post('updateofferbanner/{id}','OfferBannerController@updateofferbanner');
    Route::delete('delofferbanner/{id}','OfferBannerController@delofferbanner');

    Route::get('banner/subs_banner','SubscribeBannersController@banner');
    Route::post('subsbanner','SubscribeBannersController@subs_banner');
    Route::get('subs/banner','SubscribeBannersController@index');
    Route::get('subs_banner_edit/{id}','SubscribeBannersController@edit');
    Route::post('updatesubsbanner/{id}','SubscribeBannersController@updatesubsbanner');
    Route::delete('delsubsbanner/{id}','SubscribeBannersController@delsubsbanner');



    Route::get('home-page-setting', 'AccountController@homePageSetting');
    Route::post('home-page-setting', 'AccountController@homePageSettingPost');
    Route::get('dashboard', 'AccountController@dashboard');
    Route::get('chat', 'AccountController@chat');
    Route::get('profile', 'AccountController@profile');
    Route::post('upload_logo', 'AccountController@upload_logo');
    Route::post('affiliatePayDetail', [ 'as' => 'affiliatePayDetail', 'uses' => 'AccountController@affiliatePayDetail']);

    Route::get('logOut', [ 'as' => 'logOut', 'uses' => 'AccountController@logOut']);
    Route::resource('account', 'AccountController');
    Route::get('accountDetail/{id}', 'AccountController@accountDetail');
    Route::get('checkSmsSetting/{id}', 'AccountController@checkSmsSetting');
    Route::get('getShipRocketPickUpLocation/{id}', 'AccountController@getShipRocketPickUpLocation');
    Route::post('pinCodeCheck', [ 'as' => 'pinCodeCheck', 'uses' => 'AccountController@pinCodeCheck']);
    Route::resource('changePassword', 'ChangePasswordController');

    Route::get('register_users_listing_coloumn', 'AccountController@register_users_listing_coloumn');
    Route::post('register_users_listing_coloumn', 'AccountController@register_users_listing_coloumn_post');

    Route::resource('AccountCreditAffiliation', 'AccountCreditAffiliationController');
    Route::resource('currency', 'CurrencyController');
    Route::resource('about', 'AboutController');
    Route::get('faq/create/{id?}', 'FaqController@create');
    Route::resource('extraService', 'ExtraServiceController');
    Route::resource('socialMedia', 'SocialMediaController');
    Route::resource('faq', 'FaqController');
    Route::resource('affiliate', 'AffiliateController');
    Route::resource('affiliateKeyword', 'AffiliateKeywordController');
    Route::resource('AffiliatePayment', 'AffiliatePaymentController');
    Route::resource('AffiliatePaymentSubmit', 'AffiliatePaymentController');
    Route::resource('affiliationCreditAmt', 'AccountCreditAffiliationController');
    Route::resource('tag', 'TagController');
    Route::resource('label', 'LabelController');
    Route::resource('category', 'CategoryController');
    Route::resource('product', 'ProductController');
    Route::get('checkInventory/{id}', 'ProductController@checkInventory');
    Route::post('inventory_update', 'ProductController@inventory_update');

    Route::post('productAttribute', [ 'as' => 'productAttribute', 'uses' => 'ProductController@productAttribute']);
    Route::post('productAttributeUpdate', [ 'as' => 'productAttributeUpdate', 'uses' => 'ProductController@productAttributeUpdate']);
    Route::post('productInventory', [ 'as' => 'productInventory', 'uses' => 'ProductController@productInventory']);
    Route::post('productInventoryUpdate', [ 'as' => 'productInventoryUpdate', 'uses' => 'ProductController@productInventoryUpdate']);
    Route::post('productShipping', [ 'as' => 'productShipping', 'uses' => 'ProductController@productShipping']);
    Route::post('productShippingUpdate', [ 'as' => 'productShippingUpdate', 'uses' => 'ProductController@productShippingUpdate']);
    Route::post('productAdvanced', [ 'as' => 'productAdvanced', 'uses' => 'ProductController@productAdvanced']);
    Route::post('productRelated', [ 'as' => 'productRelated', 'uses' => 'ProductController@productRelated']);
    Route::post('productOffer', [ 'as' => 'productOffer', 'uses' => 'ProductController@productOffer']);
    Route::post('productPrice', [ 'as' => 'productPrice', 'uses' => 'ProductController@productPrice']);
    Route::get('approveInventory/{inventoryId}', 'ProductController@approveInventory');
    Route::resource('productApproval', 'ProductApprovalController');
    Route::get('productApprovalConfirm/{inventoryId}', 'ProductApprovalController@productApprovalConfirm');

    //Route::post('productQc', [ 'as' => 'productQc', 'uses' => 'ProductController@productQc']);
    Route::post('productApprovalQcMSG', [ 'as' => 'productApprovalQcMSG', 'uses' => 'ProductApprovalController@productApprovalQcMSG']);
    
    Route::resource('accountAffiliateKeyword', 'AccountAffiliateKeywordsController');
	 Route::get('accountAffiliate/keysample', 'AccountAffiliateKeywordsController@keysample')->name('keysample');
    Route::post('accountAffiliate/bulkeyword', 'AccountAffiliateKeywordsController@bulkeyword')->name('bulkeyword');
	Route::get('customer/detail/{id}', 'RegisterController@show')->name('customerDetail');
	Route::get('memeber_list', 'RegisterController@memeber_list');
	    Route::get('affiliateKeyword/review/keyword/', 'AffiliateKeywordController@reviewkey')->name('reviewkey');
    Route::post('affiliateKeyword/approve/{id}', 'AffiliateKeywordController@approved')->name('approvekey');
	
    Route::resource('productInquiry', 'ProductInquiryController');
    Route::resource('privacy', 'PrivacyController');
    Route::resource('shipping', 'ShippingController');
    Route::resource('returning', 'ReturningController');
    Route::resource('term', 'TermController');
    Route::resource('slider', 'SliderController');
    Route::resource('sliderApproval', 'SliderApprovalController');
    Route::get('sliderApprovalConfirm/{sliderId}', 'SliderApprovalController@sliderApprovalConfirm');

    Route::resource('register', 'RegisterController');
    Route::resource('generalInquiry', 'GeneralInquiryController');
    Route::resource('offerNormal', 'OfferNormalController');
    Route::resource('vendorKyc', 'VendorKycController');
    Route::post('update-kyc', 'VendorKycController@updateKyc');
    Route::get('approveKYC/{kycId}', 'VendorKycController@approveKYC');
    Route::get('product-discount-offer/{id?}', 'OfferNormalController@productDiscountOffer');
    Route::get('product-discount-offer-delete/{id}', 'OfferNormalController@productDiscountOfferDelete');
    Route::post('product-discount-offer', 'OfferNormalController@productDiscountOfferPost');

    
    Route::resource('productOrder', 'ProductOrderController');
    Route::post('updateCourierDetails',  [ 'as' => 'updateCourierDetails', 'uses' => 'OrderController@updateCourierDetails']);
	Route::get('getShipRocketlabel/{id}',  [ 'as' => 'getShipRocketlabel', 'uses' => 'OrderController@getShipRocketlabel']);
	Route::get('getTrackingDetail/{id}',  'OrderController@getTrackingDetail');
	Route::get('shiprocketPickUpRequest/{id}',  [ 'as' => 'shiprocketPickUpRequest', 'uses' => 'OrderController@shiprocketPickUpRequest']);
	Route::get('shiprocketTrack/{id}',  [ 'as' => 'shiprocketTrack', 'uses' => 'OrderController@shiprocketTrack']);
	Route::get('calculatePriceForAllPin/{id}',  [ 'as' => 'calculatePriceForAllPin', 'uses' => 'OrderController@calculatePriceForAllPin']);
    Route::get('updateOrderStatus/{orderNo}',  [ 'as' => 'updateOrderStatus', 'uses' => 'OrderController@updateOrderStatus']);
    Route::get('orderPrint/{orderNo}',  [ 'as' => 'orderPrint', 'uses' => 'OrderController@orderPrint']);
    Route::get('orderAcceptance/{orderNo}',  [ 'as' => 'orderAcceptance', 'uses' => 'OrderController@orderAcceptance']);
    Route::get('orderReject/{orderNo}',  [ 'as' => 'orderReject', 'uses' => 'OrderController@orderReject']);
    Route::get('print_delhivery_packing_slip/{orderNo}', 'OrderController@print_delhivery_packing_slip');
    Route::get('delivery_pick_up_request/', 'OrderController@delivery_pick_up_request');


    Route::get('affiliateLedger', 'ProductOrderController@affiliateLedger');
    Route::post('admin/initiateRefund', 'ProductOrderController@initiateRefund');
    Route::get('domainAffiliateLedger/{accountId}', 'ProductOrderController@domainAffiliateLedger');
    

    Route::get('bank-detail', 'BankDetailController@bankDetail');
    Route::post('bank-detail', 'BankDetailController@bankDetailPost');


    Route::resource('myKeyword', 'MyKeywordController');
    Route::resource('myLink', 'MyLinkController');
    Route::resource('mySelling', 'MySellingController');
    Route::resource('myInquiry', 'MyInquiryController');
    Route::resource('imageUpload', 'ImageUploadController');
    Route::post('image_upload_form', 'ImageUploadController@image_upload_form');
    Route::post('createFolder', [ 'as' => 'createFolder', 'uses' => 'ImageUploadController@createFolder']);
    Route::post('folderImage', [ 'as' => 'folderImage', 'uses' => 'ImageUploadController@folderImage']);
    Route::post('rename_form', [ 'as' => 'rename_form', 'uses' => 'ImageUploadController@rename_form']);
    
    Route::resource('userReason', 'UserReasonController');

    Route::resource('employee', 'EmployeeController');
    Route::get('ChangePassword', 'EmployeeController@ChangePassword');
    Route::post('employeChangePassword', [ 'as' => 'employeChangePassword', 'uses' => 'EmployeeController@employeChangePassword']);

    Route::resource('action', 'ActionController');
    Route::resource('page', 'PageController');

    Route::resource('empRestriction', 'EmpRestrictionController');
	Route::resource('msg', 'MsgnotifyController');
	Route::resource('offers', 'PurchaseofferController');
	Route::get('offers/create/{id?}', 'PurchaseofferController@create');
	Route::get('page_detail', 'PurchaseofferController@page_detail');
	Route::post('page_detail', 'PurchaseofferController@page_detail_post');
	Route::resource('schemes', 'ProductSchemeController');
	Route::get('membership/{id?}', 'MembershipController@membership');
	Route::get('membership_page/{id?}', 'MembershipController@membership_page');
	Route::post('membership_page', 'MembershipController@membership_page_post');
	Route::get('referral_scheme_page/{id?}', 'MembershipController@referral_scheme_page');
	Route::post('referral_scheme_page', 'MembershipController@referral_scheme_page_post');
	Route::get('razorpay_plan/', 'RazorPayController@razorpay_plan');
	Route::get('razorpay_subscription', 'RazorPayController@razorpay_subscription');
	Route::post('razorpay_subscription', 'RazorPayController@razorpay_subscription_post');
	Route::post('razorpay_plan/', 'RazorPayController@razorpay_plan_post');
	Route::post('membership_action', 'MembershipController@membership_action');
    Route::post('msg/info', 'MsgnotifyController@msginfo')->name('msginfo');
    Route::get('advance_product_template/{id?}', 'AdvanceProductController@advance_product_template');
    Route::get('advance_product_excel_download/{id?}', 'AdvanceProductController@advance_product_excel_download');
    Route::post('advance_product_template', 'AdvanceProductController@advance_product_template_post');
    Route::get('view_advance_product_template', 'AdvanceProductController@view_advance_product_template');
    Route::post('advance_product_qc', 'AdvanceProductController@advance_product_qc');
    Route::get('add_advance_product/{id}/{pre?}', 'AdvanceProductController@add_advance_product');
    Route::get('advance_product_category_action/{id}', 'AdvanceProductController@advance_product_category_action');
    Route::post('advance_product_category_action', 'AdvanceProductController@advance_product_category_action_post');
    Route::get('advance_product_subscription', 'AdvanceProductController@advance_product_subscription');
    Route::post('advance_product_subscription', 'AdvanceProductController@advance_product_subscription_post');
    Route::post('insert_advance_product', 'AdvanceProductController@insert_advance_product');
    Route::get('view_advance_product', 'AdvanceProductController@view_advance_product');
    Route::get('getSubCategory/{id}', 'AdvanceProductController@getSubCategory');
    Route::get('checkSKU/', 'AdvanceProductController@checkSKU');
    Route::post('save_subscription_category/', 'AdvanceProductController@save_subscription_category');
    Route::post('save_grouping_name/', 'AdvanceProductController@save_grouping_name');
    Route::get('advance_order/', 'AdvanceProductController@advance_order');
    Route::get('advance_order_status/{id}/{status}', 'AdvanceProductController@advance_order_status');
    Route::post('save_brand_for_template/', 'AdvanceProductController@save_brand_for_template');
    Route::get('cancel_shipping/{id}', 'AdvanceProductController@cancel_shipping');
    Route::get('advance_product_unsubscribe/{id}', 'AdvanceProductController@advance_product_unsubscribe');
    Route::get('advance_product_search/', 'AdvanceProductController@advance_product_search');
    Route::get('in_cart/', 'AdvanceProductController@in_cart');
    Route::post('upload_advance_product', 'AdvanceProductController@upload_advance_product');
    Route::post('updateProductForm', 'AdvanceProductController@updateProductForm');
    Route::get('advance_product_catalogue/{id}', 'AdvanceProductController@advance_product_catalogue');
    Route::get('advance_product_catalogue/{id}/{cat_id?}', 'AdvanceProductController@advance_product_catalogue');
    Route::post('advance_product_catalogue', 'AdvanceProductController@advance_product_catalogue_save');
    Route::get('advance_product_catalogue_delete/{id}', 'AdvanceProductController@advance_product_catalogue_delete');
    Route::post('save_category_banner', 'AdvanceProductController@save_category_banner');
    Route::get('dynamic_menu', 'AdvanceProductController@dynamic_menu');
    Route::post('dynamic_menu', 'AdvanceProductController@dynamic_menu_post');
    Route::get('delete_dynamic_menu/{id}', 'AdvanceProductController@delete_dynamic_menu');
    Route::get('getLastPrice/{id}', 'AdvanceProductController@getLastPrice');
	
	
    Route::get('brand/', 'BrandController@brand');
    Route::post('brand/', 'BrandController@brand_post');
    Route::get('user_action/{id}/{status}', 'AccountController@user_action');
    Route::get('referral_scheme', 'ReferralSchemeController@index');
    Route::get('view_referral_scheme', 'ReferralSchemeController@view_referral_scheme');
    Route::post('referral_scheme_shared_with', 'ReferralSchemeController@referral_scheme_shared_with');
    Route::post('referral_scheme', 'ReferralSchemeController@referral_scheme');
    Route::get('referral_scheme_delete/{id}', 'ReferralSchemeController@referral_scheme_delete');
    Route::get('referral_scheme_status/{id}/{status}', 'ReferralSchemeController@referral_scheme_status');

    #four sale x

    Route::get('four_sale_x', 'ForeSaleXController@index');
    Route::post('four_sale_x', 'ForeSaleXController@store');
    Route::get('view_fore_sale_x', 'ForeSaleXController@view_fore_sale_x');
    Route::get('exsal_coupons/{data}/{coupon}/{refferal_benifit}/{refree_benifit}', 'ForeSaleXController@ExsalCoupons');
    Route::get('single_template/{id}/{row}', 'ForeSaleXController@SingleTemplate');
    Route::get('testExcel/{id}/{row}', 'ForeSaleXController@testExcel');
    Route::get('view_sale_x', 'ForeSaleXController@view_sale_x');
    Route::get('findAllCuopan', 'ForeSaleXController@findAllCuopan');
    Route::post('cuopan_set_shared_with', 'ForeSaleXController@cuopan_set_shared_with');
    Route::get('UsedCoupon/{id}/{i}','ForeSaleXController@UsedCoupon');

    #suppar admin add setting controller 
    Route::get('add_description', 'SettingController@add_description');
    Route::get('view_description', 'SettingController@view_description');
    Route::post('set_description', 'SettingController@set_description');


    #Admin Employee Controller

    Route::resource('create_employee', 'AdminEmployeeController');
    Route::get('view_employee', 'AdminEmployeeController@view_employee');
    Route::post('set_employee', 'AdminEmployeeController@set_employee');
    Route::get('edit_employee/{emp_id}', 'AdminEmployeeController@edit_employee');
    Route::put('update_employee', 'AdminEmployeeController@update_employee');
    Route::get('status_update/{status}/{emp_id}', 'AdminEmployeeController@status_update');

    Route::get('home-page-slider','BannerController@homePageSlider');
    Route::post('home-page-slider','BannerController@homePageSliderPost');
	Route::get('category-icon','BannerController@categoryIcon');
    Route::post('category-icon','BannerController@categoryIconPost');
    Route::get('category-home-page-banner','BannerController@categoryHomePageBanner');
    Route::post('category-home-page-banner','BannerController@categoryHomePageBannerPost');
	Route::get('footer-slide','BannerController@footerSlide');
    Route::post('footer-slide','BannerController@footerSlidePost');
	Route::get('sub-category-home-page-banner/{subHome}','BannerController@categoryHomePageBanner');
    Route::get('daily-best-sell-banner','BannerController@dailyBestSellBanner');
    Route::post('daily-best-sell-banner','BannerController@dailyBestSellBannerPost');
    Route::get('home-page-lower-slide','BannerController@homePageLowerSlide');
    Route::post('home-page-lower-slide','BannerController@homePageLowerSlidePost');
	Route::get('deals-of-the-day','BannerController@dealsOfTheDay');
    Route::post('deals-of-the-day','BannerController@dealsOfTheDayPost');
    Route::get('home-page-slider-left/{subtype?}','BannerController@dailyBestSellBanner');
	
	Route::get('services','ServicesController@index');
	Route::post('services','ServicesController@servicesPost');
	Route::get('services-tag-master','ServicesController@servicesTagMaster');
	Route::get('services-variant/{id?}','ServicesController@servicesVariant');
	Route::get('service-provider','ServiceProviderController@index');
	
    Route::post('home-banner-action','BannerController@homeBannerAction');
    # Given Menu Permission Controller
    //Route::resource('given_permission/{emp_id?}','MenuPermissionController');
    Route::post('give_menu_permission','MenuPermissionController@give_menu_permission');
    

    

 });

 
