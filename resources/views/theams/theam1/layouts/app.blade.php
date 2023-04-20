<!DOCTYPE html>
<html>
   <head>

      <meta charset="utf-8">
         @yield('socialMeta')
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
	 
      <title> {{ $account->title }}</title>
      <!-- Standard Favicon -->
      <link rel="icon" type="image/x-icon" href="{{ asset($account->logo) }}" />
      <!-- Library - Google Font Familys -->
      <link href="https://fonts.googleapis.com/css?family=Arizonia|Crimson+Text:400,400i,600,600i,700,700i|Lato:100,100i,300,300i,400,400i,700,700i,900,900i|Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/theam1/revolution/css/settings.css') }}">
      <!-- RS5.0 Layers and Navigation Styles -->
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/theam1/revolution/css/layers.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/theam1/revolution/css/navigation.css') }}">
      <!-- Library - Bootstrap v3.3.5 -->
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/theam1/libraries/lib.css') }}">
      <!-- Custom - Common CSS -->
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/theam1/css/plugins.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/theam1/css/navigation-menu.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/theam1/css/shortcode.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/theam1/style.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/theam1/css/xzoom.css') }}">
      <link type="text/css" rel="stylesheet" media="all" href="{{ asset('assets/theam1/fancybox/source/jquery.fancybox.css') }}" />
      <link type="text/css" rel="stylesheet" media="all" href="{{ asset('assets/theam1/magnific-popup/css/magnific-popup.css') }}" />
      <style>
      .mobile{
        display:none;
      }
.desktop{
  display:block;
}
         @media only screen and (max-width: 638px) {
           .header-social {
              margin-top:5px;
              text-align:center;
            }
			.mobile{
             display:inline;
            }
			.desktop{
			  display:none;
			}
         }
      </style>
   </head>
   <body data-offset="200" data-spy="scroll" data-target=".ow-navigation">
      <!--onload="cartList();"-->
      <div class="main-container">
         <!-- Loader -->
         <div id="site-loader" class="load-complete">
            <div class="loader">
               <div class="loader-inner ball-clip-rotate">
                  <div></div>
               </div>
            </div>
         </div>
         <!-- Loader /- -->
         <!-- Header -->
         <header class="header-section container-fluid no-padding">
            <!-- Top Header -->
            <div class="top-header container-fluid no-padding">
               <!-- Container -->
               <div class="container">
                  <div class="col-md-3 col-sm-12 col-xs-12 dropdown-bar" style='text-align:center'>
                     <h5>Welcome To {{ $account->title }}</h5>
                     <div class='mobile'>
                        @if(Session::get('register'))
                        @else
                        <a href="{{ url('login') }}"><i class="icon icon-User"></i> </a>	
                        @endif
                        <a aria-expanded="true" aria-haspopup="true" data-toggle="dropdown" id="cart" class="btn dropdown-toggle" title="Add To Cart" href="#"><i class="icon icon-ShoppingCart">  </i></a>
                        <ul class="dropdown-menu no-padding">
                           @if (count($cartList))
                           @foreach ($cartList as $item)
                           <li class="mini_cart_item">
                              <a href="#" class="shop-thumbnail">
                              <img class="attachment-shop_thumbnail" src="{{ $item->product->thumbnail }}" style="height: 50px;">
                              {{ substr($item->product->title,0,15) }}
                              </a>
                              <span class="quantity">{{$item->qty}} &#215; <span class="amount">Rs {{number_format($item->product->selling_price,2)}}</span></span>
                           </li>
                           @endforeach
                           <li class="button">
                              <a href="{{route('cartList')}}" title="View Cart">View Cart</a>
                              @if(Session::get('register'))
                              <a href="{{route('checkOut')}}" title="Check Out">Check out</a>
                              @endif
                           </li>
                           @else
                           <li class="button">
                              <h3>Your Basket is empty.</h3>
                           </li>
                           @endif
                        </ul>
                     </div>
                  </div>
                  <div class="col-md-6 col-sm-12 col-xs-12 dropdown-bar">
                     {!! Form::open(['url' => url('product'),'method'=>'get','id'=>'form','enctype'=>'multipart/form-data']) !!}
                     <input type="text" name="search" class="form-control" placeholder="Enter a keyword and press enter..." style='padding: 0 16px;
                        border-radius: 2px 0 0 2px;
                        border: 1px solid #f93065;
                        outline: 0 none;
                        font-size: 14px;
                        height: 44px;
                        width: 100%;
                        margin-top: 5px;' />
                     {!! Form::close() !!}
                  </div>
                  <!-- Social -->
                  <div class="col-md-3 col-sm-12 col-xs-12 header-social  desktop">
                     @if(Session::get('register'))
                     @else
                     <a href="{{ url('login') }}" style='background-color: #f93065;
                        color: #fff;
                        padding: 12px 32px;
                        border-radius: 5px;'>Login </a>	
                     @endif
					 @if(Session::get('register'))
					  <a href="{{route('logOutClick')}}" class="logo" style='background-color: #f93065;
                        color: #fff;
                        padding: 12px 32px;
                        border-radius: 5px;'>
                              Logout
                              </a>	 
					 @endif
                     <a aria-expanded="true" aria-haspopup="true" data-toggle="dropdown" id="cart" class="btn dropdown-toggle" title="Add To Cart" href="#" style='border: 2px solid #f93065;
                        line-height: 25px;
                        margin-left: 5px;
                        border-radius: 5px;'><i class="icon icon-ShoppingCart"> Cart </i></a>
                     <ul class="dropdown-menu no-padding">
                        @if (count($cartList))
                        @foreach ($cartList as $item)
                        <li class="mini_cart_item">
                           <a href="#" class="shop-thumbnail">
                           <img class="attachment-shop_thumbnail" src="{{ $item->product->thumbnail }}" style="height: 50px;">
                           {{ substr($item->product->title,0,15) }}
                           </a>
                           <span class="quantity">{{$item->qty}} &#215; <span class="amount">Rs {{number_format($item->product->selling_price,2)}}</span></span>
                        </li>
                        @endforeach
                        <li class="button">
                           <a href="{{route('cartList')}}" title="View Cart">View Cart</a>
                           @if(Session::get('register'))
                           <a href="{{route('checkOut')}}" title="Check Out">Check out</a>
                           @endif
                        </li>
                        @else
                        <li class="button">
                           <h3>Your Basket is empty.</h3>
                        </li>
                        @endif
                     </ul>
                     @php $socialList = App\Models\SocialMedia::where('account_id' , $account->id)->first() @endphp
                     <ul>
                        
                        @if($socialList && $socialList->facebook)
                        <li><a href="{{$socialList->facebook}}" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                        @endif
                        @if($socialList && $socialList->twitter)
                        <li><a href="{{$socialList->twitter}}" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                        @endif
                        @if($socialList && $socialList->googleplus)
                        <li><a href="{{$socialList->googleplus}}" target="_blank" title="Google Plus"><i class="fa fa-google-plus"></i></a></li>
                        @endif
                        @if($socialList && $socialList->instagram)
                        <li><a href="{{$socialList->instagram}}" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a></li>
                        @endif
                        @if($socialList && $socialList->pinterest)
                        <li><a href="{{$socialList->pinterest}}" target="_blank" title="Pinterest"><i class="fa fa-pinterest-p"></i></a></li>
                        @endif
                        @if($socialList && $socialList->dribble)
                        <li><a href="{{$socialList->dribble}}" target="_blank" title="Dribbble"><i class="fa fa-dribbble"></i></a></li>
                        @endif
                        @if($socialList && $socialList->vimeo)
                        <li><a href="{{$socialList->vimeo}}" target="_blank" title="Vimeo"><i class="fa fa-vimeo"></i></a></li>
                        @endif
                        @if($socialList && $socialList->youtube)
                        <li><a href="{{$socialList->youtube}}" target="_blank" title="Youtube"><i class="fa fa-youtube"></i></a></li>
                        @endif
                     </ul>
                  </div>
                  <!-- Social /- -->
               </div>
               <!-- Container /- -->
            </div>
            <!-- Top Header /- -->
            <!-- Menu Block -->
            <div class="container-fluid no-padding menu-block">
               <!-- Container -->
               <div class="container">
                  <!-- nav -->
                  <nav class="navbar navbar-default ow-navigation">
                     <div class="navbar-header">
                        <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                        <a href="/" class="navbar-brand"><img src="{{ asset($account->logo) }}" /></a>
                     </div>
                     <!-- Menu Icon -->
                     <div class="menu-icon">
                        <!--div class="search">
                           <a href="#" id="search" title="Search"><i class="icon icon-Search"></i></a>
                           
                           </div-->
                        <ul class="cart">
                           <li>
                              <span id="cartDisplay"></span>
                              @if(Session::get('register'))
                              <!--a href="{{route('orderList')}}" class="logo">
                              Welcome {{Session::get('register')->name}}
                              </a-->
                              
                              @else
                              <a href="{{route('login')}}" title="User"><i class="icon icon-User"></i></a>
                              @endif
                           </li>
                        </ul>
                     </div>
                     <!-- Menu Icon /- -->
                     <div class="navbar-collapse collapse navbar-right" id="navbar">
                        <ul class="nav navbar-nav">
                           <li class="active"><a href="/" title="Home">Home</a></li>
                           @php $categoryList = App\Models\Category::where('account_id' , $account->id)->whereNull('ref_id')->whereNull('deleted_at')->get() @endphp
                           @foreach ($categoryList as $category)
                           <li class="dropdown">
                              <a href="{{ url('product/'.$category->id) }}" title="Home" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false"> {{ $category->name }} </a>
                              <i class="ddl-switch fa fa-angle-down"></i>
                              <ul class="dropdown-menu">
                                 @foreach ($category->subCategory as $subCategory)
                                 <li class="active dropdown">
                                    <a href="{{ url('product/'.$category->id.'/'.$subCategory->id) }}">{{ $subCategory->name }}</a>
                                    @if(count($subCategory->template)>0)
                                    <ul class="dropdown-menu mega-menu">
                                       @foreach ($subCategory->template as $subsubCategory)
                                       <li><a href="{{ url('product/'.$category->id.'/'.$subCategory->id.'/'.$subsubCategory->template->id) }}">{{ $subsubCategory->template->name }}</a></li>
                                       @endforeach
                                    </ul>
                                    @endif
                                 </li>
                                 @endforeach
                              </ul>
                           </li>
                           @endforeach
                           @if($account->offer_page_title!=Null)
                           <li><a href="{{ route('offer') }}" title="About Us">{{ $account->offer_page_title }}</a></li>
                           @endif
                           <li><a href="{{ route('about') }}" title="About Us">About Us</a></li>
                           <li><a href="{{ route('contact') }}" title="Contact Us">Contact Us</a></li>
						   @if($account->isMembership==1)
                        <li><a href="{{ url('subscription_plan') }}"  title="Facebook">{{ $account->memebership_title }}</a></li>
                        @endif
						@if(count($referral_page))
                        <li><a href="{{ url('u_referral_scheme') }}"  title="Facebook">Scheme</a></li>
                        @endif
                        </ul>
                     </div>
                     <!--/.nav-collapse -->
                  </nav>
                  <!-- nav /- -->
                  <!-- Search Box -->
                  <div class="search-box">
                     <span><i class="icon_close"></i></span>
                     {!! Form::open(['url' => url('product'),'method'=>'get','id'=>'form','enctype'=>'multipart/form-data']) !!}
                     <input type="text" name="search" class="form-control" placeholder="Enter a keyword and press enter..." />
                     {!! Form::close() !!} 
                  </div>
                  <!-- Search Box /- -->
               </div>
               <!-- Container /- -->
            </div>
            <!-- Menu Block /- -->
         </header>
         <!-- Header /- -->
         <main>
            @yield('theme1Content')
         </main>
         <!-- Footer Main -->
         <footer id="footer-main" class="footer-main container-fluid">
            <!-- Container -->
            <div class="container">
               <div class="row">
                  <!-- Widget Links -->
                  <aside class="col-md-3 col-sm-6 col-xs-6 ftr-widget widget_links">
                     <h3 class="widget-title">Information Link</h3>
                     <ul>
                        <li><a href="{{route('about')}}" title="About Us">About Us</a></li>
                        <li><a href="{{route('privacy')}}" title="Privacy Policy">Privacy Policy</a></li>
                        <li><a href="{{route('shipping')}}" title="Shipping Policy">Shipping Policy</a></li>
                        <li><a href="{{route('return')}}" title="Returns Policy">Returns Policy</a></li>
                     </ul>
                  </aside>
                  <!-- Widget Links /- -->
                  <!-- Widget Account -->
                  <aside class="col-md-3 col-sm-6 col-xs-6 ftr-widget widget_links widget_account">
                     <h3 class="widget-title">My Account</h3>
                     <ul>
                        <li><a href="{{route('address')}}" title="My Order Details">My Account</a></li>
                        <li><a href="{{route('orderList')}}" title="My credit Offers">Order History</a></li>
                        @foreach($dynamic_menu as $dynamic_menu_row)
                        <li><a href="{{url('pages/'.$dynamic_menu_row->id)}}" title="{{ $dynamic_menu_row->title }}">{{ $dynamic_menu_row->title }}</a></li>
                        @endforeach
                     </ul>
                  </aside>
                  <!-- Widget Account /- -->
                  <!-- Widget Account -->
                  <aside class="col-md-3 col-sm-6 col-xs-6 ftr-widget widget_links widget_account">
                     <h3 class="widget-title">Customer Service</h3>
                     <ul>
                        <li><a href="{{route('contact')}}" title="My Order Details">Contact Us</a></li>
                        <li><a href="{{route('term')}}" title="My credit Offers">Terms & Conditions</a></li>
                     </ul>
                  </aside>
                  <!-- Widget Account /- -->
                  <!-- Widget About -->
                  <aside class="col-md-3 col-sm-6 col-xs-6 ftr-widget widget_about">
                     {{-- <a href="/" title="santander"><img src="{{ asset($account->logo) }}" style="height: 50px;"/></a> --}}
                     <div class="info">
                        <p><i class="icon icon-Pointer"></i>{{$account->address}}</p>
                        <p><i class="icon icon-Phone2"></i><a href="tel:{{$account->phone}}" title="Phone" class="phone">{{$account->phone}}</a></p>
                        <p><i class="icon icon-Imbox"></i><a href="mailto:{{$account->email}}" title="{{$account->email}}">{{$account->email}}</a></p>
                     </div>
                  </aside>
                  <!-- Widget About /- -->
               </div>
               <div class="copyright-section">
                  <div class="coyright-content">
                     <p>All rights reserved : Unique And Common © 2020</p>
                  </div>
               </div>
            </div>
            <!-- Container /- -->
         </footer>
         <!-- Footer Main /- -->
         <div style='width: 60px;
            height: 60px;
            background-color: #2DB742;
            border-radius: 50%;
            padding: 13px;
            position: fixed;
            bottom: 30px;
            left: 30px;'>
            <a href='https://api.whatsapp.com/send?phone=+91{{ $account->phone }}&text=Hi'><img src="{{ url('images/whatsapp_logo.svg') }}"></a>
         </div>
      </div>
      <!-- JQuery v1.12.4 -->
      <script src="{{ asset('assets/theam1/js/jquery.min.js')}}"></script>
      <script src="{{ asset('assets/theam1/js/xzoom.min.js')}}"></script>
      <script src="{{ asset('assets/theam1/js/setup.js')}}"></script>
      <script src="{{ asset('assets/theam1/fancybox/source/jquery.fancybox.js')}}"></script>
      <script src="{{ asset('assets/theam1/magnific-popup/js/magnific-popup.js')}}"></script>
      <!-- Library - Js -->
      <script src="{{ asset('assets/theam1/libraries/lib.js')}}"></script>
      <script src="{{ asset('assets/theam1/libraries/jquery.countdown.min.js')}}"></script>
      <!-- RS5.0 Core JS Files -->
      <script type="text/javascript" src="{{ asset('assets/theam1/revolution/js/jquery.themepunch.tools.min.js?rev=5.0')}}"></script>
      <script type="text/javascript" src="{{ asset('assets/theam1/revolution/js/jquery.themepunch.revolution.min.js?rev=5.0')}}"></script>
      <script type="text/javascript" src="{{ asset('assets/theam1/revolution/js/extensions/revolution.extension.video.min.js')}}"></script>
      <script type="text/javascript" src="{{ asset('assets/theam1/revolution/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
      <script type="text/javascript" src="{{ asset('assets/theam1/revolution/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
      <script type="text/javascript" src="{{ asset('assets/theam1/revolution/js/extensions/revolution.extension.navigation.min.js')}}"></script>
      <script type="text/javascript" src="{{ asset('assets/theam1/revolution/js/extensions/revolution.extension.actions.min.js')}}"></script>
      <!-- Library - Theme JS -->
      <script src="{{ asset('assets/theam1/js/functions.js')}}"></script>
      <script src="{{ asset('cartManage/cart.js')}}"></script>
      <script>
         // $(document).ready(function(){
         
         //     $('.container').each(function(){  
         //         var highestBox = 0;
         
         //         $(this).find('.column').each(function(){
         //             if($(this).height() > highestBox){  
         //                 highestBox = $(this).height();  
         //             }
         //         })
         
         //         $(this).find('.column').height(highestBox);
         //     }); 
         // });
      </script>
      <script>
         function checkMobile(){
          $('.change_number_btn').removeClass('hide');
          $('#pre_phone').attr('disabled',true);
          $('.ajax_message_response').html('');
          var mobile = $('#pre_phone').val();
           $.ajax({
                         url:"{{ url('check_mobile') }}",
                         type:'GET',
         	data : "mobile="+mobile,
                         success:function(data){
                             console.log(data);
         		if(data.error==true){
         			$('.pre_set_btn').addClass('hide');
         			$('.new_login').removeClass('hide');
         			$('.old_login').addClass('hide');
         		}else{
         			$('.pre_set_btn').addClass('hide');
         			$('.new_login').addClass('hide');
         			$('.old_login').removeClass('hide');
         		}
                         }
                 });
         }
         function resetLoginForm(){
          $('.pre_set_btn').removeClass('hide');
          $('.new_login').addClass('hide');
          $('.old_login').addClass('hide');
          $('#pre_phone').removeAttr('disabled',true);
          $('.ajax_message_response').html('');
         }
         function checkLoginDetails(){
          var pre_phone    = $('#pre_phone').val();
          var old_password = $('#old_password').val();
          var login_otp= $('#login_otp').val()
          $.ajax({
                         url:"{{ url('checkLoginDetails') }}",
                         type:'GET',
         	data : "phone="+pre_phone+"&password="+old_password + "&login_otp=" + login_otp,
                         success:function(data){
                             console.log(data);
         		if(data.error==true){
         			$('.ajax_message_response').html(data.message);
         		}else{
         			location.reload();
         			$('.ajax_message_response').html(data.message);
         		}
                         }
                 });
         }
         function proceedtoAddress(){
          $('.delivery_summary').removeClass('hide');
         }
         function proceedToOrderSummary(){
           /* $('.delivery_summary').addClass('hide');
         $('.delivery_address_header').css('background','#ec0000');
         $('.order_summary').removeClass('hide'); */
         updateRegister();
         var gotoNext = true
                 for (var i = 0; i < $('.delivery_summary input').length; i++) {
                     var val = $($('.delivery_summary input')[i]).val().trim();
         console.log(val);  
                     if (!val.length) {
                         $($('.delivery_summary input')[i]).focus();
                         gotoNext = false
                         break;
                     }
         console.log(gotoNext);
                 }
                 if (gotoNext) {
         
                     $('.delivery_summary').addClass('hide');
                     $('.delivery_address_header').css('background', '#ec0000');
                     //$('.order_summary').removeClass('hide');
                 }
         }
         function proceedToPaymentOption(){
            $('.order_summary').addClass('hide');
         $('.order_summary_header').css('background','#ec0000');
         $('.payment_div_summary').removeClass('hide'); 
         }
         function ajaxSignUp(){
          var set_password = $('#set_password').val();
          var new_otp      = $('#new_otp').val();
          var pre_phone    = $('#pre_phone').val();
          $.ajax({
                         url:"{{ url('ajaxSignUp') }}",
                         type:'GET',
         	data : "pre_phone="+pre_phone+"&new_otp="+new_otp+"&set_password="+set_password,
                         success:function(data){
                             console.log(data);
         		if(data.error==true){
         			$('.ajax_message_response').html(data.message);
         		}else{
         			location.reload();
         			$('.ajax_message_response').html(data.message);
         		}
                         }
                });
         }
      </script>
      @yield('footer-script')
   </body>
</html>