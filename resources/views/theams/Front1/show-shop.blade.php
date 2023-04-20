@extends('theams/Front1/app') 
@section('title','Manage Product') 

@section('MainSection')
<main class="main">
        <div class="page-header mt-30 mb-50">
            <div class="container">
                
                <div class="archive-header">
                    <div class="row align-items-center">
                        <div class="col-xl-3">
                            <h1 class="mb-15">Snack</h1>
                            <div class="breadcrumb">
                                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                                <span></span> Shop <span></span> Snack
                            </div>
                        </div>
                        <div class="col-xl-9 text-end d-none d-xl-block">
                            <ul class="tags-list">
                                <li class="hover-up">
                                    <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Cabbage</a>
                                </li>
                                <li class="hover-up active">
                                    <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Broccoli</a>
                                </li>
                                <li class="hover-up">
                                    <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Artichoke</a>
                                </li>
                                <li class="hover-up">
                                    <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Celery</a>
                                </li>
                                <li class="hover-up mr-0">
                                    <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Spinach</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="container mb-30">
            <div class="row">
                <div class="col-lg-4-5">
                    <div class="shop-product-fillter">
                        <div class="totall-product">
                            
                        </div>
                        <div class="sort-by-product-area">
                        <div class="sort-by-cover mr-10">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps"></i>Show:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a class="active" href="#">50</a></li>
                                        <li><a href="#">100</a></li>
                                        <li><a href="#">150</a></li>
                                        <li><a href="#">200</a></li>
                                        <li><a href="#">All</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sort-by-cover">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a class="active" href="#">Featured</a></li>
                                        <li><a href="#">Price: Low to High</a></li>
                                        <li><a href="#">Price: High to Low</a></li>
                                        <li><a href="#">Release Date</a></li>
                                       
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row product-grid" id="ecommerce-products" >
                        <!--------------------->
                        
                        <!--end product card-->
                       
                    </div>
                    <!--product grid-->

                    <x-deals-of-the-day />
                    <!--End Deals-->
                </div>
                <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
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
                    {!! Form::open(['route' => 'filterInventory','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
                    {{ csrf_field() }}
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
                                <div class="">
                                @foreach($all_color as $color)
                                    <input class="form-check-input" type="checkbox" name="color[]" id="color_{{$color}}" value="{{ $color }}" />
                                    <label class="form-check-label" for="exampleCheckbox1"><span>{{ $color }}</span></label>
                                    <br />
                                @endforeach
                                </div>
                               
                                <label class="fw-900 mt-15">Brand</label>
                                <div class="">
                                @foreach ($brand as $row)
                                    <input class="form-check-input" type="checkbox" name="Brand[]" value="{{ $row->id }}" />
                                    <label class="form-check-label" for="exampleCheckbox11"><span> {{ $row->name }}</span></label>
                                    <br />
                                @endforeach  
                                </div>
                                @if(isset($setting)&&$setting->additional_attribute!=Null)
                                @foreach( json_decode($setting->additional_attribute)[0] as $key=>$row)
                                <label class="fw-900 mt-15">{{ $row }}</label>
                                @if(json_decode($setting->additional_attribute)[1][$key]=='Checkboxes')

                                <div class="custome-checkbox">
                                    @foreach(explode(',',json_decode($setting->additional_attribute)[2][$key]) as $okey=>$opt)
                                        <input class="form-check-input" type="checkbox" name="checkbox" id='additional_attribute{{ $key.$okey }}' value="{{ $opt }}" />
                                        <label class="form-check-label" for="additional_attribute{{ $key.$okey }}" name="add_filter[sad asds $ {{ $key.$okey }}]"><span>{{ $opt }}</span></label>
                                        <br />
                                    @endforeach  
                                </div>
                                @else
                                <div class="custome-checkbox">
                                <select class='form-control' name="single_add_filter[{{ $row }}]">
										    <option value=''></option> @foreach(explode(',',json_decode($setting->additional_attribute)[2][$key]) as $opt)
											<option>{{ $opt }}</option>
										    @endforeach
										    </select>
											<br>
                                </div>
                                @endif
                                @endforeach
                                @endif
                            </div>
                        </div>
                        @if(isset($_GET['search']))
                    <input type="hidden" value="{{ $_GET['search'] }}" name='search_key' >
                    @endif
                        <input type="hidden" value="{{ $id }}" name="id" >
                        <input type="hidden" value="{{ $sub_id }}" name="sub_id" >
                        <input type="hidden" value="{{ $template_id }}" name="template_id" >
                        <button type="submit" class="read-more">Search</button>
                        {!! Form::close() !!} 
                        <a href="shop-grid-right.html" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i> Fillter</a>
                    </div>
                    <!-- Product sidebar Widget -->
                   <x-new-product />
                    <div class="banner-img wow fadeIn mb-lg-0 animated d-lg-block d-none">
                        <img src="assets/imgs/banner/banner-11.png" alt="" />
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
    </main>
@endsection
@section('footer-script')
<script>
	$("form input,form,select[name=sortby]").change(function() {
			  filterProduct();
	});
	$('#slider-range','.price-filter').click(function(){
		filterProduct();
	});
       function filterProduct(){
			$("#ecommerce-products").html('');
			jQuery.ajax({
				url: "{{ url('filterProducts') }}",
				type: "GET",
				data : $('form').serialize(),
				success: function(data)
					{
					  console.log(data);
					  if(data.length){ 
						  for(var i = 0;i<data.length;i++){
							  $('<div class="col-lg-1-5 col-md-4 col-12 col-sm-6"> <div class="product-cart-wrap mb-30"> <div class="product-img-action-wrap"> <div class="product-img product-img-zoom"> <a href="{{url('product-single-shop') }}/'+data[i].sku+'"> <img class="default-img" src="'+data[i].thumbnail+'" style="object-fit: cover;height: 150px;" alt="" /> <img class="hover-img" src="'+data[i].thumbnail+'" alt="" style="object-fit: cover;height: 150px;" /> </a> </div> <div class="product-action-1"> <a aria-label="Add To Wishlist" class="action-btn" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a> <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a> <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a> </div> <div class="product-badges product-badges-position product-badges-mrg"> <span class="hot">'+data[i].discount+'% Off</span> </div> </div> <div class="product-content-wrap"> <div class="product-category"> <a href="{{url('product-single-shop') }}/'+data[i].sku+'"></a> </div> <h2><a href="{{url('product-single-shop') }}/'+data[i].sku+'">'+data[i].title+'</a></h2> <div></div> <div class="product-card-bottom"> <div class="product-price"> <span>₹'+data[i].selling_price+'</span> <span class="old-price">₹'+data[i].product_price+'</span> </div> <div class="add-cart"> <a class="add" href="{{url('product-single-shop') }}/'+data[i].sku+'"><i class="fi-rs-shopping-cart mr-5"></i>show </a> </div> </div> </div> </div> </div>').appendTo("#ecommerce-products");
						  }
					  }else{
						  $("#ecommerce-products").html('No Product Found');
					  }
					}
				});
		}
		filterProduct();
</script>

@stop