@extends('FrontEndTheme.Nest.layout.layout')
@section('title', 'Home')
@section('page-content')
<main class="main">
   @if($account->home_page!='3'&&$account->home_page!='4')
   @if($account->home_page==1||$account->home_page==7)
   <section class="home-slider position-relative mb-30">
      <div class="container">
         <div class="home-slide-cover mt-30">
            <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">
               @foreach($slider as $banner) 
			   @if($banner->link)<a href='{{ $banner->link }}'>@endif
               <div class="single-hero-slider single-animation-wrap" style="background-image: url({{ $banner->image }})">
                  <div class="slider-content">
                     <h1 class="display-2 mb-40">
                        {{ $banner->title1 }}
                        {!! ($banner->title2 ? '<br>'.$banner->title2 : '')  !!}
                     </h1>
                  </div>
               </div>
			   @if($banner->link)</a>@endif
               @endforeach 
            </div>
            <div class="slider-arrow hero-slider-1-arrow"></div>
         </div>
      </div>
   </section>
   @elseif($account->home_page==2)
   <section class="home-slider style-2 position-relative mb-50">
      <div class="container">
         <div class="row">
            <div class="col-xl-8 col-lg-12">
               <div class="home-slide-cover">
                  <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">
                     @foreach($slider as $banner)
                     <div class="single-hero-slider single-animation-wrap" style="background-image: url({{ $banner->image }})">
                        <div class="slider-content">
                           <h1 class="display-2 mb-40">
                              {{ $banner->title1 }}
                              {!! ($banner->title2 ? '<br>'.$banner->title2 : '')  !!}
                           </h1>
                        </div>
                     </div>
                     @endforeach
                  </div>
                  <div class="slider-arrow hero-slider-1-arrow"></div>
               </div>
            </div>
            <div class="col-lg-4 d-none d-xl-block">
               <div class="banner-img style-3 animated animated" style='    background: url({{ $home2right->image }}) no-repeat center bottom;background-size: cover;'>
                  <div class="banner-text mt-50">
                     <h2 class="mb-50">
                        {{ $home2right->title }}
                     </h2>
                     @if($home2right->button_text)
                     <a href="{{ $home2right->button_url }}" class="btn btn-xs">{{ $home2right->button_text }}<i class="fi-rs-arrow-small-right"></i></a>
                     @endif
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   @elseif($account->home_page==5)
   <section class="home-slider position-relative mb-30">
      <div class="container">
         <div class="row">
            <div class="col-lg-2 d-none d-lg-flex">
               <div class="categories-dropdown-wrap style-2 font-heading mt-30">
                  <div class="d-flex categori-dropdown-inner">
                     <ul>
                        <li>
                           <a href="#"> <img src="{{ url('assets/imgs/theme/icons/category-1.svg') }}" alt="" />Milks and Dairies</a>
                        </li>
                        <li>
                           <a href="#"> <img src="assets/imgs/theme/icons/category-2.svg" alt="" />Clothing & beauty</a>
                        </li>
                        <li>
                           <a href="#"> <img src="assets/imgs/theme/icons/category-3.svg" alt="" />Pet Foods & Toy</a>
                        </li>
                        <li>
                           <a href="#"> <img src="assets/imgs/theme/icons/category-4.svg" alt="" />Baking material</a>
                        </li>
                        <li>
                           <a href="#"> <img src="assets/imgs/theme/icons/category-5.svg" alt="" />Fresh Fruit</a>
                        </li>
                        <li>
                           <a href="#"> <img src="assets/imgs/theme/icons/category-6.svg" alt="" />Wines & Drinks</a>
                        </li>
                        <li>
                           <a href="#"> <img src="assets/imgs/theme/icons/category-7.svg" alt="" />Fresh Seafood</a>
                        </li>
                        <li>
                           <a href="#"> <img src="assets/imgs/theme/icons/category-8.svg" alt="" />Fast food</a>
                        </li>
                        <li>
                           <a href="#"> <img src="assets/imgs/theme/icons/category-9.svg" alt="" />Vegetables</a>
                        </li>
                        <li>
                           <a href="#"> <img src="assets/imgs/theme/icons/category-10.svg" alt="" />Bread and Juice</a>
                        </li>
                        <li>
                           <a href="#"> <img src="assets/imgs/theme/icons/category-3.svg" alt="" />Pet Foods & Toy</a>
                        </li>
                     </ul>
                  </div>
                  <div class="more_slide_open" style="display: none">
                     <div class="d-flex categori-dropdown-inner">
                        <ul>
                           <li>
                              <a href="#"> <img src="assets/imgs/theme/icons/icon-1.svg" alt="" />Milks and Dairies</a>
                           </li>
                           <li>
                              <a href="#"> <img src="assets/imgs/theme/icons/icon-2.svg" alt="" />Clothing & beauty</a>
                           </li>
                           <li>
                              <a href="#"> <img src="assets/imgs/theme/icons/icon-3.svg" alt="" />Wines & Drinks</a>
                           </li>
                           <li>
                              <a href="#"> <img src="assets/imgs/theme/icons/icon-4.svg" alt="" />Fresh Seafood</a>
                           </li>
                        </ul>
                     </div>
                  </div>
                  <div class="more_categories"><span class="icon"></span> <span class="heading-sm-1">Show more...</span></div>
               </div>
            </div>
            <div class="col-lg-7">
               <div class="home-slide-cover mt-30">
                  <div class="hero-slider-1 style-5 dot-style-1 dot-style-1-position-2">
                     @foreach($slider as $banner)
                     <div class="single-hero-slider single-animation-wrap" style="background-image: url({{ $banner->image }})">
                        <div class="slider-content">
                           <h1 class="display-2 mb-40">
                              {{ $banner->title1 }}
                              {!! ($banner->title2 ? '<br>'.$banner->title2 : '')  !!}
                           </h1>
                        </div>
                     </div>
                     @endforeach
                  </div>
                  <div class="slider-arrow hero-slider-1-arrow"></div>
               </div>
            </div>
            <div class="col-lg-3">
               <div class="row">
                  <div class="col-md-6 col-lg-12">
                     @if($Home5RightUpper)
                     <div class="banner-img style-4 mt-30">
                        <img src="{{ $Home5RightUpper->image }}" alt="" />
                        <div class="banner-text">
                           <h4 class="mb-30">
                              {{ $Home5RightUpper->title }}
                           </h4>
                           @if($Home5RightUpper->button_text)
                           <a href="{{ $home2right->button_url }}" class="btn btn-xs mb-50">{{ $Home5RightUpper->button_text }}<i class="fi-rs-arrow-small-right"></i></a>
                           @endif
                        </div>
                     </div>
                     @endif
                  </div>
                  <div class="col-md-6 col-lg-12">
                     @if($Home5RightBottom)
                     <div class="banner-img style-5 mt-5 mt-md-30">
                        <img src="{{ $Home5RightBottom->image }}" alt="" />
                        <div class="banner-text">
                           <h5 class="mb-20">
                              {{ $Home5RightBottom->title }}
                           </h5>
                           @if($Home5RightBottom->button_text)
                           <a href="{{ $Home5RightBottom->button_url }}" class="btn btn-xs">{{ $Home5RightBottom->button_text }}<i class="fi-rs-arrow-small-right"></i></a>
                           @endif
                        </div>
                     </div>
                     @endif
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   @elseif($account->home_page==6)
   @if($home6)
   <section class="hero-3 position-relative align-items" style="background: url({{ $home6->image }}) no-repeat center center;">
      <h2 class="mb-30 text-center">
         {{ $home6->title1 }}
         {!! ($home6->title2 ? '<br>'.$home6->title2 : '')  !!}
      </h2>
   </section>
   @endif
   @endif
   <!--End hero slider-->
   <!--End category slider-->
   @if($account->home_page!=6)
   <section class="banners mb-25">
      <div class="container">
         <div class="row">
            @foreach($category_banner as $row)
            <div class="col-lg-4 col-md-6">
               <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
                  <img src="{{ $row->image }}" alt="" />
                  <div class="banner-text">
                     <h4>
                        {{ $row->title1 }}
                        {!! ($row->title2 ? '<br>'.$row->title2 : '')  !!}
                        {!! ($row->title3 ? '<br>'.$row->title3 : '')  !!}
                     </h4>
                     @if($row->button_text)
                     <a href="{{ $row->button_url }}" class="btn btn-xs">{{ $row->button_text }} <i class="fi-rs-arrow-small-right"></i></a>
                     @endif
                  </div>
               </div>
            </div>
            @endforeach
         </div>
      </div>
   </section>
   @endif
   <!--End banners-->
   <section class="product-tabs section-padding position-relative">
      <div class="container">
         <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3>Popular Products</h3>
         </div>
         <div class="row product-grid-4">
            @foreach($popular_product as $item)
            <div class="col-lg-3 col-md-4 col-12 col-sm-6">
               <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                  <div class="product-img-action-wrap">
                     <div class="product-img product-img-zoom">
                        <a href="{{ url('/product-detail/'.$item->sku) }}">
                        <img class="default-img" src="{{ asset($item->thumbnail) }}" alt="" />
                        </a>
                     </div>
                  </div>
                  <div class="product-content-wrap">
                     <div class="product-category">
                        <a href="{{ url('/product-detail/'.$item->sku) }}">{{ $item->productName }}</a>
                     </div>
                     <h2><a href="{{ url('/product-detail/'.$item->sku) }}">{{ $item->title }}</a></h2>
                     <div>
                        <span class="font-small text-muted">{{ $item->discount }}% Off</span>
                     </div>
                     <div class="product-card-bottom">
                        <div class="product-price">
                           <span>{{number_format($item->selling_price,2)}}</span>
                           <span class="old-price">{{number_format($item->product_price,2)}}</span>
                        </div>
                        <div class="add-cart">
                           <a class="add" href="{{ url('/product-detail/'.$item->sku) }}"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            @endforeach
            <!--end product card-->
         </div>
         <!--End product-grid-4-->
      </div>
   </section>
   @if($account->home_page==5)
   <section class="section-padding">
      <div class="container">
         <div class="row">
            @foreach($subCategory_banner as $sub_cat)
            <div class="col-lg-3 col-md-6">
               <div class="banner-img style-6 wow animate__animated animate__fadeInUp" data-wow-delay="0">
                  <img src="{{ $sub_cat->image }}" alt="" />
                  <div class="banner-text">
                     <h6 class="mb-10 mt-30">
                        {{ $sub_cat->title1 }}
                        {!! ($sub_cat->title2 ? '<br>'.$sub_cat->title2 : '')  !!}
                        {!! ($sub_cat->title3 ? '<br>'.$sub_cat->title3 : '')  !!}
                     </h6>
                     <p><a href='{{ $sub_cat->button_url }}'>{{ $sub_cat->button_text }}</a></p>
                  </div>
               </div>
            </div>
            @endforeach
         </div>
      </div>
   </section>
   @endif
   <!------------------------------------>
   @if($account->home_page!=6)
   <section class="section-padding pb-5">
      <div class="container">
         <div class="section-title wow animate__animated animate__fadeIn">
            <h3 class="">Daily Best Sells</h3>
         </div>
         <div class="row">
            <div class="col-lg-3 d-none d-lg-flex wow animate__animated animate__fadeIn">
               @if($dailyBestSell)
               <div class="banner-img style-2" style="background: url({{ $dailyBestSell->image }}) no-repeat center bottom;background-size: cover;">
                  <div class="banner-text">
                     <h2 class="mb-100">{{ $dailyBestSell->title }}</h2>
                     @if($dailyBestSell->button_text)
                     <a href="{{ $dailyBestSell->button_url }}" class="btn btn-xs">{{ $dailyBestSell->button_text }}<i class="fi-rs-arrow-small-right"></i></a>
                     @endif
                  </div>
               </div>
               @endif
            </div>
            <div class="col-lg-9 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
               <div class="" >
                  <div class="carausel-4-columns-cover arrow-center position-relative">
                     <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-arrows"></div>
                     <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">
                        @foreach($deals as $item)
                        <div class="product-cart-wrap">
                           <div class="product-img-action-wrap">
                              <div class="product-img product-img-zoom">
                                 <a href="{{ url('/product-detail/'.$item->sku) }}" tabindex="0">
                                 <img class="default-img" src="{{ asset($item->thumbnail) }}" alt="">
                                 <img class="hover-img" src="{{ asset($item->thumbnail) }}" alt="">
                                 </a>
                              </div>
                              <div class="product-action-1">
                                 <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal" tabindex="0"> <i class="fi-rs-eye"></i></a>
                                 <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="{{ url('/product-detail/'.$item->sku) }}" tabindex="0"><i class="fi-rs-heart"></i></a>
                                 <a aria-label="Compare" class="action-btn small hover-up" href="{{ url('/product-detail/'.$item->sku) }}" tabindex="0"><i class="fi-rs-shuffle"></i></a>
                              </div>
                              <div class="product-badges product-badges-position product-badges-mrg">
                                 <span class="hot">Save {{ $item->discount }}%</span>
                              </div>
                           </div>
                           <div class="product-content-wrap">
                              <div class="product-category">
                                 <a href="{{ url('/product-detail/'.$item->sku) }}">{{ $item->title }}</a>
                              </div>
                              <div class="product-rate d-inline-block">
                                 <div class="product-rating" style="width: 80%"></div>
                              </div>
                              <div class="product-price mt-10">
                                 <span>{{number_format($item->selling_price,2)}}</span>
                                 <span class="old-price">{{number_format($item->product_price,2)}}</span>
                              </div>
                              <div class="sold mt-15 mb-15">
                                 <div class="progress mb-5">
                                    <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuemin="0" aria-valuemax="100"></div>
                                 </div>
                                 <span class="font-xs text-heading"> Sold: 90/120</span>
                              </div>
                              <!--a href="shop-cart.html" class="btn w-100 hover-up"><i class="fi-rs-shopping-cart mr-5"></i>Add To Cart</a-->
                           </div>
                        </div>
                        <!--End product Wrap-->
                        @endforeach 
                     </div>
                  </div>
               </div>
               <!--End tab-pane-->
               <!--End tab-content-->
            </div>
            <!--End Col-lg-9-->
         </div>
      </div>
   </section>
   @endif
   <!------------------------------------>
   @if(count($deals_of_the_day))
   <section class="section-padding pb-5">
      <div class="container">
         <div class="section-title wow animate__animated animate__fadeIn" data-wow-delay="0">
            <h3 class="">Deals Of The Day</h3>
            <!--a class="show-all" href="#">
               All Deals
               <i class="fi-rs-angle-right"></i>
               </a-->
         </div>
         <div class="row">
            @foreach($deals_of_the_day as $item)
            <div class="col-xl-3 col-lg-4 col-md-6">
               <div class="product-cart-wrap style-2 wow animate__animated animate__fadeInUp" data-wow-delay="0">
                  <div class="product-img-action-wrap">
                     <div class="product-img">
                        <a href="{{ url('product-detail/'.$item->sku) }}">
                        <img src="{{ $item->image }}" alt="" />
                        </a>
                     </div>
                  </div>
                  <div class="product-content-wrap">
                     <div class="deals-countdown-wrap">
                        <div class="deals-countdown" data-countdown="{{ $item->date }} 00:00:00"></div>
                     </div>
                     <div class="deals-content">
                        <h2><a href="{{ url('product-detail/'.$item->sku) }}">{{ $item->title }}</a></h2>
                        <div class="product-rate-cover">
                           <div class="product-rate d-inline-block">
                              <div class="product-rating" style="width: 90%"></div>
                           </div>
                           <span class="font-small ml-5 text-muted"> (0.0)</span>
                        </div>
                        <div class="product-card-bottom">
                           <div class="product-price">
                              <span>{{ $item->selling_price }}</span>
                              <span class="old-price">{{ $item->product_price }}</span>
                           </div>
                           <div class="add-cart">
                              <!--a class="add" href="{{ url('product-detail/'.$item->sku) }}"><i class="fi-rs-shopping-cart mr-5"></i>Add </a-->
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            @endforeach
         </div>
      </div>
   </section>
   @endif
   @if(count($cartList))
   <section class="product-tabs section-padding position-relative">
      <div class="container">
         <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3>{{ count($cartList) }} in your cart</h3>
         </div>
         <div class="row product-grid-4">
            @php $cart_total = 0; @endphp 
            @foreach($cartList as $item)
            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
               <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                  <div class="product-img-action-wrap">
                     <div class="product-img product-img-zoom">
                        <a href="{{ url('/product-detail/'.$item->product->sku) }}">
                        <img class="default-img" src="{{ asset($item->product->thumbnail) }}" alt="" />
                        </a>
                     </div>
                  </div>
                  <div class="product-content-wrap">
                     <div class="product-category">
                        <a href="{{ url('/product-detail/'.$item->product->sku) }}">{{ $item->product->productName }}</a>
                     </div>
                     <h2><a href="{{ url('/product-detail/'.$item->product->sku) }}">{{ $item->product->title }}</a></h2>
                     
                     <div class="product-card-bottom">
                        <div class="product-price">
                           <span>{{$item->qty}} × {{number_format($item->product->selling_price,2)}}</span>
                           <span class="old-price">{{number_format($item->product->product_price,2)}}</span>
                        </div>
                        <div class="add-cart">
                           <a class="add" href="{{ url('/product-detail/'.$item->product->sku) }}"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            @php $cart_total += $item->qty*$item->product->selling_price; @endphp
            @endforeach
            <!--end product card-->
         </div>
         <div class='row'>
           <div class='col-md-6'><h2>Total <span>{{number_format($cart_total,2)}}</span></h2></div>
           <div class='col-md-6' style='text-align:right'><a class='btn btn-primary' href="{{ url('checkout') }}">Buy Now</a></div>
         </div>
         <!--End product-grid-4-->
      </div>
   </section>
   @endif
   <!------------------------------------>
   <!------------------------------------>
   @else
   <!------------------Home 3 and Home 4-------------------->
   <div class="container mb-30">
      <div class="row flex-row-reverse">
         <div class="col-lg-4-5">
            <section class="home-slider position-relative mb-30">
               <div class="home-slide-cover mt-30">
                  <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">
                     @foreach($slider as $banner) 
					   <div class="single-hero-slider single-animation-wrap" style="background-image: url({{ $banner->image }})">
						  <div class="slider-content">
							 <h1 class="display-2 mb-40">
								{{ $banner->title1 }}
								{!! ($banner->title2 ? '<br>'.$banner->title2 : '')  !!}
							 </h1>
						  </div>
					   </div>
					   @endforeach 
                  </div>
                  <div class="slider-arrow hero-slider-1-arrow"></div>
               </div>
            </section>
            <!--End hero-->
            <section class="product-tabs section-padding position-relative">
      <div class="container">
         <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3>Popular Products</h3>
         </div>
         <div class="row product-grid-4">
            @foreach($popular_product as $item)
            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
               <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                  <div class="product-img-action-wrap">
                     <div class="product-img product-img-zoom">
                        <a href="{{ url('/product-detail/'.$item->sku) }}">
                        <img class="default-img" src="{{ asset($item->thumbnail) }}" alt="" />
                        </a>
                     </div>
                  </div>
                  <div class="product-content-wrap">
                     <div class="product-category">
                        <a href="{{ url('/product-detail/'.$item->sku) }}">{{ $item->productName }}</a>
                     </div>
                     <h2><a href="{{ url('/product-detail/'.$item->sku) }}">{{ $item->title }}</a></h2>
                     <div>
                        <span class="font-small text-muted">{{ $item->discount }}% Off</span>
                     </div>
                     <div class="product-card-bottom">
                        <div class="product-price">
                           <span>{{number_format($item->selling_price,2)}}</span>
                           <span class="old-price">{{number_format($item->product_price,2)}}</span>
                        </div>
                        <div class="add-cart">
                           <a class="add" href="{{ url('/product-detail/'.$item->sku) }}"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            @endforeach
            <!--end product card-->
         </div>
         <!--End product-grid-4-->
      </div>
   </section>
            <!--Products Tabs-->
            @if(count($deals_of_the_day))
   <section class="section-padding pb-5">
      <div class="container">
         <div class="section-title wow animate__animated animate__fadeIn" data-wow-delay="0">
            <h3 class="">Deals Of The Day</h3>
            <!--a class="show-all" href="shop-grid-right.html">
               All Deals
               <i class="fi-rs-angle-right"></i>
               </a-->
         </div>
         <div class="row">
            @foreach($deals_of_the_day as $item)
            <div class="col-xl-3 col-lg-4 col-md-6">
               <div class="product-cart-wrap style-2 wow animate__animated animate__fadeInUp" data-wow-delay="0">
                  <div class="product-img-action-wrap">
                     <div class="product-img">
                        <a href="{{ url('product-detail/'.$item->sku) }}">
                        <img src="{{ $item->image }}" alt="" />
                        </a>
                     </div>
                  </div>
                  <div class="product-content-wrap">
                     <div class="deals-countdown-wrap">
                        <div class="deals-countdown" data-countdown="{{ $item->date }} 00:00:00"></div>
                     </div>
                     <div class="deals-content">
                        <h2><a href="{{ url('product-detail/'.$item->sku) }}">{{ $item->title }}</a></h2>
                        <div class="product-rate-cover">
                           <div class="product-rate d-inline-block">
                              <div class="product-rating" style="width: 90%"></div>
                           </div>
                           <span class="font-small ml-5 text-muted"> (0.0)</span>
                        </div>
                        <div class="product-card-bottom">
                           <div class="product-price">
                              <span>{{ $item->selling_price }}</span>
                              <span class="old-price">{{ $item->product_price }}</span>
                           </div>
                           <div class="add-cart">
                              <!--a class="add" href="{{ url('product-detail/'.$item->sku) }}"><i class="fi-rs-shopping-cart mr-5"></i>Add </a-->
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            @endforeach
         </div>
      </div>
   </section>
   @endif
   <section class="banners mb-25">
      <div class="container">
         <div class="row">
            @foreach($category_banner as $row)
            <div class="col-lg-4 col-md-6">
               <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
                  <img src="{{ $row->image }}" alt="" />
                  <div class="banner-text">
                     <h4>
                        {{ $row->title1 }}
                        {!! ($row->title2 ? '<br>'.$row->title2 : '')  !!}
                        {!! ($row->title3 ? '<br>'.$row->title3 : '')  !!}
                     </h4>
                     <a href="{{ $row->button_url }}" class="btn btn-xs">{{ $row->button_text }} <i class="fi-rs-arrow-small-right"></i></a>
                  </div>
               </div>
            </div>
            @endforeach
         </div>
      </div>
   </section>
            <!--End Deals-->
            <section class="banners">
               <div class="row">
                  <div class="col-lg-4 col-md-6">
                     <div class="banner-img">
                        <img src="assets/imgs/banner/banner-1.png" alt="" />
                        <div class="banner-text">
                           <h4>
                              Everyday Fresh & <br />Clean with Our<br />
                              Products
                           </h4>
                           <a href="shop-grid-right.html" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6">
                     <div class="banner-img">
                        <img src="assets/imgs/banner/banner-2.png" alt="" />
                        <div class="banner-text">
                           <h4>
                              Make your Breakfast<br />
                              Healthy and Easy
                           </h4>
                           <a href="shop-grid-right.html" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4 d-md-none d-lg-flex">
                     <div class="banner-img mb-sm-0">
                        <img src="assets/imgs/banner/banner-3.png" alt="" />
                        <div class="banner-text">
                           <h4>The best Organic <br />Products Online</h4>
                           <a href="shop-grid-right.html" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <!--End banners-->
         </div>
         <div class="col-lg-1-5 primary-sidebar sticky-sidebar pt-30">
            <div class="sidebar-widget widget-category-2 mb-30">
               <h5 class="section-title style-1 mb-30">Category</h5>
               <ul>
                  <li>
                     <a href="shop-grid-right.html"> <img src="assets/imgs/theme/icons/category-1.svg" alt="" />Milks & Dairies</a><span class="count">30</span>
                  </li>
                  <li>
                     <a href="shop-grid-right.html"> <img src="assets/imgs/theme/icons/category-2.svg" alt="" />Clothing</a><span class="count">35</span>
                  </li>
                  <li>
                     <a href="shop-grid-right.html"> <img src="assets/imgs/theme/icons/category-3.svg" alt="" />Pet Foods </a><span class="count">42</span>
                  </li>
                  <li>
                     <a href="shop-grid-right.html"> <img src="assets/imgs/theme/icons/category-4.svg" alt="" />Baking material</a><span class="count">68</span>
                  </li>
                  <li>
                     <a href="shop-grid-right.html"> <img src="assets/imgs/theme/icons/category-5.svg" alt="" />Fresh Fruit</a><span class="count">87</span>
                  </li>
               </ul>
            </div>
            <!-- Fillter By Price -->
            
            <!-- Product sidebar Widget -->
            <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
               <h5 class="section-title style-1 mb-30">New products</h5>
               @foreach($advance_product as $item)
                  <article class="row align-items-center hover-up">
                     <figure class="col-md-4 mb-0">
                        <a href="{{ url('/product-detail/'.$item->sku) }}"><img src="{{ asset($item->thumbnail) }}" alt="" /></a>
                     </figure>
                     <div class="col-md-8 mb-0">
                        <h6>
                           <a href="{{ url('/product-detail/'.$item->sku) }}">{{ $item->title }}</a>
                        </h6>
                        <div class="product-rate-cover">
                           <div class="product-rate d-inline-block">
                              <div class="product-rating" style="width: 90%"></div>
                           </div>
                           <span class="font-small ml-5 text-muted">0</span>
                        </div>
                        <div class="product-price">
                           <span>{{number_format($item->selling_price,2)}}</span>
                           <span class="old-price">{{number_format($item->product_price,2)}}</span>
                        </div>
                     </div>
                  </article>
                  @endforeach
            </div>
			@if($dailyBestSell)
            <div class="banner-img wow fadeIn mb-lg-0 animated d-lg-block d-none">
               <img src="{{ $dailyBestSell->image }}" alt="" />
               <div class="banner-text">
                  <span>Daily Best Sell</span>
                  <h4>
                     {{ $dailyBestSell->title }}
                  </h4>
				  @if($dailyBestSell->button_text)
                     <a href="{{ $dailyBestSell->button_url }}" class="btn btn-xs">{{ $dailyBestSell->button_text }}<i class="fi-rs-arrow-small-right"></i></a>
                  @endif
               </div>
            </div>
			@endif
         </div>
      </div>
   </div>
   <!------------------Home 3 and Home 4-------------------->
   @endif
   <section class="section-padding mb-30">
      <div class="container">
         <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay="0">
               <h4 class="section-title style-1 mb-30 animated animated">Top Selling</h4>
               <div class="product-list-small animated animated">
                  @foreach($advance_product as $item)
                  <article class="row align-items-center hover-up">
                     <figure class="col-md-4 mb-0">
                        <a href="{{ url('/product-detail/'.$item->sku) }}"><img src="{{ asset($item->thumbnail) }}" alt="" /></a>
                     </figure>
                     <div class="col-md-8 mb-0">
                        <h6>
                           <a href="{{ url('/product-detail/'.$item->sku) }}">{{ $item->title }}</a>
                        </h6>
                        <div class="product-rate-cover">
                           <div class="product-rate d-inline-block">
                              <div class="product-rating" style="width: 90%"></div>
                           </div>
                           <span class="font-small ml-5 text-muted">0</span>
                        </div>
                        <div class="product-price">
                           <span>{{number_format($item->selling_price,2)}}</span>
                           <span class="old-price">{{number_format($item->product_price,2)}}</span>
                        </div>
                     </div>
                  </article>
                  @endforeach
               </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
               <h4 class="section-title style-1 mb-30 animated animated">Trending Products</h4>
               <div class="product-list-small animated animated">
                  @foreach($trending as $item)
                  <article class="row align-items-center hover-up">
                     <figure class="col-md-4 mb-0">
                        <a href="{{ url('/product-detail/'.$item->sku) }}"><img src="{{ asset($item->thumbnail) }}" alt="" /></a>
                     </figure>
                     <div class="col-md-8 mb-0">
                        <h6>
                           <a href="{{ url('/product-detail/'.$item->sku) }}">{{ $item->title }}</a>
                        </h6>
                        <div class="product-rate-cover">
                           <div class="product-rate d-inline-block">
                              <div class="product-rating" style="width: 90%"></div>
                           </div>
                           <span class="font-small ml-5 text-muted">0</span>
                        </div>
                        <div class="product-price">
                           <span>{{number_format($item->selling_price,2)}}</span>
                           <span class="old-price">{{number_format($item->product_price,2)}}</span>
                        </div>
                     </div>
                  </article>
                  @endforeach
               </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-lg-block wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
               <h4 class="section-title style-1 mb-30 animated animated">Recently added</h4>
               <div class="product-list-small animated animated">
                  @foreach($advance_product as $item)
                  <article class="row align-items-center hover-up">
                     <figure class="col-md-4 mb-0">
                        <a href="{{ url('/product-detail/'.$item->sku) }}"><img src="{{ asset($item->thumbnail) }}" alt="" /></a>
                     </figure>
                     <div class="col-md-8 mb-0">
                        <h6>
                           <a href="{{ url('/product-detail/'.$item->sku) }}">{{ $item->title }}</a>
                        </h6>
                        <div class="product-rate-cover">
                           <div class="product-rate d-inline-block">
                              <div class="product-rating" style="width: 90%"></div>
                           </div>
                           <span class="font-small ml-5 text-muted">0</span>
                        </div>
                        <div class="product-price">
                           <span>{{number_format($item->selling_price,2)}}</span>
                           <span class="old-price">{{number_format($item->product_price,2)}}</span>
                        </div>
                     </div>
                  </article>
                  @endforeach
               </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-xl-block wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
               <h4 class="section-title style-1 mb-30 animated animated">Recently Viewed</h4>
               <div class="product-list-small animated animated">
                  @if(isset($viewed))
                  @foreach($viewed as $item)
                  <article class="row align-items-center hover-up">
                     <figure class="col-md-4 mb-0">
                        <a href="{{ url('/product-detail/'.$item->sku) }}"><img src="{{ asset($item->thumbnail) }}" alt="" /></a>
                     </figure>
                     <div class="col-md-8 mb-0">
                        <h6>
                           <a href="{{ url('/product-detail/'.$item->sku) }}">{{ $item->title }}</a>
                        </h6>
                        <div class="product-rate-cover">
                           <div class="product-rate d-inline-block">
                              <div class="product-rating" style="width: 90%"></div>
                           </div>
                           <span class="font-small ml-5 text-muted">0</span>
                        </div>
                        <div class="product-price">
                           <span>{{number_format($item->selling_price,2)}}</span>
                           <span class="old-price">{{number_format($item->product_price,2)}}</span>
                        </div>
                     </div>
                  </article>
                  @endforeach
                  @endif
               </div>
            </div>
         </div>
      </div>
   </section>
</main>
@endsection