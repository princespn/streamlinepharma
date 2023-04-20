@extends('theams/Front1/app') 
@section('title','Product Detail') 


@section('MainSection')
<main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                   
                </div>
            </div>
        </div>
        <div class="container mb-30">
            <div class="row">
                <div class="col-xl-11 col-lg-12 m-auto">
                    <div class="row">
                        <div class="col-xl-9">
                            <div class="product-detail accordion-detail">
                                <div class="row mb-50 mt-30">
                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                                        <div class="detail-gallery">
                                            <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                            <!-- MAIN SLIDES -->
                                           


                                            <div class="product-image-slider">
                                                @if($advance_product->thumbnail)
                                                <figure class="border-radius-10">
                                                    <img src="{{ asset($advance_product->thumbnail) }}" alt="product image8888" />
                                                </figure>
                                                @endif
                                                @if($advance_product->image1)
                                                <figure class="border-radius-10">
                                                    <img src="{{ asset($advance_product->image1) }}" alt="product image" />
                                                </figure>
                                                @endif
                                                @if($advance_product->image2)
                                                <figure class="border-radius-10">
                                                    <img src="{{ asset($advance_product->image2) }}" alt="product image" />
                                                </figure>
                                                @endif
                                                @if($advance_product->image3)
                                                <figure class="border-radius-10">
                                                    <img src="{{ asset($advance_product->image3) }}" alt="product image" />
                                                </figure>
                                                @endif
                                                @if($advance_product->image4)
                                                <figure class="border-radius-10">
                                                    <img src="{{ asset($advance_product->image4) }}" alt="product image" />
                                                </figure>
                                                @endif
                                                @if($advance_product->image5)
                                                <figure class="border-radius-10">
                                                    <img src="{{ asset($advance_product->image5) }}" alt="product image" />
                                                </figure>
                                                @endif
                                                
                                               
                                            </div>
                                            <!-- THUMBNAILS -->
                                            <div class="slider-nav-thumbnails">
                                           
                                                @if($advance_product->thumbnail)
                                                <div><img src="{{ asset($advance_product->thumbnail) }}" alt="product image" /></div>
                                                @endif
                                                @if($advance_product->image1)
                                                <div><img src="{{ asset($advance_product->image1) }}" alt="product image" /></div>
                                                @endif
                                                @if($advance_product->image2)
                                                <div><img src="{{ asset($advance_product->image2) }}" alt="product image" /></div>
                                                @endif
                                                @if($advance_product->image3)

                                                <div><img src="{{ asset($advance_product->image3) }}" alt="product image" /></div>
                                                @endif
                                                @if($advance_product->image4)
                                                <div><img src="{{ asset($advance_product->image4) }}" alt="product image" /></div>
                                                @endif
                                                @if($advance_product->image5)
                                                <div><img src="{{ asset($advance_product->image5) }}" alt="product image" /></div>
                                                @endif
                                               
                                               
                                            </div>
                                        </div>
                                        <!-- End Gallery -->
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="detail-info pr-30 pl-30">
                                        @if($advance_product->unit_quanitity>0) <span class="stock-status in-stock"> in stock </span> @else <span class="stock-status out-stock"> out stock </span>  @endif
     
                                            <h2 class="title-detail">{{$advance_product->title}}</h2>
                                            <div class="product-detail-rating">
                                                <div class="product-rate-cover text-end">
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating" style="width: 90%"></div>
                                                    </div>
                                                    <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                                </div>

                                            </div>
                     @php
                    $offPerchantage = round(($advance_product->product_price - $advance_product->selling_price) * 100 / $advance_product->product_price)
                    @endphp
                                            <div class="clearfix product-price-cover">
                                                <div class="product-price primary-color float-left">

                                                    <h3 class="product_title" style="color: #ec0000; @if((Session::get('register')&&Session::get('register')->subscription_id!=Null) || isset($scheme)&&$scheme) text-decoration: line-through  @endif ">Rs
                        <span id="productSprice">
                           {{ number_format($advance_product->selling_price,2) }}
                           {{ $advance_product->tax_method == 'Exclusive' ? '+ Tax' : '' }}
                           {{ $advance_product->shipping_method == 'Exclusive' ? '+ Shipping Charge' : '' }}
                        </span>
                    </h3>
					@if(isset($scheme)&&$scheme)
					<div class='blink'>{{ $scheme->scheme_name }} Price : <span>{{ $advance_product->selling_price- $advance_product->selling_price*($scheme->discount/100) }}</span></div>
				    <h3>Please add only this product in cart and at checkout time.</h3>
					@endif
                                                    <span>
                                                        <span class="save-price font-md color3 ml-15">{{$offPerchantage}} % Off</span>
                                                        <span class="old-price font-md ml-15">${{number_format($advance_product->product_price,2)}}</span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="short-desc mb-30">
                                            
                                            <p>
                                                <i class="fa fa-circle"></i>
                                                Return : {{ $advance_product->is_return == 'Yes' ? 'Yes within '.$advance_product->return_days.' days' : 'No' }}
                                            </p>

                                            <p>
                                                <i class="fa fa-circle"></i>
                                                Replacement : {{ $advance_product->is_replace == 'Yes' ? 'Yes within '.$advance_product->replace_days.' days' : 'No' }}
                                            </p>
                                            </div>
                                            <div class="attr-detail attr-size mb-30">
                                                <strong class="mr-10">Size / Weight: </strong>
                                                <ul class="list-filter size-filter font-small">
                                                    <!--
                                                    <li><a href="#">50g</a></li>
                                                    <li class="active"><a href="#">60g</a></li>
                                                    <li><a href="#">80g</a></li>
                                                    <li><a href="#">100g</a></li>
                                                    <li><a href="#">150g</a></li>
                                                    -->
                                                </ul>
                                            </div>
                                            <div class="detail-extralink mb-50">
                                                <div class="detail-qty border radius">
                                                    <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                                    <input type="text" name="quantity" class="qty-val" value="1" min="1">
                                                    <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                                </div>
                                                <div class="product-extra-link2">
                                                    <button type="button" onclick="addToCartAdvance(false @if(isset($scheme)&&$scheme) ,{{ $scheme->id }} @endif) " id="addToCartButton" class="button button-add-to-cart"><i class="fi-rs-shopping-cart"></i>Add to cart</button>
                                                    <a aria-label="Add To Wishlist" class="action-btn hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                                    <a aria-label="Compare" class="action-btn hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                                </div>
                                            </div>
                                            <div class="font-xs">
                                                <ul class="mr-50 float-start">
                                                    <!--
                                                    <li class="mb-5">Type: <span class="text-brand">Organic</span></li>
                                                    <li class="mb-5">MFG:<span class="text-brand"> Jun 4.2022</span></li>
                                                    <li>LIFE: <span class="text-brand">70 days</span></li>
                                                    --->
                                                </ul>
                                                <ul class="float-start">
                                                    <li class="mb-5">SKU: <a href="#">{{$advance_product->sku}}</a></li>
                                                <!--
                                                    <li class="mb-5">Tags: <a href="#" rel="tag">Snack</a>, <a href="#" rel="tag">Organic</a>, <a href="#" rel="tag">Brown</a></li>
                                                    <li>Stock:<span class="in-stock text-brand ml-5">8 Items In Stock</span></li>
                                                -->
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- Detail Info -->
                                    </div>
                                </div>
                                <div class="product-info">
                                    <div class="tab-style3">
                                        <ul class="nav nav-tabs text-uppercase">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab" href="#Additional-info">Additional info</a>
                                            </li>
                                           
                                            <li class="nav-item">
                                                <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Reviews (0)</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content shop_info_tab entry-main-content">
                                            <div class="tab-pane fade show active" id="Description">
                                                <div class="">
                                                {!! nl2br($advance_product->description) !!}
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="Additional-info">
                                                <table class="font-md">
                                                    <tbody>
                                                        <tr class="stand-up">
                                                            <th>Stand Up</th>
                                                            <td>
                                                                <p></p>
                                                            </td>
                                                        </tr>
                                    
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="tab-pane fade" id="Vendor-info">
                                                <!--
                                                <div class="vendor-logo d-flex mb-30">
                                                    <img src="{{url('front_assets/imgs/vendor/vendor-18.svg')}}" alt="" />
                                                    <div class="vendor-name ml-15">
                                                        <h6>
                                                            <a href="vendor-details-2.html">Noodles Co.</a>
                                                        </h6>
                                                        <div class="product-rate-cover text-end">
                                                            <div class="product-rate d-inline-block">
                                                                <div class="product-rating" style="width: 90%"></div>
                                                            </div>
                                                            <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul class="contact-infor mb-50">
                                                    <li><img src="{{url('front_assets/imgs/theme/icons/icon-location.svg')}}" alt="" /><strong>Address: </strong> <span>5171 W Campbell Ave undefined Kent, Utah 53127 United States</span></li>
                                                    <li><img src="{{url('front_assets/imgs/theme/icons/icon-contact.svg')}}" alt="" /><strong>Contact Seller:</strong><span>(+91) - 540-025-553</span></li>
                                                </ul>
                                                <div class="d-flex mb-55">
                                                    <div class="mr-30">
                                                        <p class="text-brand font-xs">Rating</p>
                                                        <h4 class="mb-0">92%</h4>
                                                    </div>
                                                    <div class="mr-30">
                                                        <p class="text-brand font-xs">Ship on time</p>
                                                        <h4 class="mb-0">100%</h4>
                                                    </div>
                                                    <div>
                                                        <p class="text-brand font-xs">Chat response</p>
                                                        <h4 class="mb-0">89%</h4>
                                                    </div>
                                                </div>
                                                <p>
                                                    Noodles & Company is an American fast-casual restaurant that offers international and American noodle dishes and pasta in addition to soups and salads. Noodles & Company was founded in 1995 by Aaron Kennedy and is headquartered in Broomfield, Colorado. The company went public in 2013 and recorded a $457 million revenue in 2017.In late 2018, there were 460 Noodles & Company locations across 29 states and Washington, D.C.
                                                </p>
-->
                                            </div>
                                            <div class="tab-pane fade" id="Reviews">
                                                <!--Comments-->
                                                <div class="comments-area">
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <h4 class="mb-30">Customer questions & answers</h4>
                                                            <div class="comment-list">
                                                               <!-- <div class="single-comment justify-content-between d-flex mb-30">
                                                                    <div class="user justify-content-between d-flex">
                                                                        <div class="thumb text-center">
                                                                            <img src="{{url('front_assets/imgs/blog/author-2.png')}}" alt="" />
                                                                            <a href="#" class="font-heading text-brand">Sienna</a>
                                                                        </div>
                                                                        <div class="desc">
                                                                            <div class="d-flex justify-content-between mb-10">
                                                                                <div class="d-flex align-items-center">
                                                                                    <span class="font-xs text-muted">December 4, 2022 at 3:12 pm </span>
                                                                                </div>
                                                                                <div class="product-rate d-inline-block">
                                                                                    <div class="product-rating" style="width: 100%"></div>
                                                                                </div>
                                                                            </div>
                                                                            <p class="mb-10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, suscipit exercitationem accusantium obcaecati quos voluptate nesciunt facilis itaque modi commodi dignissimos sequi repudiandae minus ab deleniti totam officia id incidunt? <a href="#" class="reply">Reply</a></p>
                                                                        </div>
                                                                    </div>
                                                                </div> -

                                                                <div class="single-comment justify-content-between d-flex mb-30 ml-30">
                                                                    <div class="user justify-content-between d-flex">
                                                                        <div class="thumb text-center">
                                                                            <img src="{{url('front_assets/imgs/blog/author-3.png')}}" alt="" />
                                                                            <a href="#" class="font-heading text-brand">Brenna</a>
                                                                        </div>
                                                                        <div class="desc">
                                                                            <div class="d-flex justify-content-between mb-10">
                                                                                <div class="d-flex align-items-center">
                                                                                    <span class="font-xs text-muted">December 4, 2022 at 3:12 pm </span>
                                                                                </div>
                                                                                <div class="product-rate d-inline-block">
                                                                                    <div class="product-rating" style="width: 80%"></div>
                                                                                </div>
                                                                            </div>
                                                                            <p class="mb-10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, suscipit exercitationem accusantium obcaecati quos voluptate nesciunt facilis itaque modi commodi dignissimos sequi repudiandae minus ab deleniti totam officia id incidunt? <a href="#" class="reply">Reply</a></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="single-comment justify-content-between d-flex">
                                                                    <div class="user justify-content-between d-flex">
                                                                        <div class="thumb text-center">
                                                                            <img src="{{url('front_assets/imgs/blog/author-4.png')}}" alt="" />
                                                                            <a href="#" class="font-heading text-brand">Gemma</a>
                                                                        </div>
                                                                        <div class="desc">
                                                                            <div class="d-flex justify-content-between mb-10">
                                                                                <div class="d-flex align-items-center">
                                                                                    <span class="font-xs text-muted">December 4, 2022 at 3:12 pm </span>
                                                                                </div>
                                                                                <div class="product-rate d-inline-block">
                                                                                    <div class="product-rating" style="width: 80%"></div>
                                                                                </div>
                                                                            </div>
                                                                            <p class="mb-10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, suscipit exercitationem accusantium obcaecati quos voluptate nesciunt facilis itaque modi commodi dignissimos sequi repudiandae minus ab deleniti totam officia id incidunt? <a href="#" class="reply">Reply</a></p>
                                                                        </div>
                                                                    </div>
                                                                </div>-->
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <!--
                                                            <h4 class="mb-30">Customer reviews</h4>
                                                            <div class="d-flex mb-30">
                                                                <div class="product-rate d-inline-block mr-15">
                                                                    <div class="product-rating" style="width: 90%"></div>
                                                                </div>
                                                                <h6>4.8 out of 5</h6>
                                                            </div>
                                                            <div class="progress">
                                                                <span>5 star</span>
                                                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                                                            </div>
                                                            <div class="progress">
                                                                <span>4 star</span>
                                                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                                            </div>
                                                            <div class="progress">
                                                                <span>3 star</span>
                                                                <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%</div>
                                                            </div>
                                                            <div class="progress">
                                                                <span>2 star</span>
                                                                <div class="progress-bar" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">65%</div>
                                                            </div>
                                                            <div class="progress mb-30">
                                                                <span>1 star</span>
                                                                <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
                                                            </div>
                                                            <a href="#" class="font-xs text-muted">How are ratings calculated?</a>
-->
                                                        </div>

                                                    </div>
                                                </div>
                                                <!--comment form-->
                                                <div class="comment-form">
                                                    <h4 class="mb-15">Add a review</h4>
                                                    <div class="product-rate d-inline-block mb-30"></div>
                                                    <div class="row">
                                                        <div class="col-lg-8 col-md-12">
                                                            <form class="form-contact comment_form" action="#" id="commentForm">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <input class="form-control" name="name" id="name" type="text" placeholder="Name" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <input class="form-control" name="email" id="email" type="email" placeholder="Email" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <input class="form-control" name="website" id="website" type="text" placeholder="Website" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <button type="submit" class="button button-contactForm">Submit Review</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-60">
                                    <div class="col-12">
                                        <h2 class="section-title style-1 mb-30">Related products</h2>
                                    </div>
                                    <div class="col-12">
                                        <div class="row related-products">
                                            @foreach($Relatedproducts as $key=> $Relatedproducts) 
                                            <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                                <div class="product-cart-wrap hover-up">
                                                    <div class="product-img-action-wrap">
                                                        <div class="product-img product-img-zoom">
                                                            <a href="{{url('product-single-shop/'.$Relatedproducts->sku)}}" tabindex="0">
                                                                <img class="default-img" src="{{ asset($Relatedproducts->thumbnail) }}" style="object-fit: cover;height: 200px;" alt="" />
                                                                <img class="hover-img" src="{{ asset($Relatedproducts->thumbnail) }}" style="object-fit: cover;height: 200px;" alt="" />
                                                            </a>
                                                        </div>
                                                        <div class="product-action-1">
                                                            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-search"></i></a>
                                                            <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html" tabindex="0"><i class="fi-rs-heart"></i></a>
                                                            <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html" tabindex="0"><i class="fi-rs-shuffle"></i></a>
                                                        </div>
                                                        <div class="product-badges product-badges-position product-badges-mrg">
                                                            <span class="hot">{{ $Relatedproducts->discount }}% Off</span>
                                                        </div>
                                                    </div>
                                                    <div class="product-content-wrap">
                                                        <h2><a href="{{url('product-single-shop/'.$Relatedproducts->sku)}}" tabindex="0">{{ $Relatedproducts->title }}</a></h2>
                                                        {!! ProductRating($Relatedproducts->id) !!}
                                                        <div class="product-price">
                                                            <span>₹{{number_format($Relatedproducts->product_price,2)}}</span>
                                                            <span class="old-price">₹{{number_format($Relatedproducts->selling_price,2)}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 primary-sidebar sticky-sidebar mt-30">
                            <div class="sidebar-widget widget-category-2 mb-30">
                                <h5 class="section-title style-1 mb-30">Category</h5>
                                <ul>
                                    <li>
                                        <a href="shop-grid-right.html"> <img src="{{url('front_assets/imgs/theme/icons/category-1.svg')}}" alt="" />Milks & Dairies</a><span class="count">30</span>
                                    </li>
                                    <li>
                                        <a href="shop-grid-right.html"> <img src="{{url('front_assets/imgs/theme/icons/category-2.svg')}}" alt="" />Clothing</a><span class="count">35</span>
                                    </li>
                                    <li>
                                        <a href="shop-grid-right.html"> <img src="{{url('front_assets/imgs/theme/icons/category-3.svg')}}" alt="" />Pet Foods </a><span class="count">42</span>
                                    </li>
                                    <li>
                                        <a href="shop-grid-right.html"> <img src="{{url('front_assets/imgs/theme/icons/category-4.svg')}}" alt="" />Baking material</a><span class="count">68</span>
                                    </li>
                                    <li>
                                        <a href="shop-grid-right.html"> <img src="{{url('front_assets/imgs/theme/icons/category-5.svg')}}" alt="" />Fresh Fruit</a><span class="count">87</span>
                                    </li>
                                </ul>
                            </div>
                            <!-- Fillter By Price -->
                            <div class="sidebar-widget price_range range mb-30">
                                <h5 class="section-title style-1 mb-30">Fill by price</h5>
                                <div class="price-filter">
                                    <div class="price-filter-inner">
                                        <div id="slider-range" class="mb-20"></div>
                                        <div class="d-flex justify-content-between">
                                            <div class="caption">From: <strong id="slider-range-value1" class="text-brand"></strong></div>
                                            <div class="caption">To: <strong id="slider-range-value2" class="text-brand"></strong></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group">
                                    <div class="list-group-item mb-10 mt-10">
                                        <label class="fw-900">Color</label>
                                        <div class="custome-checkbox">
                                            <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="" />
                                            <label class="form-check-label" for="exampleCheckbox1"><span>Red (56)</span></label>
                                            <br />
                                            <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox2" value="" />
                                            <label class="form-check-label" for="exampleCheckbox2"><span>Green (78)</span></label>
                                            <br />
                                            <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox3" value="" />
                                            <label class="form-check-label" for="exampleCheckbox3"><span>Blue (54)</span></label>
                                        </div>
                                        <label class="fw-900 mt-15">Item Condition</label>
                                        <div class="custome-checkbox">
                                            <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox11" value="" />
                                            <label class="form-check-label" for="exampleCheckbox11"><span>New (1506)</span></label>
                                            <br />
                                            <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox21" value="" />
                                            <label class="form-check-label" for="exampleCheckbox21"><span>Refurbished (27)</span></label>
                                            <br />
                                            <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox31" value="" />
                                            <label class="form-check-label" for="exampleCheckbox31"><span>Used (45)</span></label>
                                        </div>
                                    </div>
                                </div>
                                <a href="shop-grid-right.html" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i> Fillter</a>
                            </div>
                            <!-- Product sidebar Widget -->
                            <x-new-product />
                            <div class="banner-img wow fadeIn mb-lg-0 animated d-lg-block d-none">
                                <img src="{{url('front_assets/imgs/banner/banner-11.png')}}" alt="" />
                                <div class="banner-text">
                                    <span>Oganic</span>
                                    <h4>
                                        Save 17% <br />
                                        on <span class="text-brand">Oganic</span><br />
                                        Juice
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
       function addToCartAdvance(isBuyNow=false,scheme_id='') {
		//alert(isBuyNow+'/'+scheme_id);
        var sku = '{{ $advance_product->sku }}';
	    var csrfToken= '{{ csrf_token() }}';
        const param = { "sku":sku,"scheme_id":scheme_id };
		jQuery.ajax({
			url: "{{ url('addToCartAdvance') }}",
			type: "POST",
			headers: {
				'X-CSRF-TOKEN':csrfToken,
				'Accept' : 'application/json',
				'Content-Type' : 'application/json'
			},
			data: JSON.stringify({data : param}),
			success: function(data)
			{
				jQuery('#cartMSG').replaceWith('<h3 id="cartMSG">'+data+'</h3>');
				//console.log(isBuyNow);
				setTimeout(function() {
					$('#cartMSG').fadeOut("slow");
				}, 1000);
				if(isBuyNow==false){
					location.reload();
				}else{
					window.location.replace("{{ url('checkOut') }}");
				}
				//cartList();
			}
		});
    }
</script>
@endsection