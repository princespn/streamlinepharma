<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <title>UandC</title>
      <link rel="shortcut icon" href="<?php echo e(asset('assets/images/favicon.ico')); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/morris/morris.css')); ?>">
      <link href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('assets/css/icons.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('assets/css/style.css')); ?>" rel="stylesheet" type="text/css" />
      <!-- DataTables -->
      <link href="<?php echo e(asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('assets/plugins/datatables/buttons.bootstrap4.min.css')); ?>" rel="stylesheet" type="text/css" />
      <!-- Responsive datatable examples -->
      <link href="<?php echo e(asset('assets/plugins/datatables/responsive.bootstrap4.min.css')); ?>" rel="stylesheet" type="text/css" />
      <!-- Summernote css -->
      <link href="<?php echo e(asset('assets/plugins/summernote/summernote-bs4.css')); ?>" rel="stylesheet" />
      <link href="<?php echo e(asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')); ?>" rel="stylesheet">
      <link href="<?php echo e(asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')); ?>" rel="stylesheet">
      <link href="<?php echo e(asset('assets/plugins/select2/css/select2.min.css')); ?>" rel="stylesheet" type="text/css" />
      <link href="<?php echo e(asset('assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css')); ?>" rel="stylesheet" />
      <style>
         /* width */
         ::-webkit-scrollbar {
         width: 1px;
         }
         /* Handle */
         ::-webkit-scrollbar-thumb {
         background: #67479E; 
         }
      </style>
      <?php echo $__env->yieldContent('css'); ?>
   </head>
   <body>
      <div id="preloader">
         <div id="status">
            <div class="spinner"></div>
         </div>
      </div>
      <?php if( !isset($_REQUEST['ph']) || $_REQUEST['ph']!='true'): ?>
      <div class="header-bg">
         <header id="topnav">
            <div class="topbar-main">
               <div class="container-fluid">
                  <div class="logo">
                     <?php if(Session::get('userType')==1): ?>
                     <a href="dashboard" class="logo">
                     <?php echo e(Session::get('user')->title); ?>

                     </a>
                     <?php else: ?>
                     <a href="dashboard" class="logo">
                     <?php echo e(Session::get('user')->name); ?>

                     </a>
                     <?php endif; ?>
                  </div>
                  <div class="menu-extras topbar-custom">
                     <ul class="list-inline float-right mb-0">
                        <li class="list-inline-item dropdown notification-list">
                           <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                              aria-haspopup="false" aria-expanded="false">
                           <?php if(Session::get('userType')==1): ?>
                           <img src="<?php echo e(URL::asset(Session::get('user')->logo)); ?>" alt="user" class="rounded-circle">
                           <span class="ml-1"><?php echo e(Session::get('user')->title); ?> <i class="mdi mdi-chevron-down"></i> </span>
                           <?php else: ?>
                           <span class="ml-1"><?php echo e(Session::get('user')->name); ?> <i class="mdi mdi-chevron-down"></i> </span>
                           <?php endif; ?>
                           </a>
                           <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                              <?php if(Session::get('userType') == 1): ?>
                              <?php if(Session::get('user')->id != 1): ?>
                              <a class="dropdown-item" href="<?php echo e(url('admin/home-page-setting')); ?>"><i class="dripicons-card text-muted"></i>Homepage</a>
                              <a class="dropdown-item" href="<?php echo e(route('vendorKyc.index')); ?>"><i class="dripicons-card text-muted"></i> KYC</a>
                              <a class="dropdown-item" href="<?php echo e(route('affiliationCreditAmt.index')); ?>"><i class="dripicons-card text-muted"></i> Affiliation Credit</a>
                              <a class="dropdown-item" href="<?php echo e(url('admin/profile')); ?>"><i class="dripicons-card text-muted"></i> Profile</a>
                              <a class="dropdown-item" href="<?php echo e(route('changePassword.index')); ?>"><i class="dripicons-lock text-muted"></i> Change Password</a>
                              <div class="dropdown-divider"></div>
                              <?php endif; ?>
                              <?php endif; ?>
                              <?php if(Session::get('userType') == 2): ?>
                              <a class="dropdown-item" href="<?php echo e(url('admin/bank-detail')); ?>"><i class="dripicons-lock text-muted"></i>Bank Details</a>
                              <?php endif; ?>
                              
                              <a class="dropdown-item" href="<?php echo e(url('admin/logOut')); ?>"><i class="dripicons-exit text-muted"></i> Logout</a>
                           </div>
                        </li>
                        
                        <li class="menu-item list-inline-item">
                           <a class="navbar-toggle nav-link">
                              <div class="lines">
                                 <span></span>
                                 <span></span>
                                 <span></span>
                              </div>
                           </a>
                        </li>
                     </ul>
                  </div>
                  <div class="clearfix"></div>
               </div>
            </div>
            <div class="navbar-custom">
               <div class="container-fluid">
                  <div id="navigation">
                     <ul class="navigation-menu">
                        <li class="has-submenu">
                           <a href="dashboard"><i class="dripicons-device-desktop"></i>Dashboard</a>
                        </li>
                        <?php if(Session::get('userType')==1): ?>
                        <?php if(Session::get('user')->id == 1): ?>
                        <li class="has-submenu">
                           <a href="#"><i class="dripicons-checkmark"></i>Approval <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                           <ul class="submenu">
                              <li>
                                 <a href="<?php echo e(url('admin/view_advance_product')); ?>">Product Approval</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(route('sliderApproval.index')); ?>">Reject Slider</a>
                              </li>
                           </ul>
                        </li>
                        <li class="has-submenu">
                           <a href="#"><i class="dripicons-network-2"></i>Affiliation <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                           <ul class="submenu">
                              <li>
                                 <a href="<?php echo e(route('affiliate.index')); ?>">Affiliate</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(route('affiliateKeyword.index')); ?>">Affiliate Keywords</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(route('affiliationCreditAmt.index')); ?>">Credit Domain Affiliation Amt.</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(route('AffiliatePayment.index')); ?>">Affiliate Payment</a>
                              </li>
                           </ul>
                        </li>
                        <li class="has-submenu">
                           <a href="#"><i class="dripicons-user-group"></i>Account & Currency <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                           <ul class="submenu">
                              <li>
                                 <a href="<?php echo e(route('account.index')); ?>">Account Listing</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(route('currency.index')); ?>">Currency Listing</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(url('admin/advance_order')); ?>">Advance Product Order</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(url('admin/advance_product_template')); ?>">Advance Product Template</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(url('admin/view_advance_product_template')); ?>">View Advance Product Template</a>
                              </li>
                           </ul>
                        </li>
                        <!--
                           <li class="has-submenu">
                           
                               <a href="#"><i class="dripicons-network-2"></i>Permission <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                           
                               <ul class="submenu">
                                   <li>
                           
                                       <a href="<?php echo e(route('empRestriction.index')); ?>">Employee Restriction</a>
                           
                                   </li>  
                                   <li>
                           
                                       <a href="<?php echo e(route('employee.index')); ?>">Employee Listing</a>
                           
                                   </li>
                                   <li>
                           
                                       <a href="<?php echo e(route('action.index')); ?>">Action</a>
                           
                                   </li>
                           
                                   <li>
                           
                                       <a href="<?php echo e(route('page.index')); ?>">Pages</a>
                           
                                   </li>
                               </ul>
                           
                           </li> -->
                        <li class="has-submenu">
                           <a href="#"><i class="dripicons-user"></i>Employee <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                           <ul class="submenu">
                              <li>
                                 <a href="<?php echo e(url('admin/create_employee')); ?>">Create / View</a>
                              </li>
                           </ul>
                        </li>
                        <li class="has-submenu">
                           <a href="#"><i class="dripicons-network-2"></i>Setting <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                           <ul class="submenu">
                              <li>
                                 <a href="<?php echo e(url('admin/add_description')); ?>">Add Desciption</a>
                              </li>
                           </ul>
                        </li>
						<li class="has-submenu">
                           <a href="#"><i class="dripicons-network-2"></i>Service Provider <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                           <ul class="submenu">
                              <li>
                                 <a href="<?php echo e(url('admin/services')); ?>">Services</a>
                              </li>
							  <li>
                                 <a href="<?php echo e(url('admin/services-variant')); ?>">Services Variant</a>
                              </li>
							  <li>
                                 <a href="<?php echo e(url('admin/service-provider')); ?>">Service Provider</a>
                              </li>
                           </ul>
                        </li>
                        <?php else: ?>
                        <li class="has-submenu">
                           <a href="#"><i class="dripicons-wallet"></i>Income <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                           <ul class="submenu">
                              <li>
                                 <a href="<?php echo e(url('admin/in_cart')); ?>">In Cart</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(url('admin/advance_order')); ?>">Orders</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(route('productOrder.index')); ?>">Orders</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(route('productInquiry.index')); ?>">Product Inquiry</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(url('admin/affiliateLedger')); ?>">Affiliate Ledger</a>
                              </li>
                           </ul>
                        </li>
                        <li class="has-submenu">
                           <a href="#"><i class="dripicons-user-group"></i>Users <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                           <ul class="submenu">
                              <li>
                                 <a href="<?php echo e(route('register.index')); ?>">Registered</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(route('generalInquiry.index')); ?>">General Inquiry</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(url('admin/memeber_list')); ?>">Member's List</a>
                              </li>
                           </ul>
                        </li>
                        <li class="has-submenu">
                           <a href="#"><i class="dripicons-weight"></i>Poduct <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                           <ul class="submenu">
                              <!--li>
                                 <a href="<?php echo e(route('product.index')); ?>">Product List</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(route('accountAffiliateKeyword.index')); ?>">My Keyword</a>
                              </li-->
                              <li>
                                 <a href="<?php echo e(route('category.index')); ?>">Category</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(route('slider.index')); ?>">Slider</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(route('userReason.index')); ?>">User Reasons</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(route('imageUpload.index')); ?>?ref_id=0">Image Upload</a>
                              </li>
                           </ul>
                        </li>
                        <li class="has-submenu">
                           <a href="#"><i class="dripicons-calendar"></i>Offers <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                           <ul class="submenu">
                              <li>
                                 <a href="<?php echo e(route('offerNormal.index')); ?>">Normal Offer</a>
                              </li>
							  <li>
                                 <a href="<?php echo e(url('admin/product-discount-offer')); ?>">Product Discount Offer</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(route('offers.index')); ?>">Purchase Offer</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(url('admin/referral_scheme')); ?>">Referral Scheme</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(url('admin/four_sale_x')); ?>">Sale X</a>
                              </li>
                           </ul>
                        </li>
                        <!--li class="has-submenu">
                           <a href="#"><i class="dripicons-tags"></i>Tags <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                           <ul class="submenu">
                              <li>
                                 <a href="<?php echo e(route('tag.index')); ?>">Tag</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(route('label.index')); ?>">Label</a>
                              </li>
                           </ul>
                        </li-->
                        <li class="has-submenu">
                           <a href="#"><i class="dripicons-to-do"></i>Pages <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                           <ul class="submenu">
                              <li>
                                 <a href="<?php echo e(route('about.index')); ?>">Aboutus</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(route('extraService.index')); ?>">Extra Service</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(route('privacy.index')); ?>">Privacy Policy</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(route('shipping.index')); ?>">Shipping Policy</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(route('returning.index')); ?>">Return Policy</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(route('term.index')); ?>">Terms & Condition</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(route('socialMedia.index')); ?>">Social Media</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(route('faq.index')); ?>">Special Pages</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(route('msg.index')); ?>">SMS Notifications Management</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(url('admin/page_detail')); ?>">Dynamic Name</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(url('admin/referral_scheme_page')); ?>">Referral Scheme Page</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(url('admin/membership')); ?>">Membership Program</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(url('admin/razorpay_plan')); ?>">Razor Pay Subscription</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(url('admin/advance_product_subscription')); ?>">Advance Product Teplate Subscription</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(url('admin/brand')); ?>">Brand Management</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(url('admin/register_users_listing_coloumn')); ?>">Register Users listing Coloumn</a>
                              </li>
                           </ul>
                        </li>
						<li class="has-submenu">
                           <a href="<?php echo e(url('admin/reviews')); ?>"><i class="dripicons-device-desktop"></i>Reviews</a>
                        </li>
                        <li class="has-submenu">
                           <a href="#"><i class="dripicons-to-do"></i>Banners <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                           <ul class="submenu">
						   <?php
						   $home_banner = [
						      '1'=>'Home Page Slider',
						      '2'=>'Home Page Slider - Left',
						      '3'=>'Home Page Slider - Right',
						      '4'=>'Home Page Slider',
						      '5'=>'Home Page Slider',
						      '6'=>'Home Page Slider',
						      '7'=>'Home Page Slider',
									];
						   ?>
						      <li>
                                 <a href="<?php echo e(url('admin/home-page-slider')); ?>"><?php echo e($home_banner[$account->home_page]); ?></a>
                              </li>
						   <?php if($account->home_page==7): ?>
						      <li>
                                 <a href="<?php echo e(url('admin/category-icon')); ?>">Category Icon</a>
                              </li>
						   <?php endif; ?>
						   <?php if($account->home_page==1||$account->home_page==7): ?>
                              
                              <li>
                                 <a href="<?php echo e(url('admin/category-home-page-banner')); ?>">Category Home Page Banner</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(url('admin/daily-best-sell-banner')); ?>">Daily Best Sell Banner</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(url('admin/deals-of-the-day')); ?>">Deals of the Day</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(url('admin/home-page-lower-slide')); ?>">Home Page Lower Slide</a>
                              </li>
							<?php elseif($account->home_page==2): ?>
							  	
							  <li>
                                 <a href="<?php echo e(url('admin/home-page-slider-left/Right')); ?>">Home Page Slider - Right</a>
                              </li>	
							  <li>
                                 <a href="<?php echo e(url('admin/category-home-page-banner')); ?>">Category Home Page Banner</a>
                              </li>
							  <li>
                                 <a href="<?php echo e(url('admin/daily-best-sell-banner')); ?>">Daily Best Sell Banner</a>
                              </li>
							  <li>
                                 <a href="<?php echo e(url('admin/deals-of-the-day')); ?>">Deals of the Day</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(url('admin/home-page-lower-slide')); ?>">Home Page Lower Slide</a>
                              </li>
							<?php else: ?>
							  <?php if($account->home_page==5): ?>
							  <li>
                                 <a href="<?php echo e(url('admin/home-page-slider-left/RightUpper')); ?>">Home Page Slider - Right Upper</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(url('admin/home-page-slider-left/RightBottom')); ?>">Home Page Slider - Right Bottom</a>
                              </li>
							  <li>
                                 <a href="<?php echo e(url('admin/sub-category-home-page-banner/sub-cat')); ?>">Home Page Sub Category</a>
                              </li>							  
							  <?php endif; ?>
							  <li>
                                 <a href="<?php echo e(url('admin/deals-of-the-day')); ?>">Deals of the Day</a>
                              </li>
							  <?php if($account->home_page!=6): ?>
							  <li>
                                 <a href="<?php echo e(url('admin/category-home-page-banner')); ?>">Category Home Page Banner</a>
                              </li>
							  <li>
                                 <a href="<?php echo e(url('admin/daily-best-sell-banner')); ?>">Daily Best Sell Banner</a>
                              </li>
							  <li>
                                 <a href="<?php echo e(url('admin/home-page-lower-slide')); ?>">Home Page Lower Slide</a>
                              </li>
							  <?php endif; ?>
							  
							<?php endif; ?>
							   <li>
                                 <a href="<?php echo e(url('admin/footer-slide')); ?>">Footer Slider</a>
                              </li>
                           </ul>
                        </li>
                        <?php endif; ?>
                        <?php elseif(Session::get('userType')==2): ?>
                        <li class="has-submenu">
                           <a href="#"><i class="dripicons-to-do"></i>My Links <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                           <ul class="submenu">
                              <li>
                                 <a href="<?php echo e(route('myKeyword.index')); ?>">My Keyword</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(route('myLink.index')); ?>">Affiliation link</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(route('mySelling.index')); ?>">Selling Income</a>
                              </li>
                              <li>
                                 <a href="<?php echo e(route('myInquiry.index')); ?>">Inquiry Income</a>
                              </li>
                           </ul>
                        </li>
                        <?php elseif(Session::get('userType')==3): ?>
                        <?php
                        $restrictionArray = Session::get('restrictions');
                        $productApproval = 0;
                        $sliderApproval = 0;
                        $affiliate = 0;
                        $affiliateKeyword = 0;
                        $affiliationCreditAmt = 0;
                        $AffiliatePayment = 0;
                        $account = 0;
                        foreach($restrictionArray as $key => $value)
                        { 
                        $page_id = $value["page_id"];
                        if($page_id == 1){
                        $productApproval = 1;
                        }
                        if($page_id == 2){
                        $sliderApproval = 1;
                        }
                        if($page_id == 3){
                        $affiliate = 1;
                        }
                        if($page_id == 4){
                        $affiliateKeyword = 1;
                        }
                        if($page_id == 5){
                        $affiliationCreditAmt = 1;
                        }
                        if($page_id == 6){
                        $AffiliatePayment = 1;
                        }
                        if($page_id == 7){
                        $account = 1;
                        }
                        }
                        ?>
                        <?php if($productApproval == 1 ||  $sliderApproval == 1 ): ?>
                        <li class="has-submenu">
                           <a href="#"><i class="dripicons-checkmark"></i>Approval <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                           <ul class="submenu">
                              <?php if($productApproval == 1): ?>
                              <li>
                                 <a href="<?php echo e(route('productApproval.index')); ?>">Product Approval</a>
                              </li>
                              <?php endif; ?>
                              <?php if($sliderApproval == 1): ?>
                              <li>
                                 <a href="<?php echo e(route('sliderApproval.index')); ?>">Reject Slider</a>
                              </li>
                              <?php endif; ?>
                           </ul>
                        </li>
                        <?php endif; ?>
                        <?php if($affiliate == 1 ||  $affiliateKeyword == 1 ||  $affiliationCreditAmt == 1 ||  $AffiliatePayment == 1  ): ?>
                        <li class="has-submenu">
                           <a href="#"><i class="dripicons-network-2"></i>Affiliation <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                           <ul class="submenu">
                              <?php if($affiliate == 1): ?>
                              <li>                                            
                                 <a href="<?php echo e(route('affiliate.index')); ?>">Affiliate</a>                                            
                              </li>
                              <?php endif; ?>
                              <?php if($affiliateKeyword == 1): ?>
                              <li>                                            
                                 <a href="<?php echo e(route('affiliateKeyword.index')); ?>">Affiliate Keywords</a>                                            
                              </li>
                              <?php endif; ?>
                              <?php if($affiliationCreditAmt == 1): ?>
                              <li>                                            
                                 <a href="<?php echo e(route('affiliationCreditAmt.index')); ?>">Credit Domain Affiliation Amt.</a>                                            
                              </li>
                              <?php endif; ?>
                              <?php if($AffiliatePayment == 1): ?>
                              <li>                                        
                                 <a href="<?php echo e(route('AffiliatePayment.index')); ?>">Affiliate Payment</a>                                        
                              </li>
                              <?php endif; ?>
                           </ul>
                        </li>
                        <?php endif; ?>
                        <?php if($account == 1): ?>
                        <li class="has-submenu">
                           <a href="#"><i class="dripicons-user-group"></i>Account & Currency <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                           <ul class="submenu">
                              <?php if($account == 1): ?>
                              <li>                                        
                                 <a href="<?php echo e(route('account.index')); ?>">Account Listing</a>                                        
                              </li>
                              <?php endif; ?>                                        
                           </ul>
                        </li>
                        <?php endif; ?>
                        <li class="has-submenu">
                           <a href="#"><i class="dripicons-to-do"></i>My Profile <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                           <ul class="submenu">
                              <li>
                                 <a href="/admin/ChangePassword">Change Password</a>
                              </li>
                           </ul>
                        </li>
                        <?php endif; ?>
                     </ul>
                  </div>
               </div>
            </div>
         </header>
         <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="page-title-box">
                     <?php echo $__env->yieldContent('pageTitle'); ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php endif; ?>
      <div class="wrapper">
         <div class="container-fluid">
            <?php echo $__env->yieldContent('contentData'); ?>
         </div>
      </div>
      <footer class="footer">
         <div class="container-fluid">
            <div class="row">
               <div class="col-12">
                  © 2019 - 2020 uniqueandcommon.com, All rights reserved
               </div>
            </div>
         </div>
      </footer>
      <script src="<?php echo e(asset('assets/js/jquery.min.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/js/popper.min.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/js/bootstrap.min.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/js/modernizr.min.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/js/waves.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/js/jquery.slimscroll.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/js/jquery.nicescroll.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/js/jquery.scrollTo.min.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/plugins/morris/morris.min.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/plugins/raphael/raphael-min.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/pages/dashborad.js')); ?>"></script>
      <!-- Required datatable js -->
      <script src="<?php echo e(asset('assets/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/plugins/datatables/dataTables.bootstrap4.min.js')); ?>"></script>
      <!-- Buttons examples -->
      <script src="<?php echo e(asset('assets/plugins/datatables/dataTables.buttons.min.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/plugins/datatables/buttons.bootstrap4.min.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/plugins/datatables/jszip.min.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/plugins/datatables/pdfmake.min.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/plugins/datatables/vfs_fonts.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/plugins/datatables/buttons.html5.min.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/plugins/datatables/buttons.print.min.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/plugins/datatables/buttons.colVis.min.js')); ?>"></script>
      <!-- Responsive examples -->
      <script src="<?php echo e(asset('assets/plugins/datatables/dataTables.responsive.min.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/plugins/datatables/responsive.bootstrap4.min.js')); ?>"></script>
      <!-- Datatable init js -->
      <script src="<?php echo e(asset('assets/pages/datatables.init.js')); ?>"></script>
      <!-- Plugins js -->
      <script src="<?php echo e(asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/plugins/select2/js/select2.min.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js')); ?>"></script>
      <script src="<?php echo e(asset('assets/plugins/parsleyjs/parsley.min.js')); ?>"></script>
      <!-- Plugins Init js -->
      <script src="<?php echo e(asset('assets/pages/form-advanced.js')); ?>"></script>
      <?php echo $__env->yieldContent('script'); ?>
      <script type="text/javascript">
         $(document).ready(function() {
         
             $('form').parsley();
         
         });
         
      </script>
      <script src="<?php echo e(asset('assets/plugins/summernote/summernote-bs4.min.js')); ?>"></script>
      <script>
         jQuery(document).ready(function(){
         
             $('.summernote').summernote({
         
                 height: 300,                 // set editor height
         
                 minHeight: null,             // set minimum height of editor
         
                 maxHeight: null,             // set maximum height of editor
         
                 focus: true                 // set focus to editable area after initializing summernote
         
             });
         
         });
         
      </script>
      <script>
         $(function(){
         
             setTimeout(function() {
         
                 $('.msgPopup').slideUp();
         
             }, 5000);
         
         });
         
      </script>
      <!-- Mouse + Keyboard Restriction  -->
      <script src="<?php echo e(asset('assets/js/app.js')); ?>"></script>
      <script>
         function addRemoveDiv(keyMain)
         
         {
         
             if($('#availableInventory'+keyMain).is(":checked")) {
         
         
         
                 $("#sku"+keyMain).prop('required',true);
         
                 $("#sku"+keyMain).prop("readonly", false);
         
         
         
             } else {
         
                 
         
                 $("#sku"+keyMain).val('');
         
                 $("#sku"+keyMain).removeAttr("required");
         
                 $("#sku"+keyMain).prop("readonly", true);
         
             }
         
         }
         
      </script>
      <script>
         function amountCalculation(Key)
         
         {
         
             var sprice = document.getElementById("sprice"+Key).value;
         
             var offerPercentage = document.getElementById("offerPercentage"+Key).value;
         
             
         
             var chargePercentage = document.getElementById("chargePercentage"+Key).value;
         
         
         
             var commission = (sprice * chargePercentage / 100);
         
             document.getElementById("chargePrice"+Key).value = commission;
         
         
         
             var offer = (sprice * offerPercentage / 100);
         
             document.getElementById("offerPrice"+Key).value = offer;
         
         
         
             calculatedAmount = sprice - commission - offer;
         
         
         
             document.getElementById("amount"+Key).value = calculatedAmount.toFixed(2);
         
         }
         function checkSmsSetting(id){
			 var myKeyVals = { 
	                  _token   : $('input[name=_token]').val(),
					}
	var saveData = $.ajax({
		  type: 'GET',
		  url: "<?php echo e(url('admin/checkSmsSetting')); ?>/"+id,
		  dataType: "text",
		  success: function(data){
			  console.log(data);
			  $('#nimbus_rsponce').html(data);
		  }
	});
    saveData.error(function(){ 
	    
	});
		 }
      </script>
      <script src="<?php echo e(asset('cartManage/adminFunction.js')); ?>"></script>
   </body>
</html><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/layouts/app.blade.php ENDPATH**/ ?>