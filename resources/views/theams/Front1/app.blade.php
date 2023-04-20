<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title> @yield('title')</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{url(MainAccount::MyUser()->logo)}}" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{url('front_assets/css/plugins/slider-range.css')}}" />
    <link rel="stylesheet" href="{{url('front_assets/css/main.css?v=5.2')}}" />
</head>

<body>
    
    
    <header class="header-area header-style-1 header-height-2">
        <div class="mobile-promotion">
            <span>Grand opening, <strong>up to 15%</strong> off all items. Only <strong>3 days</strong> left</span>
        </div>
        <div class="header-top header-top-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info">
                            <ul>
                                <li><a href="page-about.htlm">About Us</a></li>
                                <li><a href="{{url('our-account')}}">My Account</a></li>
                                <li><a href="{{url('shop-wishlist')}}">Wishlist</a></li>
                                <li><a href="shop-order.html">Order Tracking</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-4">
                        <div class="text-center">
                            <div id="news-flash" class="d-inline-block">
                                <ul>
                                    <li>100% Secure delivery without contacting the courier</li>
                                    <li>Supper Value Deals - Save more with coupons</li>
                                    <li>Trendy 25silver jewelry, save up 35% off today</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info header-info-right">
                            <ul>
                                <li>Need help? Call Us: <strong class="text-brand"> +{{MainAccount::MyUser()->phone}}</strong></li>
                                <li>
                                    <!--
                                    <a class="language-dropdown-active" href="#">English <i class="fi-rs-angle-small-down"></i></a>
                                    <ul class="language-dropdown">
                                        <li>
                                            <a href="#"><img src="{{url('front_assets/imgs/theme/flag-fr.png')}}" alt="" />Français</a>
                                        </li>
                                        <li>
                                            <a href="#"><img src="{{url('front_assets/imgs/theme/flag-dt.png')}}" alt="" />Deutsch</a>
                                        </li>
                                        <li>
                                            <a href="#"><img src="{{url('front_assets/imgs/theme/flag-ru.png')}}" alt="" />Pусский</a>
                                        </li>
                                    </ul> -->
                                </li>
                               
                                    </ul>
                                </li>
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
                        <a href="index.html"><img src="{{url(MainAccount::MyUser()->logo)}}" alt="logo" style="width:70px; min-width:70px;margin-left:15px;" /></a>
                    </div>
                    <div class="header-right">
                        <div class="search-style-2">
                            <form action="{{'Front'}}">
                                <select class="select-active">
                                    <option>All Categories</option>
                                    <option>Milks and Dairies</option>
                                    @foreach (MainAccount::categoryList() as $category)
                                    <option>{{ $category->name }}</option>
                                    @foreach ($category->subCategory as $subCategory)
                                    <option>{{ $subCategory->name }}</option>
                                    @endforeach
                                    @endforeach 
                                </select>
                                <input type="text" name="s" placeholder="Search for items..." />
                            </form>
                        </div>
                        <div class="header-action-right">
                            <div class="header-action-2">
                                <div class="search-location">
                                    <form action="#">
                                        <select class="select-active">
                                            <option>Your Location</option>
                                            <option>Alabama</option>
                                            <option>Alaska</option>
                                            <option>Arizona</option>
                                            <option>Delaware</option>
                                            <option>Florida</option>
                                            <option>Georgia</option>
                                            <option>Hawaii</option>
                                            <option>Indiana</option>
                                            <option>Maryland</option>
                                            <option>Nevada</option>
                                            <option>New Jersey</option>
                                            <option>New Mexico</option>
                                            <option>New York</option>
                                        </select>
                                    </form>
                                </div>
                               
                                <div class="header-action-icon-2">
                                    <a href="{{url('shop-wishlist')}}">
                                        <img class="svgInject" alt="Nest" src="{{url('front_assets/imgs/theme/icons/icon-heart.svg')}}" />
                                        <span class="pro-count blue">{{wishcount()}}</span>
                                    </a>
                                    <a href="{{url('shop-wishlist')}}"><span class="lable">Wishlist</span></a>
                                </div>
                                <div class="header-action-icon-2">
                                    <a class="mini-cart-icon" href="{{url('shop-cart')}}">
                                        <img alt="Nest" src="{{url('front_assets/imgs/theme/icons/icon-cart.svg')}}" />
                                        <span class="pro-count blue">{{count($cartList)}}</span>
                                    </a>

                                    <a href="{{url('shop-cart')}}"><span class="lable">Cart </span></a>
                                    @if(count($cartList)>0)
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                        <ul>
                                        @foreach ($cartList as $item)
                                            <li>
                                                <div class="shopping-cart-img">
                                                    <a href="{{url('product-single-shop/'.$item->sku)}}"><img alt="Nest" src="{{ $item->product->thumbnail }}" /></a>
                                                </div>
                                                <div class="shopping-cart-title">
                                                    <h4><a href="{{url('product-single-shop/'.$item->sku)}}">{{ substr($item->product->title,0,15) }}</a></h4>
                                                    <h4><span>{{$item->qty}} × </span>₹ {{number_format($item->product->selling_price,2)}}</h4>
                                                </div>
                                                <div class="shopping-cart-delete">
                                                    <a href="#"><i class="fi-rs-cross-small"></i></a>
                                                </div>
                                            </li>
                                        @endforeach 
                                        </ul>
                                        <div class="shopping-cart-footer">
                                            <div class="shopping-cart-total">
                                                <h4> <span></span></h4>
                                            </div>
                                            <div class="shopping-cart-button">
                                                <a href="{{url('shop-cart')}}" class="outline">View cart</a>
                                                <a href="{{url('checkOutCart')}}">Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                @if(Session::get('register'))
                                <div class="header-action-icon-2">
                                    <a href="{{url('our-account')}}">
                                        <img class="svgInject" alt="Nest" src="{{url('front_assets/imgs/theme/icons/icon-user.svg')}}" />
                                    </a>
                                    <a href="{{url('our-account')}}"><span class="lable ml-0">{{ Session::get('register')->name}}</span></a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                        <ul>
                                            <li><a href="{{url('our-account')}}"><i class="fi fi-rs-user mr-10"></i>My Account</a></li>
                                            <li><a href="{{url('our-account')}}"><i class="fi fi-rs-location-alt mr-10"></i>Order Tracking</a></li>
                                            <li><a href="{{url('our-account')}}"><i class="fi fi-rs-label mr-10"></i>My Wallet</a></li>
                                            <li><a href="{{url('shop-wishlist')}}"><i class="fi fi-rs-heart mr-10"></i>My Wishlist</a></li>
                                            <li><a href="{{url('our-account')}}"><i class="fi fi-rs-settings-sliders mr-10"></i>Setting</a></li>
                                            <li><a href="{{url('logOutClickok')}}"><i class="fi fi-rs-sign-out mr-10"></i>Sign out</a></li>
                                            
                                          
                                    </div>
                                </div>
                                @else
                                <div class="header-action-icon-2">
                                    <a href="{{url('userlogin')}}">
                                    <i class="fi fi-rs-sign-in mr-10"  style="font-size:20px"></i>
                                    </a>
                                    <a href="{{url('userlogin')}}"><span class="lable ml-0">Login</span></a>
                                   
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">
                    <div class="logo logo-width-1 d-block d-lg-none">
                        <a href="index.html"><img src="{{url(MainAccount::MyUser()->logo)}}" alt="logo" style="width:70px; min-width:70px;margin-left:15px;" /></a>
                    </div>
                    <div class="header-nav d-none d-lg-flex">
                        <div class="main-categori-wrap d-none d-lg-block">
                           
                            <div class="categories-dropdown-wrap categories-dropdown-active-large font-heading">
                                <div class="d-flex categori-dropdown-inner">
                                    <ul>
                                        <li>
                                            <a href="shop-grid-right.html"> <img src="{{url('front_assets/imgs/theme/icons/category-1.svg')}}" alt="" />Milks and Dairies</a>
                                        </li>
                                        <li>
                                            <a href="shop-grid-right.html"> <img src="{{url('front_assets/imgs/theme/icons/category-2.svg')}}" alt="" />Clothing & beauty</a>
                                        </li>
                                        <li>
                                            <a href="shop-grid-right.html"> <img src="{{url('front_assets/imgs/theme/icons/category-3.svg')}}" alt="" />Pet Foods & Toy</a>
                                        </li>
                                        <li>
                                            <a href="shop-grid-right.html"> <img src="{{url('front_assets/imgs/theme/icons/category-4.svg')}}" alt="" />Baking material</a>
                                        </li>
                                        <li>
                                            <a href="shop-grid-right.html"> <img src="{{url('front_assets/imgs/theme/icons/category-5.svg')}}" alt="" />Fresh Fruit</a>
                                        </li>
                                    </ul>
                                    <ul class="end">
                                        <li>
                                            <a href="shop-grid-right.html"> <img src="{{url('front_assets/imgs/theme/icons/category-6.svg')}}" alt="" />Wines & Drinks</a>
                                        </li>
                                        <li>
                                            <a href="shop-grid-right.html"> <img src="{{url('front_assets/imgs/theme/icons/category-7.svg')}}" alt="" />Fresh Seafood</a>
                                        </li>
                                        <li>
                                            <a href="shop-grid-right.html"> <img src="{{url('front_assets/imgs/theme/icons/category-8.svg')}}" alt="" />Fast food</a>
                                        </li>
                                        <li>
                                            <a href="shop-grid-right.html"> <img src="{{url('front_assets/imgs/theme/icons/category-9.svg')}}" alt="" />Vegetables</a>
                                        </li>
                                        <li>
                                            <a href="shop-grid-right.html"> <img src="{{url('front_assets/imgs/theme/icons/category-10.svg')}}" alt="" />Bread and Juice</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="more_slide_open" style="display: none">
                                    <div class="d-flex categori-dropdown-inner">
                                        <ul>
                                            <li>
                                                <a href="shop-grid-right.html"> <img src="{{url('front_assets/imgs/theme/icons/icon-1.svg')}}" alt="" />Milks and Dairies</a>
                                            </li>
                                            <li>
                                                <a href="shop-grid-right.html"> <img src="{{url('front_assets/imgs/theme/icons/icon-2.svg')}}" alt="" />Clothing & beauty</a>
                                            </li>
                                        </ul>
                                        <ul class="end">
                                            <li>
                                                <a href="shop-grid-right.html"> <img src="{{url('front_assets/imgs/theme/icons/icon-3.svg')}}" alt="" />Wines & Drinks</a>
                                            </li>
                                            <li>
                                                <a href="shop-grid-right.html"> <img src="{{url('front_assets/imgs/theme/icons/icon-4.svg')}}" alt="" />Fresh Seafood</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="more_categories"><span class="icon"></span> <span class="heading-sm-1">Show more...</span></div>
                            </div>
                        </div>
                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                            <nav>
                                <ul>
                                    
                                    <li>
                                        <a class="active" href="/">Home </a>
                                       <!-- <ul class="sub-menu">
                                            <li><a href="index.html">Home 1</a></li>
                                            <li><a href="index-2.html">Home 2</a></li>
                                            <li><a href="index-3.html">Home 3</a></li>
                                            <li><a href="index-4.html">Home 4</a></li>
                                            <li><a href="index-5.html">Home 5</a></li>
                                            <li><a href="index-6.html">Home 6</a></li>
                                        </ul> -->
                                    </li>
                                    <li>
                                        <a href="page-about.html">About</a>
                                    </li>
                                    @foreach (MainAccount::categoryList() as $category)
                                    <li>
                                        <a href="{{ url('products-shop/'.$category->id) }}">{{ $category->name }} <i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                           
                                        @foreach ($category->subCategory as $subCategory)   
                                            <li>
                                                <a href="{{ url('products-shop/'.$category->id.'/'.$subCategory->id) }}">{{ $subCategory->name }}  @if(count($subCategory->template)>0) <i class="fi-rs-angle-right"></i> @endif</a>
                                                @if(count($subCategory->template)>0)
                                                <ul class="level-menu">
                                                @foreach ($subCategory->template as $subsubCategory)
                                                    <li><a href="{{ url('products-shop/'.$category->id.'/'.$subCategory->id.'/'.$subsubCategory->template->id) }}">{{ $subsubCategory->template->name }}</a></li>
                                                @endforeach
                                                </ul>
                                                @endif
                                            </li>
                                        @endforeach


                                        </ul>
                                    </li>
                                    @endforeach
                                    <li class="hot-deals"><img src="{{url('front_assets/imgs/theme/icons/icon-hot.svg')}}" alt="hot deals" /><a href="shop-grid-right.html">Deals</a></li>
                                    <!--
                                    <li>
                                        <a href="#">Vendors <i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="vendors-grid.html">Vendors Grid</a></li>
                                            <li><a href="vendors-list.html">Vendors List</a></li>
                                            <li><a href="vendor-details-1.html">Vendor Details 01</a></li>
                                            <li><a href="vendor-details-2.html">Vendor Details 02</a></li>
                                            <li><a href="vendor-dashboard.html">Vendor Dashboard</a></li>
                                            <li><a href="vendor-guide.html">Vendor Guide</a></li>
                                        </ul>
                                    </li> -->
                                    <!--
                                    <li class="position-static">
                                        <a href="#">Mega menu <i class="fi-rs-angle-down"></i></a>
                                        <ul class="mega-menu">
                                            <li class="sub-mega-menu sub-mega-menu-width-22">
                                                <a class="menu-title" href="#">Fruit & Vegetables</a>
                                                <ul>
                                                    <li><a href="{{url('product-single-shop')}}">Meat & Poultry</a></li>
                                                    <li><a href="{{url('product-single-shop')}}">Fresh Vegetables</a></li>
                                                    <li><a href="{{url('product-single-shop')}}">Herbs & Seasonings</a></li>
                                                    <li><a href="{{url('product-single-shop')}}">Cuts & Sprouts</a></li>
                                                    <li><a href="{{url('product-single-shop')}}">Exotic Fruits & Veggies</a></li>
                                                    <li><a href="{{url('product-single-shop')}}">Packaged Produce</a></li>
                                                </ul>
                                            </li>
                                            <li class="sub-mega-menu sub-mega-menu-width-22">
                                                <a class="menu-title" href="#">Breakfast & Dairy</a>
                                                <ul>
                                                    <li><a href="{{url('product-single-shop')}}">Milk & Flavoured Milk</a></li>
                                                    <li><a href="{{url('product-single-shop')}}">Butter and Margarine</a></li>
                                                    <li><a href="{{url('product-single-shop')}}">Eggs Substitutes</a></li>
                                                    <li><a href="{{url('product-single-shop')}}">Marmalades</a></li>
                                                    <li><a href="{{url('product-single-shop')}}">Sour Cream</a></li>
                                                    <li><a href="{{url('product-single-shop')}}">Cheese</a></li>
                                                </ul>
                                            </li>
                                            <li class="sub-mega-menu sub-mega-menu-width-22">
                                                <a class="menu-title" href="#">Meat & Seafood</a>
                                                <ul>
                                                    <li><a href="{{url('product-single-shop')}}">Breakfast Sausage</a></li>
                                                    <li><a href="{{url('product-single-shop')}}">Dinner Sausage</a></li>
                                                    <li><a href="{{url('product-single-shop')}}">Chicken</a></li>
                                                    <li><a href="{{url('product-single-shop')}}">Sliced Deli Meat</a></li>
                                                    <li><a href="{{url('product-single-shop')}}">Wild Caught Fillets</a></li>
                                                    <li><a href="{{url('product-single-shop')}}">Crab and Shellfish</a></li>
                                                </ul>
                                            </li>
                                            <li class="sub-mega-menu sub-mega-menu-width-34">
                                                <div class="menu-banner-wrap">
                                                    <a href="{{url('product-single-shop')}}"><img src="{{url('front_assets/imgs/banner/banner-menu.png')}}" alt="Nest" /></a>
                                                    <div class="menu-banner-content">
                                                        <h4>Hot deals</h4>
                                                        <h3>
                                                            Don't miss<br />
                                                            Trending
                                                        </h3>
                                                        <div class="menu-banner-price">
                                                            <span class="new-price text-success">Save to 50%</span>
                                                        </div>
                                                        <div class="menu-banner-btn">
                                                            <a href="{{url('product-single-shop')}}">Shop now</a>
                                                        </div>
                                                    </div>
                                                    <div class="menu-banner-discount">
                                                        <h3>
                                                            <span>25%</span>
                                                            off
                                                        </h3>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
--
                                    <li>
                                        <a href="blog-category-grid.html">Blog <i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="blog-category-grid.html">Blog Category Grid</a></li>
                                            <li><a href="blog-category-list.html">Blog Category List</a></li>
                                            <li><a href="blog-category-big.html">Blog Category Big</a></li>
                                            <li><a href="blog-category-fullwidth.html">Blog Category Wide</a></li>
                                            <li>
                                                <a href="#">Single Post <i class="fi-rs-angle-right"></i></a>
                                                <ul class="level-menu level-menu-modify">
                                                    <li><a href="blog-post-left.html">Left Sidebar</a></li>
                                                    <li><a href="blog-post-right.html">Right Sidebar</a></li>
                                                    <li><a href="blog-post-fullwidth.html">No Sidebar</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Pages <i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="page-about.html">About Us</a></li>
                                            <li><a href="{{url('our-contact')}}">Contact</a></li>
                                            <li><a href="{{url('our-account')}}">My Account</a></li>
                                            <li><a href="page-login.html">Login</a></li>
                                            <li><a href="page-register.html">Register</a></li>
                                            <li><a href="page-forgot-password.html">Forgot password</a></li>
                                            <li><a href="page-reset-password.html">Reset password</a></li>
                                            <li><a href="page-purchase-guide.html">Purchase Guide</a></li>
                                            <li><a href="page-privacy-policy.html">Privacy Policy</a></li>
                                            <li><a href="page-terms.html">Terms of Service</a></li>
                                            <li><a href="page-404.html">404 Page</a></li>
                                        </ul>
                                    </li>
-->
                                    <li>
                                        <a href="{{url('our-contact')}}">Contact</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="hotline d-none d-lg-flex">
                        <img src="{{url('front_assets/imgs/theme/icons/icon-headphone.svg')}}" alt="hotline" />
                        <p>{{MainAccount::MyUser()->whatsApp}}<span>24/7 Support Center</span></p>
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
                            <div class="header-action-icon-2">
                                <a href="{{url('shop-wishlist')}}">
                                    <img alt="Nest" src="{{url('front_assets/imgs/theme/icons/icon-heart.svg')}}" />
                                    <span class="pro-count white">4</span>
                                </a>
                            </div>
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="shop-cart.html">
                                    <img alt="Nest" src="{{url('front_assets/imgs/theme/icons/icon-cart.svg')}}" />
                                    <span class="pro-count white">2</span>
                                </a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <ul>
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href="{{url('product-single-shop')}}"><img alt="Nest" src="{{url('front_assets/imgs/shop/thumbnail-3.jpg')}}" /></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="{{url('product-single-shop')}}">Plain Striola Shirts</a></h4>
                                                <h3><span>1 × </span>$800.00</h3>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="#"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href="{{url('product-single-shop')}}"><img alt="Nest" src="{{url('front_assets/imgs/shop/thumbnail-4.jpg')}}" /></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="{{url('product-single-shop')}}">Macbook Pro 2022</a></h4>
                                                <h3><span>1 × </span>$3500.00</h3>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="#"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>Total <span>$383.00</span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="shop-cart.html">View cart</a>
                                            <a href="{{url('checkOutCart')}}">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="index.html"><img src="{{url(MainAccount::MyUser()->logo)}}" alt="logo" style="width:70px; min-width:70px;margin-left:15px;" /></a>
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
                    <form action="#">
                        <input type="text" placeholder="Search for items…" />
                        <button type="submit"><i class="fi-rs-search"></i></button>
                    </form>
                </div>
                <div class="mobile-menu-wrap mobile-header-border">
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu font-heading">
                            <li class="menu-item-has-children">
                                <a href="">Home</a>
                               
                            </li>
                            
                              @foreach (MainAccount::categoryList() as $category)
                                    <li>
                                        <a href="{{ url('products-shop/'.$category->id) }}">{{ $category->name }} <i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                           
                                        @foreach ($category->subCategory as $subCategory)   
                                            <li>
                                                <a href="{{ url('products-shop/'.$category->id.'/'.$subCategory->id) }}">{{ $subCategory->name }}  @if(count($subCategory->template)>0) <i class="fi-rs-angle-right"></i> @endif</a>
                                                @if(count($subCategory->template)>0)
                                                <ul class="level-menu">
                                                @foreach ($subCategory->template as $subsubCategory)
                                                    <li><a href="{{ url('products-shop/'.$category->id.'/'.$subCategory->id.'/'.$subsubCategory->template->id) }}">{{ $subsubCategory->template->name }}</a></li>
                                                @endforeach
                                                </ul>
                                                @endif
                                            </li>
                                        @endforeach


                                        </ul>
                                    </li>
                                    @endforeach
                       
                          
                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>
                <div class="mobile-header-info-wrap">
                    <div class="single-mobile-header-info">
                        <a href="{{url('our-contact')}}"><i class="fi-rs-marker"></i> Our location </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="page-login.html"><i class="fi-rs-user"></i>Log In / Sign Up </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="#"><i class="fi-rs-headphones"></i>(+01) - 2345 - 6789 </a>
                    </div>
                </div>
                <div class="mobile-social-icon mb-50">
                    <h6 class="mb-15">Follow Us</h6>
                    <a href="#"><img src="{{url('front_assets/imgs/theme/icons/icon-facebook-white.svg')}}" alt="" /></a>
                    <a href="#"><img src="{{url('front_assets/imgs/theme/icons/icon-twitter-white.svg')}}" alt="" /></a>
                    <a href="#"><img src="{{url('front_assets/imgs/theme/icons/icon-instagram-white.svg')}}" alt="" /></a>
                    <a href="#"><img src="{{url('front_assets/imgs/theme/icons/icon-pinterest-white.svg')}}" alt="" /></a>
                    <a href="#"><img src="{{url('front_assets/imgs/theme/icons/icon-youtube-white.svg')}}" alt="" /></a>
                </div>
                <div class="site-copyright">Copyright 2022 © Nest. All rights reserved. Powered by AliThemes.</div>
            </div>
        </div>
    </div>
    <!--End header-->
  
    @yield('MainSection')
    <footer class="main">
       <!---- component show --->
       <x-home-banner />
        <section class="section-padding footer-mid">
            <div class="container pt-15 pb-20">
                <div class="row">
                    <div class="col">
                        <div class="widget-about font-md mb-md-3 mb-lg-3 mb-xl-0">
                            <div class="logo mb-30">
                                <a href="index.html" class="mb-15"><img src="{{url(MainAccount::MyUser()->logo)}}" alt="logo" /></a>
                                
                            </div>
                           
                        </div>
                    </div>
                    <div class="footer-link-widget col">
                        <h4 class="widget-title">Company</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <li><a href="{{url('About-me')}}">About Us</a></li>
                            <li><a href="{{url('ShippingPrivacy')}}">Shipping</a></li>
                            <li><a href="{{url('OverPrivacy')}}">Privacy Policy</a></li>
                            <li><a href="{{url('TermsConditions')}}">Terms &amp; Conditions</a></li>
                            <li><a href="{{url('ContactUs')}}">Contact Us</a></li>
                            <li><a href="{{url('ReturnsPolicy')}}">Returns Policy</a></li>
                          
                        </ul>
                    </div>
                    <div class="footer-link-widget col">
                        <h4 class="widget-title">Account</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            @if(Session::get('register'))
                            <li><a href="#">Sign out</a></li>
                            @else
                            <li><a href="#">Sign In</a></li>
                            @endif
                           
                            <li><a href="{{url('shop-cart')}}">View Cart</a></li>
                            <li><a href="{{url('shop-wishlist')}}">My Wishlist</a></li>
                           
                            <li><a href="#">Shipping Details</a></li>
                            <li><a href="{{url('OurAccount')}}">Account</a></li>
                          
                        </ul>
                    </div>
                    <div class="footer-link-widget col">
                        <h4 class="widget-title">Address</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">

                                <li><img src="{{url('front_assets/imgs/theme/icons/icon-location.svg')}}" alt="" /><strong>Address: </strong> <span>{{ MainAccount::MyUser()->address}}</span></li>
                                <li><img src="{{url('front_assets/imgs/theme/icons/icon-contact.svg')}}" alt="" /><strong>Call Us: </strong><span>{{ MainAccount::MyUser()->phone}}</span></li>
                                <li><img src="{{url('front_assets/imgs/theme/icons/icon-email-2.svg')}}" alt="" /><strong>Email: </strong><span>{{ MainAccount::MyUser()->email}}</span></li>
                                <li><img src="{{url('front_assets/imgs/theme/icons/icon-clock.svg')}}" alt="" /><strong>Hours: </strong><span>10:00 - 18:00, Mon - Sat</span></li>
                          
                        </ul>
                    </div>
                 

                    <!--
                    <div class="footer-link-widget widget-install-app col">
                        <h4 class="widget-title">Install App</h4>
                        <p class="wow fadeIn animated">From App Store or Google Play</p>
                        <div class="download-app">
                            <a href="#" class="hover-up mb-sm-2 mb-lg-0"><img class="active" src="front_assets/imgs/theme/app-store.jpg" alt="" /></a>
                            <a href="#" class="hover-up mb-sm-2"><img src="front_assets/imgs/theme/google-play.jpg" alt="" /></a>
                        </div>
                        <p class="mb-20">Secured Payment Gateways</p>
                        <img class="wow fadeIn animated" src="front_assets/imgs/theme/payment-method.png" alt="" />
                    </div> -->
                </div>
            </div>
        </section>
        <div class="container pb-30">
            <div class="row align-items-center">
                <div class="col-12 mb-30">
                    <div class="footer-bottom"></div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <p class="font-sm mb-0">&copy; 2022, <strong class="text-brand">XXX</strong> - XXX XXXXXXXXXX <br />All rights reserved</p>
                </div>
                <div class="col-xl-4 col-lg-6 text-center d-none d-xl-block">
                    <div class="hotline d-lg-inline-flex mr-30">
                        <img src="{{url('front_assets/imgs/theme/icons/phone-call.svg')}}" alt="hotline" />
                        <p>{{MainAccount::MyUser()->phone}}<span>Working 8:00 - 22:00</span></p>
                    </div>
                    <div class="hotline d-lg-inline-flex">
                        <img src="{{url('front_assets/imgs/theme/icons/phone-call.svg')}}" alt="hotline" />
                        <p>XXXX <span>24/7 Support Center</span></p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 text-end d-none d-md-block">
                    <div class="mobile-social-icon">
                        <h6>Follow Us</h6>
                        <a href="#"><img src="{{url('front_assets/imgs/theme/icons/icon-facebook-white.svg')}}" alt="" /></a>
                        <a href="#"><img src="{{url('front_assets/imgs/theme/icons/icon-twitter-white.svg')}}" alt="" /></a>
                        <a href="#"><img src="{{url('front_assets/imgs/theme/icons/icon-instagram-white.svg')}}" alt="" /></a>
                        <a href="#"><img src="{{url('front_assets/imgs/theme/icons/icon-pinterest-white.svg')}}" alt="" /></a>
                        <a href="#"><img src="{{url('front_assets/imgs/theme/icons/icon-youtube-white.svg')}}" alt="" /></a>
                    </div>
                    <p class="font-sm">Up to 15% discount on your first subscribe</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <img src="{{url('front_assets/imgs/theme/loading.gif')}}" alt="" />
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor JS-->
    <script src="{{url('front_assets/js/vendor/modernizr-3.6.0.min.js')}}"></script>
    <script src="{{url('front_assets/js/vendor/jquery-3.6.0.min.js')}}"></script>
    <script src="{{url('front_assets/js/vendor/jquery-migrate-3.3.0.min.js')}}"></script>
    <script src="{{url('front_assets/js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('front_assets/js/plugins/slick.js')}}"></script>
    <script src="{{url('front_assets/js/plugins/jquery.syotimer.min.js')}}"></script>
    <script src="{{url('front_assets/js/plugins/wow.js')}}"></script>
    <script src="{{url('front_assets/js/plugins/slider-range.js')}}"></script>
    <script src="{{url('front_assets/js/plugins/perfect-scrollbar.js')}}"></script>
    <script src="{{url('front_assets/js/plugins/magnific-popup.js')}}"></script>
    <script src="{{url('front_assets/js/plugins/select2.min.js')}}"></script>
    <script src="{{url('front_assets/js/plugins/waypoints.js')}}"></script>
    <script src="{{url('front_assets/js/plugins/counterup.js')}}"></script>
    <script src="{{url('front_assets/js/plugins/jquery.countdown.min.js')}}"></script>
    <script src="{{url('front_assets/js/plugins/images-loaded.js')}}"></script>
    <script src="{{url('front_assets/js/plugins/isotope.js')}}"></script>
    <script src="{{url('front_assets/js/plugins/scrollup.js')}}"></script>
    <script src="{{url('front_assets/js/plugins/jquery.vticker-min.js')}}"></script>
    <script src="{{url('front_assets/js/plugins/jquery.theia.sticky.js')}}"></script>
    <script src="{{url('front_assets/js/plugins/jquery.elevatezoom.js')}}"></script>
    <!-- Template  JS -->
    <!-- Template  JS -->
    <script src="{{url('front_assets/js/main.js?v=5.2')}}"></script>
    <script src="{{url('front_assets/js/shop.js?v=5.2')}}"></script>

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
