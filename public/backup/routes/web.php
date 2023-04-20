<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'WebSite\ThemeController@index');
Route::get('about',  [ 'as' => 'about', 'uses' => 'WebSite\ThemeController@about'] );
Route::get('privacy',  [ 'as' => 'privacy', 'uses' => 'WebSite\ThemeController@privacy'] );
Route::get('shipping',  [ 'as' => 'shipping', 'uses' => 'WebSite\ThemeController@shipping'] );
Route::get('return',  [ 'as' => 'return', 'uses' => 'WebSite\ThemeController@return'] );

Route::get('contact',  [ 'as' => 'contact', 'uses' => 'WebSite\ThemeController@contact'] );
Route::post('contactSubmit', [ 'as' => 'contactSubmit', 'uses' => 'WebSite\ThemeController@contactSubmit']);

Route::get('term',  [ 'as' => 'term', 'uses' => 'WebSite\ThemeController@term'] );
Route::get('product',  [ 'as' => 'product', 'uses' => 'WebSite\ThemeController@product'] );
Route::get('search',  [ 'as' => 'search', 'uses' => 'WebSite\ThemeController@search'] );
Route::get('detail',  [ 'as' => 'detail', 'uses' => 'WebSite\ThemeController@detail'] );

Route::get('login',  [ 'as' => 'login', 'uses' => 'WebSite\ThemeController@login'] );
Route::get('check_mobile',  [ 'as' => 'check_mobile', 'uses' => 'WebSite\ThemeController@check_mobile'] );
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
Route::post('addressSubmit',  [ 'as' => 'addressSubmit', 'uses' => 'WebSite\ThemeController@addressSubmit']);

Route::get('changePassword',  [ 'as' => 'changePassword', 'uses' => 'WebSite\ThemeController@changePassword']);
Route::post('changePasswordSubmit',  [ 'as' => 'changePasswordSubmit', 'uses' => 'WebSite\ThemeController@changePasswordSubmit']);

Route::get('forgotPassword',  [ 'as' => 'forgotPassword', 'uses' => 'WebSite\ThemeController@forgotPassword']);
Route::post('forgotPasswordSubmit',  [ 'as' => 'forgotPasswordSubmit', 'uses' => 'WebSite\ThemeController@forgotPasswordSubmit']);
Route::post('forgotPasswordUpdate',  [ 'as' => 'forgotPasswordUpdate', 'uses' => 'WebSite\ThemeController@forgotPasswordUpdate']);

Route::get('admin', 'AccountController@sessionManage');
Route::post('admin/logIn', [ 'as' => 'logIn', 'uses' => 'AccountController@loginCheck']);
Route::get('admin/forgotPasswordAdmin', [ 'as' => 'forgotPasswordAdmin', 'uses' => 'AccountController@forgotPasswordAdmin']);
Route::post('admin/forgotPasswordAdminSubmit', [ 'as' => 'forgotPasswordAdminSubmit', 'uses' => 'AccountController@forgotPasswordAdminSubmit']);
Route::post('admin/forgotPasswordAdminUpdate', [ 'as' => 'forgotPasswordAdminUpdate', 'uses' => 'AccountController@forgotPasswordAdminUpdate']);


Route::group([

    'prefix' => 'admin/',
    'middleware' => 'checkuser'

], function () {

    Route::get('dashboard', 'AccountController@dashboard');
    Route::post('affiliatePayDetail', [ 'as' => 'affiliatePayDetail', 'uses' => 'AccountController@affiliatePayDetail']);

    Route::get('logOut', [ 'as' => 'logOut', 'uses' => 'AccountController@logOut']);
    Route::resource('account', 'AccountController');
    Route::post('pinCodeCheck', [ 'as' => 'pinCodeCheck', 'uses' => 'AccountController@pinCodeCheck']);
    Route::resource('changePassword', 'ChangePasswordController');

    Route::resource('AccountCreditAffiliation', 'AccountCreditAffiliationController');
    Route::resource('currency', 'CurrencyController');
    Route::resource('about', 'AboutController');
    Route::resource('extraService', 'ExtraServiceController');
    Route::resource('socialMedia', 'SocialMediaController');
    Route::resource('affiliate', 'AffiliateController');
    Route::resource('affiliateKeyword', 'AffiliateKeywordController');
    Route::resource('AffiliatePayment', 'AffiliatePaymentController');
    Route::resource('AffiliatePaymentSubmit', 'AffiliatePaymentController');
    Route::resource('affiliationCreditAmt', 'AccountCreditAffiliationController');
    Route::resource('tag', 'TagController');
    Route::resource('label', 'LabelController');
    Route::resource('category', 'CategoryController');
    Route::resource('product', 'ProductController');

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
    Route::get('approveKYC/{kycId}', 'VendorKycController@approveKYC');

    Route::resource('productOrder', 'ProductOrderController');
    Route::post('updateCourierDetails',  [ 'as' => 'updateCourierDetails', 'uses' => 'OrderController@updateCourierDetails']);
    Route::get('updateOrderStatus/{orderNo}',  [ 'as' => 'updateOrderStatus', 'uses' => 'OrderController@updateOrderStatus']);
    Route::get('orderPrint/{orderNo}',  [ 'as' => 'orderPrint', 'uses' => 'OrderController@orderPrint']);
    Route::get('orderAcceptance/{orderNo}',  [ 'as' => 'orderAcceptance', 'uses' => 'OrderController@orderAcceptance']);
    Route::get('orderReject/{orderNo}',  [ 'as' => 'orderReject', 'uses' => 'OrderController@orderReject']);
    Route::get('affiliateLedger', 'ProductOrderController@affiliateLedger');
    Route::get('domainAffiliateLedger/{accountId}', 'ProductOrderController@domainAffiliateLedger');

    Route::resource('myKeyword', 'MyKeywordController');
    Route::resource('myLink', 'MyLinkController');
    Route::resource('mySelling', 'MySellingController');
    Route::resource('myInquiry', 'MyInquiryController');
    Route::resource('imageUpload', 'ImageUploadController');
    Route::post('createFolder', [ 'as' => 'createFolder', 'uses' => 'ImageUploadController@createFolder']);
    Route::post('folderImage', [ 'as' => 'folderImage', 'uses' => 'ImageUploadController@folderImage']);
    
    Route::resource('userReason', 'UserReasonController');

    Route::resource('employee', 'EmployeeController');
    Route::get('ChangePassword', 'EmployeeController@ChangePassword');
    Route::post('employeChangePassword', [ 'as' => 'employeChangePassword', 'uses' => 'EmployeeController@employeChangePassword']);

    Route::resource('action', 'ActionController');
    Route::resource('page', 'PageController');

    Route::resource('empRestriction', 'EmpRestrictionController');
 });
