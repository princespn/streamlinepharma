<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <title>UandC</title>

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico')}}">

    

    <link rel="stylesheet" href="{{ asset('assets/plugins/morris/morris.css')}}">

    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet" type="text/css" />



    <!-- DataTables -->

    <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->

    <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />



    <!-- Summernote css -->

    <link href="{{ asset('assets/plugins/summernote/summernote-bs4.css')}}" rel="stylesheet" />

    

    <link href="{{ asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}" rel="stylesheet">

    <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">

    <link href="{{ asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet" />



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



</head>



    <body>

        

        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>



        <div class="header-bg">

            

            <header id="topnav">

                

                <div class="topbar-main">

                    <div class="container-fluid">

                        

                        <div class="logo">

                            

                            @if(Session::get('userType')==1)



                                <a href="dashboard" class="logo">

                                    {{Session::get('user')->title}}

                                </a>

    

                            @else

                                

                                <a href="dashboard" class="logo">

                                    {{Session::get('user')->name}}

                                </a>



                            @endif



                        </div>



                        <div class="menu-extras topbar-custom">



                            <ul class="list-inline float-right mb-0">

                                

                                <li class="list-inline-item dropdown notification-list">

                                

                                    <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"

                                    aria-haspopup="false" aria-expanded="false">



                                        @if(Session::get('userType')==1)



                                            <img src="{{URL::asset(Session::get('user')->logo)}}" alt="user" class="rounded-circle">

                                            <span class="ml-1">{{Session::get('user')->title}} <i class="mdi mdi-chevron-down"></i> </span>

                

                                        @else

                                            

                                            <span class="ml-1">{{Session::get('user')->name}} <i class="mdi mdi-chevron-down"></i> </span>



                                        @endif



                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">



                                        @if(Session::get('userType') == 1)



                                            @if(Session::get('user')->id != 1)

                                                <a class="dropdown-item" href="{{route('vendorKyc.index')}}"><i class="dripicons-card text-muted"></i> KYC</a>

                                                <a class="dropdown-item" href="{{route('affiliationCreditAmt.index')}}"><i class="dripicons-card text-muted"></i> Affiliation Credit</a>

                                                <a class="dropdown-item" href="{{route('changePassword.index')}}"><i class="dripicons-lock text-muted"></i> Change Password</a>

                                                <div class="dropdown-divider"></div>

                                            @endif

                                            

                                        @endif



                                        <a class="dropdown-item" href="{{route('logOut')}}"><i class="dripicons-exit text-muted"></i> Logout</a>

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

                                @if(Session::get('userType')==1)

                                    @if(Session::get('user')->id == 1)


                                        <li class="has-submenu">

                                            <a href="#"><i class="dripicons-checkmark"></i>Approval <i class="mdi mdi-chevron-down mdi-drop"></i></a>

                                            <ul class="submenu">

                                                <li>
                                                    <a href="{{route('productApproval.index')}}">Product Approval</a>
                                                </li>

                                                <li>
                                                    <a href="{{route('sliderApproval.index')}}">Reject Slider</a>
                                                </li>

                                            </ul>

                                        </li>
                                        

                                        <li class="has-submenu">

                                            <a href="#"><i class="dripicons-network-2"></i>Affiliation <i class="mdi mdi-chevron-down mdi-drop"></i></a>

                                            <ul class="submenu">

                                                <li>

                                                    <a href="{{route('affiliate.index')}}">Affiliate</a>

                                                </li>

                                                <li>

                                                    <a href="{{route('affiliateKeyword.index')}}">Affiliate Keywords</a>

                                                </li>

                                                <li>

                                                    <a href="{{route('affiliationCreditAmt.index')}}">Credit Domain Affiliation Amt.</a>

                                                </li>
												
												<li>

                                                    <a href="{{route('AffiliatePayment.index')}}">Affiliate Payment</a>

                                                </li>

                                            </ul>

                                        </li>

                                        <li class="has-submenu">

                                            <a href="#"><i class="dripicons-user-group"></i>Account & Currency <i class="mdi mdi-chevron-down mdi-drop"></i></a>

                                            <ul class="submenu">

                                                <li>

                                                    <a href="{{route('account.index')}}">Account Listing</a>

                                                </li>

                                                <li>

                                                    <a href="{{route('currency.index')}}">Currency Listing</a>

                                                </li>

                                            </ul>

                                        </li>
                                        <li class="has-submenu">

                                            <a href="#"><i class="dripicons-network-2"></i>Permission <i class="mdi mdi-chevron-down mdi-drop"></i></a>

                                            <ul class="submenu">
                                                <li>

                                                    <a href="{{route('empRestriction.index')}}">Employee Restriction</a>

                                                </li>  
                                                <li>

                                                    <a href="{{route('employee.index')}}">Employee Listing</a>

                                                </li>
                                                <li>

                                                    <a href="{{route('action.index')}}">Action</a>

                                                </li>

                                                <li>

                                                    <a href="{{route('page.index')}}">Pages</a>

                                                </li>
                                            </ul>

                                        </li>
                                        

                                    @else

                                        

                                        <li class="has-submenu">

                                            <a href="#"><i class="dripicons-wallet"></i>Income <i class="mdi mdi-chevron-down mdi-drop"></i></a>

                                            <ul class="submenu">

                                                <li>

                                                    <a href="{{route('productOrder.index')}}">Orders</a>

                                                </li>

                                                <li>

                                                    <a href="{{route('productInquiry.index')}}">Product Inquiry</a>

                                                </li>

                                                <li>

                                                    <a href="{{url('admin/affiliateLedger')}}">Affiliate Ledger</a>

                                                </li>

                                            </ul>

                                        </li>

                                        <li class="has-submenu">

                                            <a href="#"><i class="dripicons-user-group"></i>Users <i class="mdi mdi-chevron-down mdi-drop"></i></a>

                                            <ul class="submenu">

                                                <li>

                                                    <a href="{{route('register.index')}}">Registered</a>

                                                </li>

                                                <li>

                                                    <a href="{{route('generalInquiry.index')}}">General Inquiry</a>

                                                </li>

                                            </ul>

                                        </li>

                                        <li class="has-submenu">

                                            <a href="#"><i class="dripicons-weight"></i>Poduct <i class="mdi mdi-chevron-down mdi-drop"></i></a>

                                            <ul class="submenu">

                                                <li>

                                                    <a href="{{route('product.index')}}">Product List</a>

                                                </li>

                                                <li>

                                                    <a href="{{route('accountAffiliateKeyword.index')}}">My Keyword</a>

                                                </li>

                                                <li>

                                                    <a href="{{route('category.index')}}">Category</a>

                                                </li>

                                                <li>

                                                    <a href="{{route('slider.index')}}">Slider</a>

                                                </li>

                                                <li>

                                                    <a href="{{route('userReason.index')}}">User Reasons</a>

                                                </li>

                                                <li>

                                                    <a href="{{route('imageUpload.index')}}?ref_id=0">Image Upload</a>

                                                </li>

                                            </ul>

                                        </li>

                                        <li class="has-submenu">

                                            <a href="#"><i class="dripicons-calendar"></i>Offers <i class="mdi mdi-chevron-down mdi-drop"></i></a>

                                            <ul class="submenu">

                                                <li>

                                                    <a href="{{route('offerNormal.index')}}">Normal Offer</a>

                                                </li>

                                            </ul>

                                        </li>

                                        <li class="has-submenu">

                                            <a href="#"><i class="dripicons-tags"></i>Tags <i class="mdi mdi-chevron-down mdi-drop"></i></a>

                                            <ul class="submenu">

                                                <li>

                                                    <a href="{{route('tag.index')}}">Tag</a>

                                                </li>

                                                <li>

                                                    <a href="{{route('label.index')}}">Label</a>

                                                </li>

                                            </ul>

                                        </li>

                                        <li class="has-submenu">

                                            <a href="#"><i class="dripicons-to-do"></i>Pages <i class="mdi mdi-chevron-down mdi-drop"></i></a>

                                            <ul class="submenu">

                                                <li>

                                                    <a href="{{route('about.index')}}">Aboutus</a>

                                                </li>

                                                <li>

                                                    <a href="{{route('extraService.index')}}">Extra Service</a>

                                                </li>

                                                <li>

                                                    <a href="{{route('privacy.index')}}">Privacy Policy</a>

                                                </li>

                                                <li>

                                                    <a href="{{route('shipping.index')}}">Shipping Policy</a>

                                                </li>

                                                <li>

                                                    <a href="{{route('returning.index')}}">Return Policy</a>

                                                </li>

                                                <li>

                                                    <a href="{{route('term.index')}}">Terms & Condition</a>

                                                </li>

                                                <li>

                                                    <a href="{{route('socialMedia.index')}}">Social Media</a>

                                                </li>

                                            </ul>

                                        </li>

                                    @endif

        

                                @elseif(Session::get('userType')==2)

                                    

                                    <li class="has-submenu">

                                        <a href="#"><i class="dripicons-to-do"></i>My Links <i class="mdi mdi-chevron-down mdi-drop"></i></a>

                                        <ul class="submenu">

                                            <li>

                                                <a href="{{route('myKeyword.index')}}">My Keyword</a>

                                            </li>

                                            <li>

                                                <a href="{{route('myLink.index')}}">Affiliation link</a>

                                            </li>

                                            <li>

                                                <a href="{{route('mySelling.index')}}">Selling Income</a>

                                            </li>

                                            <li>

                                                <a href="{{route('myInquiry.index')}}">Inquiry Income</a>

                                            </li>

                                        </ul>

                                    </li>



                                    @elseif(Session::get('userType')==3)

                                    @php
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
                                    @endphp
                                    
                                        @if($productApproval == 1 ||  $sliderApproval == 1 )
                                            <li class="has-submenu">

                                                <a href="#"><i class="dripicons-checkmark"></i>Approval <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                                            
                                                <ul class="submenu">
                                                    @if($productApproval == 1)
                                                        <li>
                                                            <a href="{{route('productApproval.index')}}">Product Approval</a>
                                                        </li>
                                                    @endif

                                                    @if($sliderApproval == 1)
                                                        <li>
                                                            <a href="{{route('sliderApproval.index')}}">Reject Slider</a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            
                                            </li>
                                        @endif
                                        
                                        @if($affiliate == 1 ||  $affiliateKeyword == 1 ||  $affiliationCreditAmt == 1 ||  $AffiliatePayment == 1  )
                                            <li class="has-submenu">
                                            
                                                <a href="#"><i class="dripicons-network-2"></i>Affiliation <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                                            
                                                <ul class="submenu">

                                                    @if($affiliate == 1)
                                                        <li>                                            
                                                            <a href="{{route('affiliate.index')}}">Affiliate</a>                                            
                                                        </li>
                                                    @endif

                                                    @if($affiliateKeyword == 1)
                                                        <li>                                            
                                                            <a href="{{route('affiliateKeyword.index')}}">Affiliate Keywords</a>                                            
                                                        </li>
                                                    @endif

                                                    @if($affiliationCreditAmt == 1)
                                                        <li>                                            
                                                            <a href="{{route('affiliationCreditAmt.index')}}">Credit Domain Affiliation Amt.</a>                                            
                                                        </li>
                                                    @endif

                                                    @if($AffiliatePayment == 1)
                                                        <li>                                        
                                                            <a href="{{route('AffiliatePayment.index')}}">Affiliate Payment</a>                                        
                                                        </li>
                                                    @endif
                                                </ul>
                                            
                                            </li>
                                        @endif

                                        @if($account == 1)

                                            <li class="has-submenu">
                                            
                                                <a href="#"><i class="dripicons-user-group"></i>Account & Currency <i class="mdi mdi-chevron-down mdi-drop"></i></a>
                                            
                                                <ul class="submenu">
                                                    @if($account == 1)
                                                        <li>                                        
                                                            <a href="{{route('account.index')}}">Account Listing</a>                                        
                                                        </li>
                                                    @endif                                        
                                                </ul>
                                            
                                            </li>
                                        @endif

                                        <li class="has-submenu">

                                            <a href="#"><i class="dripicons-to-do"></i>My Profile <i class="mdi mdi-chevron-down mdi-drop"></i></a>

                                            <ul class="submenu">
                                                <li>
                                                    <a href="/admin/ChangePassword">Change Password</a>
                                                </li>
                                            </ul>

                                        </li>

                                   
                                    
                                @endif

                                

                            </ul>

                        </div>

                    </div>

                </div>

                

            </header>



            <div class="container-fluid">

                <div class="row">

                    <div class="col-sm-12">

                        <div class="page-title-box">

                            @yield('pageTitle')

                        </div>

                    </div>

                </div>

            </div>



        </div>



        <div class="wrapper">

            <div class="container-fluid">



                @yield('contentData')

                

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



        <script src="{{ asset('assets/js/jquery.min.js')}}"></script>

        <script src="{{ asset('assets/js/popper.min.js')}}"></script>

        <script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>

        <script src="{{ asset('assets/js/modernizr.min.js')}}"></script>

        <script src="{{ asset('assets/js/waves.js')}}"></script>

        <script src="{{ asset('assets/js/jquery.slimscroll.js')}}"></script>

        <script src="{{ asset('assets/js/jquery.nicescroll.js')}}"></script>

        <script src="{{ asset('assets/js/jquery.scrollTo.min.js')}}"></script>



        <script src="{{ asset('assets/plugins/morris/morris.min.js')}}"></script>

        <script src="{{ asset('assets/plugins/raphael/raphael-min.js')}}"></script>

        <script src="{{ asset('assets/pages/dashborad.js')}}"></script>



        <!-- Required datatable js -->

        <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>

        <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Buttons examples -->

        <script src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>

        <script src="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>

        <script src="{{ asset('assets/plugins/datatables/jszip.min.js')}}"></script>

        <script src="{{ asset('assets/plugins/datatables/pdfmake.min.js')}}"></script>

        <script src="{{ asset('assets/plugins/datatables/vfs_fonts.js')}}"></script>

        <script src="{{ asset('assets/plugins/datatables/buttons.html5.min.js')}}"></script>

        <script src="{{ asset('assets/plugins/datatables/buttons.print.min.js')}}"></script>

        <script src="{{ asset('assets/plugins/datatables/buttons.colVis.min.js')}}"></script>

        <!-- Responsive examples -->

        <script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>

        <script src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>



        <!-- Datatable init js -->

        <script src="{{ asset('assets/pages/datatables.init.js')}}"></script>



        <!-- Plugins js -->

        <script src="{{ asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>

        <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>

        <script src="{{ asset('assets/plugins/select2/js/select2.min.js')}}"></script>

        <script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>

        <script src="{{ asset('assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js')}}"></script>

        <script src="{{ asset('assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js')}}"></script>



        <script src="{{ asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>



        <!-- Plugins Init js -->

        <script src="{{ asset('assets/pages/form-advanced.js')}}"></script>



        <script type="text/javascript">

            $(document).ready(function() {

                $('form').parsley();

            });

        </script>



        <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js')}}"></script>

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

        <script src="{{ asset('assets/js/app.js')}}"></script>

        

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

        </script>
        <script src="{{ asset('cartManage/adminFunction.js')}}"></script>
    </body>



</html>