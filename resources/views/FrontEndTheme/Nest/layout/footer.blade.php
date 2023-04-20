<footer class="main">
     @if($auth_home_page_lower_slide)
		 @if($auth_home_page_lower_slide->link) <a href='{{ $auth_home_page_lower_slide->link }}'> @endif
        <section class="newsletter mb-15 wow animate__animated animate__fadeIn">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="position-relative newsletter-inner" style="background: url({{ $auth_home_page_lower_slide->image }}) no-repeat center;background-size: cover;">
                            <div class="newsletter-content">
                                <h2 class="mb-20">
								{{ $auth_home_page_lower_slide->title1 }}
                                @if($auth_home_page_lower_slide->title2)								
								    <br />
                                    {{ $auth_home_page_lower_slide->title2 }}
								@endif
                                </h2>
                                <p class="mb-45">{{ $auth_home_page_lower_slide->sub_title }} </p>
                                <!--form class="form-subcriber d-flex">
                                    <input type="email" placeholder="Your emaill address" />
                                    <button class="btn" type="submit">Subscribe</button>
                                </form-->
                            </div>
                            <!--img src="{{ $auth_home_page_lower_slide->image }}" alt="newsletter" /-->
                        </div>
                    </div>
                </div>
            </div>
        </section>
		@if($auth_home_page_lower_slide->link) </a> @endif
	@endif
        <section class="featured section-padding">
            <div class="container">
                <div class="row">
				    @foreach($auth_banner_footer_slide as $row)
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 mb-md-4 mb-xl-0">
					    @if($row->link) <a href='{{ $row->link }}'> @endif
                        <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay="0">
                            <div class="banner-icon">
                                <img src="{{ $row->icon }}" alt="" />
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title">{{ $row->title }}</h3>
                                <p>{{ $row->subtitle }}</p>
                            </div>
                        </div>
						@if($row->link) </a> @endif
                    </div>
					@endforeach
                    
                </div>
            </div>
        </section>
        
<div class="modal delivery_address_modal" id="deliveryAddressModal">
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
</div>
        <section class="section-padding footer-mid">
            <div class="container pt-15 pb-20">
                <div class="row">
                    <div class="col-md-3 col-sm-12">
					    <h4 class="widget-title">Contact</h4>
                        <div class="widget-about font-md mb-md-3 mb-lg-3 mb-xl-0 wow animate__animated animate__fadeInUp" data-wow-delay="0">
                            <ul class="contact-infor">
                                <li><img src="{{ url('Nest/assets/imgs/theme/icons/icon-location.svg') }}" alt="" /><strong>Address: </strong> <span>{{ $account->address }}</span></li>
                                <li><img src="{{ url('Nest/assets/imgs/theme/icons/icon-contact.svg') }}" alt="" /><strong>Call Us:</strong><span>{{ $account->phone }}</span></li>
                                <li><img src="{{ url('Nest/assets/imgs/theme/icons/icon-email-2.svg') }}" alt="" /><strong>Email:</strong><span>{{ $account->email }}</span></li>
                                <li><img src="{{ url('Nest/assets/imgs/theme/icons/icon-clock.svg') }}" alt="" /><strong>Hours:</strong><span>24*7</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12" >
                        <h4 class="widget-title">Information Link</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <li><a href="{{ url('about') }}">About Us</a></li>
                            <li><a href="{{ url('privacy') }}">Privacy Policy</a></li>
                            <li><a href="{{ url('shipping-policy') }}">Shipping Policy</a></li>
                            <li><a href="{{ url('return-policy') }}">Returns Policy</a></li>
                            
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <h4 class="widget-title">My Account</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <li><a href="{{ url('dashboard') }}">My Account</a></li>
                            <li><a href="{{ url('orders') }}">Order History</a></li>
							@foreach($dynamic_menu as $dynamic_menu_row)
                            <li><a href="#">{{ $dynamic_menu_row->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <h4 class="widget-title">Customer Service</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <li><a href="{{ url('contact') }}">Contact Us</a></li>
                            <li><a href="{{ url('term') }}">Terms & Conditions</a></li>
                        </ul>
                    </div>
                </div>
        </section>
        <div class="container pb-30 wow animate__animated animate__fadeInUp" data-wow-delay="0">
            <div class="row align-items-center">
                <div class="col-12 mb-30">
                    <div class="footer-bottom"></div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <p class="font-sm mb-0">&copy; {{ date('Y') }}, <strong class="text-brand">{{ $account->title }}</strong> <br />All rights reserved</p>
                </div>
                <div class="col-xl-4 col-lg-6 text-center d-none d-xl-block">
                    
                    <div class="hotline d-lg-inline-flex">
                        <img src="{{ url('Nest/assets/imgs/theme/icons/phone-call.svg') }}" alt="hotline" />
                        <p>{{ $account->phone }}<span>24/7 Support Center</span></p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 text-end d-none d-md-block">
                    <div class="mobile-social-icon">
                        <h6>Follow Us</h6>
						@php $socialList = App\Models\SocialMedia::where('account_id' , $account->id)->first() @endphp
						
						@if($socialList && $socialList->facebook)
						<a href="{{$socialList->facebook}}"><img src="{{ url('Nest/assets/imgs/theme/icons/icon-facebook-white.svg') }}" alt="" /></a>
					    @endif
                        @if($socialList && $socialList->twitter)
						<a href="{{$socialList->twitter}}"><img src="{{ url('Nest/assets/imgs/theme/icons/icon-twitter-white.svg') }}" alt="" /></a>
						@endif
						@if($socialList && $socialList->googleplus)
                        
					
					    @endif
                        @if($socialList && $socialList->instagram)
                        <a href="{{$socialList->instagram}}"><img src="{{ url('Nest/assets/imgs/theme/icons/icon-instagram-white.svg') }}" alt="" /></a>
						@endif
                        @if($socialList && $socialList->pinterest)
                        <a href="{{$socialList->pinterest}}"><img src="{{ url('Nest/assets/imgs/theme/icons/icon-pinterest-white.svg') }}" alt="" /></a>
					    @endif
                        @if($socialList && $socialList->youtube)
                        <a href="{{$socialList->youtube}}"><img src="{{ url('Nest/assets/imgs/theme/icons/icon-youtube-white.svg') }}" alt="" /></a>
					    @endif
                    </div>
                    <p class="font-sm">Up to 15% discount on your first subscribe</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Preloader Start -->
    <!--div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <img src="{{ url('Nest/assets/imgs/theme/loading.gif') }}" alt="" />
                </div>
            </div>
        </div>
    </div-->