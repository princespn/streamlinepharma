@php $categoryList = App\Models\Category::where('account_id' , $account->id)->whereNull('ref_id')->whereNull('deleted_at')->get() @endphp
<header class="header-area header-style-1 header-height-2">
        <!--div class="mobile-promotion">
            <span>Grand opening, <strong>up to 15%</strong> off all items. Only <strong>3 days</strong> left</span>
        </div-->
        <div class="header-top header-top-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info">
                            <ul>
                                <li><a href="{{ url('about') }}">About Us</a></li>
                                <li><a href="{{ url('dashboard') }}">My Account</a></li>
                                <li><a href="{{ url('orders') }}">Order Tracking</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-4">
                        <div class='header-info'>
						   @if(Session::get('delivery_location'))
							   <strong>Deliver To  {{ Session::get('delivery_location') }}</strong>
						   <button class='btn btn-danger btn-xs' data-bs-toggle="modal" data-bs-target="#deliveryAddressModal">Change</button>
						   @else
							   <button class='btn btn-danger btn-xs' data-bs-toggle="modal" data-bs-target="#deliveryAddressModal">Enter Pincode</button>
						   @endif
						   <!-------------------->
						   
<!--<div class="modal delivery_address_modal" id="deliveryAddressModal">
  <div class="modal-dialog">
    <div class="modal-content">

      
      <div class="modal-header">
        <h4 class="modal-title">Choose your location</h4>
        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
      </div>


      <div class="modal-body">
	  @if(Session::get('register'))
        @if(isset($loadAddress))
			<h6 style='text-align:center'>Select a delivery location to see product availability and delivery options<br></h6>
			@foreach($loadAddress as $row)
							        <div class="card delivery_address_card">
									  <div class="card-body">
									   <a href="{{ url('set_delivery_location/'.$row->zipCode) }}">
									      <strong style='font-size: 19px;'> {{ $row->name }}</strong><br>
										 {{ $row->landmark }}, {{ $row->cityId }}<br>
										 {{ $row->stateId }}, {{ $row->countryId }}, {{ $row->zipCode }}<br>
										 Mo. {{ $row->phone }} Email {{ $row->email }}
											</a>	 
										 </div>
									</div>
							      @endforeach
								  <br>
								  <a style='display: block;' href="{{ url('checkout') }}" class='btn btn-sm btn-xs'>Add an Address</a><br>
		@endif
		@else
			<a style='display: block;' href="{{ url('login') }}" class='btn btn-sm btn-xs'>Sign in to see your addresses</a>
		@endif
		<div class='a-divider a-divider-break a-spacing-top-base'>
		<hr>
		<h6 style='text-align:center'>or enter an Indian pincode</h6><br>
		<form action="{{ url('set_mannual_pincode') }}">
		  <div class='row'>
		    <div class='col-md-8'>
			  <input type='text' class='form-control' name='pincode'>
			</div>
			<div class='col-md-4'>
			  <button class='btn btn-primary'>Apply</button>
			</div>
		  </div>
		</form>
        </div>
      </div>

      

    </div>
  </div>
</div>-->
<!----------------->
                        </div>    
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info header-info-right">
                            <ul>
                                <li>Need help? Call Us: <strong class="text-brand"> {{ $account->phone }}</strong></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                        <a href="{{ url('/') }}"><img src="{{ url($account->logo) }}" alt="logo" /></a>
                    </div>
                    <div class="header-right">
                        <div class="search-style-2">
                            <form action="{{ url('shop') }}">
                                <select class="select-active">
                                    <option value=''>All Categories</option>
									@foreach ($categoryList as $category)
                                    <option value='{{ url('shop/'.$category->id) }}'>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <input type="text" placeholder="Search for items..." name='search' />
                            </form>
                        </div>
                        <div class="header-action-right">
                            <div class="header-action-2">
                                
                                
                                <div class="header-action-icon-2">
                                    <a class="mini-cart-icon" href="{{ url('cart') }}">
                                        <img alt="Nest" src="{{ url('Nest/assets/imgs/theme/icons/icon-cart.svg') }}" />
                                        <span class="pro-count blue">{{ count($cartList) }}</span>
                                    </a>
                                    <a href="{{ url('/cart') }}"><span class="lable">Cart</span></a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                        <ul>
										@php $cart_total = 0; @endphp
										@foreach ($cartList as $item)
                                            <li>
                                                <div class="shopping-cart-img">
                                                    <a href="{{ url('product-detail/'.$item->product->sku) }}"><img alt="Nest" src="{{ $item->product->thumbnail }}" /></a>
                                                </div>
                                                <div class="shopping-cart-title">
                                                    <h4><a href="shop-product-right.html">{{ substr($item->product->title,0,15) }}</a></h4>
                                                    <h4><span>{{$item->qty}} × </span>{{number_format($item->product->selling_price,2)}}</h4>
                                                </div>
                                                <div class="shopping-cart-delete">
                                                    <a href="#"><i class="fi-rs-cross-small"></i></a>
                                                </div>
                                            </li>
											@php $cart_total += $item->qty*$item->product->selling_price; @endphp
										@endforeach
                                        </ul>
                                        <div class="shopping-cart-footer">
                                            <div class="shopping-cart-total">
                                                <h4>Total <span>{{number_format($cart_total,2)}}</span></h4>
                                            </div>
                                            <div class="shopping-cart-button">
                                                <a href="{{ url('/cart') }}" class="outline">View cart</a>
                                                <a href="{{ url('/checkout') }}">Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="header-action-icon-2">
                                    
									@if(Session::get('register'))
									<a href="page-account.html">
                                        <img class="svgInject" alt="Nest" src="{{ url('Nest/assets/imgs/theme/icons/icon-user.svg') }}" />
                                    </a>
									<a href="{{ url('dashboard') }}"><span class="lable ml-0">Account</span></a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                        <ul>
                                            <li>
                                                <a href="{{ url('dashboard') }}"><i class="fi fi-rs-user mr-10"></i>My Account</a>
                                            </li>
											<li>
                                                <a href="{{ url('wallet') }}"><i class="fi fi-rs-book-alt mr-10"></i>Wallet</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('orders') }}"><i class="fi fi-rs-location-alt mr-10"></i>Order Tracking</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('my-address') }}"><i class="fi fi-rs-label mr-10"></i>Saved Address</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('account-detail') }}"><i class="fi fi-rs-heart mr-10"></i>Account Details</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('logout') }}"><i class="fi fi-rs-heart mr-10"></i>Logout</a>
                                            </li>
                                            
                                        </ul>
                                    </div>
									@else
										<a href="{{ url('login') }}">
                                        <img class="svgInject" alt="Nest" src="{{ url('Nest/assets/imgs/theme/icons/icon-user.svg') }}" />
                                        </a>
									@endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		@if((!isset($categoryIcon)&&$account->home_page=='7')||($account->home_page!='7'))
        <div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">
                    <div class="logo logo-width-1 d-block d-lg-none">
                        <a href="{{ url('/') }}"><img src="{{ url($account->logo) }}" alt="logo" /></a>
                    </div>
                    <div class="header-nav d-none d-lg-flex">
                        
                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                            <nav>
                                <ul>
                                    <li>
                                        <a href="{{ url('/') }}">Home</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('about') }}">About Us</a>
                                    </li>
									<li>
                                        <a href="{{ url('contact') }}">Contact Us</a>
                                    </li>
									
                           
									@foreach($dynamic_menu_auth as $row)
									<li>
									   @if($row->category!=Null)
									     <a href="{{ url('shop/'.$row->category) }}">{{ $row->cat->name }} <i class="fi-rs-angle-down"></i></a>
									     <ul class="sub-menu">
										    @if($row->sub_category!=Null)
												@php $sub = App\Models\DynamicMenu::where('category' , $row->category)->get(); @endphp
												@foreach($sub as $sum_row)
												   <li><a href="{{ url('shop/'.$row->category.'/'.$sum_row->sub_category) }}">{{ $sum_row->sub_cat->name }} <i class="fi-rs-angle-right"></i></a>
													<ul class="level-menu">
													  @php $set = App\Models\DynamicMenu::where('sub_category' , $sum_row->sub_category)->get(); @endphp
														@foreach($sub as $sum_row)
														  <li><a href="{{ url('shop/'.$row->category.'/'.$sum_row->sub_category.'/'.$sum_row->setting) }}">{{ $sum_row->template->name }}</a></li>
														@endforeach
													</ul>
												   </li>
												@endforeach
										    @endif
											@if($row->sub_category==Null)
												@php $sub = App\Models\DynamicMenu::where('category' , $row->category)->whereNull('sub_category')->get(); @endphp
											    
												@foreach($sub as $sum_row)
												     <li><a href="{{ url('shop/'.$row->category.'/0/'.$sum_row->setting) }}">{{ $sum_row->template->name }}</a></li>
												@endforeach
												
											@endif
										 </ul>
								       @endif
									   @if($row->category==Null&&$row->sub_category!=Null)
									     <a href="{{ url('shop/0/'.$row->sub_category) }}">{{ ($row->sub_cat ? $row->sub_cat->name:'') }} <i class="fi-rs-angle-down"></i></a>
									      <ul class="sub-menu">
										    
												  @php $set = App\Models\DynamicMenu::where('sub_category' , $sum_row->sub_category)->get(); @endphp
											        @foreach($sub as $sum_row)
													  <li><a href="{{ url('shop/0/'.$row->sub_category.'/'.$sum_row->setting) }}">{{ $sum_row->template->name }}</a></li>
													@endforeach
										 </ul>
								       @endif
									   @if($row->category==Null&&$row->sub_category==Null&&$row->setting!=Null)
									     <a href="{{ url('shop/0/0/'.$row->setting) }}">{{ ($row->template ? $row->template->name:'') }} </a>
								       @endif
									</li>
									@endforeach
									@if($account->offer_page_title!=Null)
									<li>
                                        <a href="{{ url('offer') }}">{{ $account->offer_page_title }}</a>
                                    </li>	
									@endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="hotline d-none d-lg-flex">
                        <img src="{{ url('Nest/assets/imgs/theme/icons/icon-headphone.svg') }}" alt="hotline" />
                        <p>{{ $account->phone }}<span>24/7 Support Center</span></p>
                    </div>
                    <div class="header-action-icon-2 d-block d-lg-none">
                        <div class="burger-icon burger-icon-white">
                            <span class="burger-icon-top"></span>
                            <span class="burger-icon-mid"></span>
                            <span class="burger-icon-bottom"></span>
                        </div>
                    </div>
                    <div class="header-action-right d-block d-lg-none">
                        <div class="header-action-2">
                            <!--div class="header-action-icon-2">
                                <a href="shop-wishlist.html">
                                    <img alt="Nest" src="{{ url('Nest/assets/imgs/theme/icons/icon-heart.svg') }}" />
                                    <span class="pro-count white">4</span>
                                </a>
                            </div-->
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="#">
                                    <img alt="Nest" src="{{ url('Nest/assets/imgs/theme/icons/icon-cart.svg') }}" />
                                    <span class="pro-count white">{{ count($cartList) }}</span>
                                </a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <ul>
                                        @php $cart_total = 0; @endphp
										@foreach ($cartList as $item)
                                            <li>
                                                <div class="shopping-cart-img">
                                                    <a href="shop-product-right.html"><img alt="Nest" src="{{ $item->product->thumbnail }}" /></a>
                                                </div>
                                                <div class="shopping-cart-title">
                                                    <h4><a href="shop-product-right.html">{{ substr($item->product->title,0,15) }}</a></h4>
                                                    <h4><span>{{$item->qty}} × </span>{{number_format($item->product->selling_price,2)}}</h4>
                                                </div>
                                                <div class="shopping-cart-delete">
                                                    <a href="#"><i class="fi-rs-cross-small"></i></a>
                                                </div>
                                            </li>
											@php $cart_total += $item->qty*$item->product->selling_price; @endphp
										@endforeach
                                    </ul>
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>Total <span>{{number_format($cart_total,2)}}</span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="{{ url('/cart') }}">View cart</a>
                                            <a href="{{ url('/checkout') }}">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		@else
		<div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container-fluid">
			  <div class='row mobile_home_7' style='box-shadow: 0 2px 5px rgb(0 0 0 / 7%);'>
			    <div class='col-2'>
				   <img src='{{ url($account->logo) }}' width='80'>
				</div>
			    <div class='col-8'>
				     <form action="{{ url('shop') }}">
					      <input type="text" style='height: 40px;margin-bottom: 20px;' placeholder="Search for items..." name='search' />
                     </form>
				</div>
				<div class='col-2'>
				   <a class="mini-cart-icon" href="{{ url('cart') }}">
                        <img alt="Nest" style='margin-top:6px' src="{{ url('Nest/assets/imgs/theme/icons/icon-cart.svg') }}" />
                        <span class="pro-count blue">{{ count($cartList) }}</span>
                    </a>
				</div>
			  </div>
			  <div class='row' style='padding:10px'>
			    @foreach($categoryIcon as $icon)
				  <div class='col-3 col-md-1' style='text-align:center;'>
				    <a href='{{ $icon->link }}'>
						<img src='{{ $icon->icon }}' width='120'><br>
						<strong>{{ $icon->title }}</strong>
					</a>
				  </div>
				@endforeach
			  </div>
		    </div>
		</div>
		@endif
    </header>
	<div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="{{ url('/') }}"><img src="{{ url($account->logo) }}" alt="logo" /></a>
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">
                <div class="mobile-search search-style-3 mobile-header-border">
                    <form action="{{ url('shop') }}">
                        <input type="text" placeholder="Search for items…" name='search' />
                        <button type="submit"><i class="fi-rs-search"></i></button>
                    </form>
                </div>
                <div class="mobile-menu-wrap mobile-header-border">
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu font-heading">
                            <li>
                                        <a href="{{ url('/') }}">Home</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('about') }}">About Us</a>
                                    </li>
									<li>
                                        <a href="{{ url('contact') }}">Contact Us</a>
                                    </li>
								{{--	@php $categoryList = App\Models\Category::where('account_id' , $account->id)->whereNull('ref_id')->whereNull('deleted_at')->get() @endphp
                                     @foreach ($categoryList as $category)
                                    <li class='menu-item-has-children'>
                                        <a href="{{ url('shop/'.$category->id) }}">{{ $category->name }} <i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
										@foreach ($category->subCategory as $subCategory)
                                            <li><a href="{{ url('shop/'.$category->id.'/'.$subCategory->id) }}">{{ $subCategory->name }} <i class="fi-rs-angle-right"></i></a>
											
											  <ul class="level-menu">
											  @foreach ($subCategory->template as $subsubCategory)
											  <li><a href="{{ url('shop/'.$category->id.'/'.$subCategory->id.'/'.$subsubCategory->template->id) }}">{{ $subsubCategory->template->name }}</a></li>
											  @endforeach
											  </ul>
											</li> 
										@endforeach
                                        </ul>
                                    </li>
									@endforeach --}}

                                    @foreach($dynamic_menu_auth as $row)
									<li>
									   @if($row->category!=Null)
									     <a href="{{ url('shop/'.$row->category) }}">{{ $row->cat->name }} <i class="fi-rs-angle-down"></i></a>
									     <ul class="sub-menu">
										    @if($row->sub_category!=Null)
												@php $sub = App\Models\DynamicMenu::where('category' , $row->category)->get(); @endphp
												@foreach($sub as $sum_row)
												   <li><a href="{{ url('shop/'.$row->category.'/'.$sum_row->sub_category) }}">{{ $sum_row->sub_cat->name }} <i class="fi-rs-angle-right"></i></a>
													<ul class="level-menu">
													  @php $set = App\Models\DynamicMenu::where('sub_category' , $sum_row->sub_category)->get(); @endphp
														@foreach($sub as $sum_row)
														  <li><a href="{{ url('shop/'.$row->category.'/'.$sum_row->sub_category.'/'.$sum_row->setting) }}">{{ $sum_row->template->name }}</a></li>
														@endforeach
													</ul>
												   </li>
												@endforeach
										    @endif
											@if($row->sub_category==Null)
												@php $sub = App\Models\DynamicMenu::where('category' , $row->category)->whereNull('sub_category')->get(); @endphp
											    
												@foreach($sub as $sum_row)
												     <li><a href="{{ url('shop/'.$row->category.'/0/'.$sum_row->setting) }}">{{ $sum_row->template->name }}</a></li>
												@endforeach
												
											@endif
										 </ul>
								       @endif
									   @if($row->category==Null&&$row->sub_category!=Null)
									     <a href="{{ url('shop/0/'.$row->sub_category) }}">{{ ($row->sub_cat ? $row->sub_cat->name:'') }} <i class="fi-rs-angle-down"></i></a>
									      <ul class="sub-menu">
										    
												  @php $set = App\Models\DynamicMenu::where('sub_category' , $sum_row->sub_category)->get(); @endphp
											        @foreach($sub as $sum_row)
													  <li><a href="{{ url('shop/0/'.$row->sub_category.'/'.$sum_row->setting) }}">{{ $sum_row->template->name }}</a></li>
													@endforeach
										 </ul>
								       @endif
									   @if($row->category==Null&&$row->sub_category==Null&&$row->setting!=Null)
									     <a href="{{ url('shop/0/0/'.$row->setting) }}">{{ ($row->template ? $row->template->name:'') }} </a>
								       @endif
									</li>
									@endforeach
                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>
                
                
               <!-- <div class="mobile-header-info-wrap">
                
                    <div class="single-mobile-header-info">
                        <a href="page-contact.html"><i class="fi-rs-marker"></i> Our location </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="page-login.html"><i class="fi-rs-user"></i>Log In / Sign Up </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="#"><i class="fi-rs-headphones"></i>(+01) - 2345 - 6789 </a>
                    </div>
                </div>-->
                <div class="mobile-social-icon mb-50">
                    <h6 class="mb-15">Follow Us</h6>
                    <a href="#"><img src="{{ url('Nest/assets/imgs/theme/icons/icon-facebook-white.svg') }}" alt="" /></a>
                    <a href="#"><img src="{{ url('Nest/assets/imgs/theme/icons/icon-twitter-white.svg') }}" alt="" /></a>
                    <a href="#"><img src="{{ url('Nest/assets/imgs/theme/icons/icon-instagram-white.svg') }}" alt="" /></a>
                    <a href="#"><img src="{{ url('Nest/assets/imgs/theme/icons/icon-pinterest-white.svg') }}" alt="" /></a>
                    <a href="#"><img src="{{ url('Nest/assets/imgs/theme/icons/icon-youtube-white.svg') }}" alt="" /></a>
                </div>
                <!--<div class="site-copyright">Copyright 2022 © . All rights reserved. Powered by AliThemes.</div>-->
            </div>
        </div>
    </div>