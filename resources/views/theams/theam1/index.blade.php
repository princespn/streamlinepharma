@extends('theams/theam1/layouts.app')

@section('theme1Content')



<!-- Slider Section 1 -->

<div id="home-revslider" class="slider-section container-fluid no-padding">

    <!-- START  SLIDER 5.0 -->

    <div id="myCarousel" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->

        <ol class="carousel-indicators">

            @foreach ($sliderList as $key=>$slider)

            <li data-target="#myCarousel" data-slide-to="{{  $key }}" class="{{ $key == 0 ? 'active' : ''}}"></li>

            @endforeach

        </ol>



        <!-- Wrapper for slides -->

        <div class="carousel-inner">



            @foreach ($sliderList as $key=>$slider)



            <div class="item {{ $key == 0 ? 'active' : ''}}">

                <img src="{{ asset($slider->imageURL) }}" style="width:100%;">

            </div>



            @endforeach



        </div>



        <!-- Left and right controls -->

        <a class="left carousel-control" href="#myCarousel" data-slide="prev">

            <span class="glyphicon glyphicon-chevron-left"></span>

            <span class="sr-only">Previous</span>

        </a>

        <a class="right carousel-control" href="#myCarousel" data-slide="next">

            <span class="glyphicon glyphicon-chevron-right"></span>

            <span class="sr-only">Next</span>

        </a>

    </div>

    <!-- END OF SLIDER WRAPPER -->

</div>

<!-- Slider Section 1 /- -->


<!-- Services Section -->

<div class="services-section container-fluid">

    <!-- Container -->

    <div class="container">

        @if($extraServiceList[0]->delivery ?? '')
            <div class="col-md-4 col-sm-4 col-xs-4">

                <div class="srv-box">

                    <i class="icon icon-Truck"></i>

                    <h5>{{$extraServiceList[0]->deliveryTitle}}</h5><i class="icon icon-Dollar"></i>                

                </div>

            </div>
        @endif

        @if($extraServiceList[0]->moneyBack ?? '')
        <div class="col-md-4 col-sm-4 col-xs-4">

            <div class="srv-box">

                <i class="icon icon-Goto"></i>

                <h5>{{$extraServiceList[0]->moneyBackTitle}}</h5><i class="icon icon-Dollars"></i>

            </div>

        </div>
        @endif

        @if($extraServiceList[0]->support ?? '')
        <div class="col-md-4 col-sm-4 col-xs-4">

            <div class="srv-box">

                <i class="icon icon-Headset"></i>

                <h5>{{$extraServiceList[0]->supportTitle}}</h5><i class="icon icon-Timer"></i>

            </div>

        </div>
        @endif

    </div><!-- Container /- -->

</div>

<!-- Services Section /- -->





<!------------------------------------------------------------------->
@if(count($advance_product))
<div class="blog-section latest-blog container-fluid">
            <!-- Container -->
            <div class="container">

                <!-- Section Header -->
                <div class="section-header">
                    <h3>New Arrival</h3>
                    <img src="{{ asset('assets/theam1/images/section-seprator.png') }}" alt="section-seprator" />
                </div>
                <!-- Section Header /- -->
                <div class="row"> 
                @foreach ($advance_product as $item)
                    
                    <div class="col-md-3 col-sm-6 col-xs-6">
                                    <div class="type-post">
                                        <div class="entry-cover" style="text-align: center;">
                                            <a href="{{ url('detail/'.$item->sku) }}">
                                                <img src="{{ asset($item->thumbnail) }}" style="object-fit: cover;height: 300px;">
                                            </a>
                                            <!-- <span class="post-date"><a href="#"><i class="fa fa-calendar-o"></i>june 26</a></span> -->
                                        </div>

                                        <div class="blog-content">
                                            <h3 class="entry-title" style="height: 50px;overflow: hidden;">
                                                <a title="{{ $item->productName }}" href="{{ url('detail/'.$item->sku) }}">
                                                    <span>{{ $item->title }}</span>
                                                </a>
                                            </h3>
                                            

                                            <div class="entry-meta">
                                                <span class="post-like">
                                                    <del>
                                                        <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                        {{number_format($item->product_price,2)}}
                                                    </del>
                                                    &nbsp;
                                                    <b>
                                                        {{ $item->discount }}% Off
                                                    </b>
                                                </span>

                                                <span class="post-admin" style="color: #ec0000;">
                                                    <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                    <b>{{number_format($item->selling_price,2)}}</b>
                                                </span>

                                            </div>
                                            <div class="entry-content">
                                                
												
                                                <a href="{{ url('detail/'.$item->sku) }}" title="Read More" class="read-more">View More<i class="fa fa-long-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                @endforeach
            </div>
            </div>
            <!-- Container /- -->
        </div>
@endif
<!------------------------------------------------------------------->
@if(count($deals))
<div class="blog-section latest-blog container-fluid">
            <!-- Container -->
            <div class="container">

                <!-- Section Header -->
                <div class="section-header">
                    <h3>{{ $account->offer_page_title }}</h3>
                    <img src="{{ asset('assets/theam1/images/section-seprator.png') }}" alt="section-seprator" />
                </div>
                <!-- Section Header /- -->
                <div class="row"> 
                @foreach ($deals as $item)
                    
                    <div class="col-md-3 col-sm-6 col-xs-6">
                                    <div class="type-post">
                                        <div class="entry-cover" style="text-align: center;">
                                            <a href="{{ url('detail/'.$item->buyProduct->sku) }}">
                                                <img src="{{ asset($item->buyProduct->thumbnail) }}" style="object-fit: cover;height: 300px;">
                                            </a>
                                            <!-- <span class="post-date"><a href="#"><i class="fa fa-calendar-o"></i>june 26</a></span> -->
                                        </div>

                                        <div class="blog-content">
                                            <h3 class="entry-title" style="height: 50px;overflow: hidden;">
                                                <a title="{{ $item->buyProduct->productName }}" href="{{ url('detail/'.$item->buyProduct->sku) }}">
                                                    <span>{{ $item->buyProduct->title }}</span>
                                                </a>
                                            </h3>
                                            

                                            <div class="entry-meta">
                                                <span class="post-like">
                                                    <del>
                                                        <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                        {{number_format($item->buyProduct->product_price,2)}}
                                                    </del>
                                                    &nbsp;
                                                    <b>
                                                        {{ $item->buyProduct->discount }}% Off
                                                    </b>
                                                </span>

                                                <span class="post-admin" style="color: #ec0000;">
                                                    <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                    <b>{{number_format($item->buyProduct->selling_price,2)}}</b>
                                                </span>

                                            </div>
                                            <div class="entry-content">
                                                
											<p style="text-align:center">
												<strong class="offer" style="color:green">{{ $item->sceheme->title }}</strong><br><br>Get {{ $item->get_qty }} {{ $item->offerProduct->title }} if you buy {{ $item->qty }}
												</p>


												
                                                <a href="{{ url('detail/'.$item->buyProduct->sku) }}" title="Read More" class="read-more">View More<i class="fa fa-long-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                @endforeach
            </div>
            </div>
            <!-- Container /- -->
        </div>
@endif
<!------------------------------------------------------------------->
<!------------------------------------------------------------------->
@if(count($discount))
<div class="blog-section latest-blog container-fluid">
            <!-- Container -->
            <div class="container">

                <!-- Section Header -->
                <div class="section-header">
                    <h3>High Discount</h3>
                    <img src="{{ asset('assets/theam1/images/section-seprator.png') }}" alt="section-seprator" />
                </div>
                <!-- Section Header /- -->
                <div class="row"> 
                @foreach ($discount as $item)
                    
                    <div class="col-md-3 col-sm-6 col-xs-6">
                                    <div class="type-post">
                                        <div class="entry-cover" style="text-align: center;">
                                            <a href="{{ url('detail/'.$item->sku) }}">
                                                <img src="{{ asset($item->thumbnail) }}" style="object-fit: cover;height: 300px;">
                                            </a>
                                            <!-- <span class="post-date"><a href="#"><i class="fa fa-calendar-o"></i>june 26</a></span> -->
                                        </div>

                                        <div class="blog-content">
                                            <h3 class="entry-title" style="height: 50px;overflow: hidden;">
                                                <a title="{{ $item->productName }}" href="{{ url('detail/'.$item->sku) }}">
                                                    <span>{{ $item->title }}</span>
                                                </a>
                                            </h3>
                                            

                                            <div class="entry-meta">
                                                <span class="post-like">
                                                    <del>
                                                        <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                        {{number_format($item->product_price,2)}}
                                                    </del>
                                                    &nbsp;
                                                    <b>
                                                        {{ $item->discount }}% Off
                                                    </b>
                                                </span>

                                                <span class="post-admin" style="color: #ec0000;">
                                                    <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                    <b>{{number_format($item->selling_price,2)}}</b>
                                                </span>

                                            </div>
                                            <div class="entry-content">
                                                
												
                                                <a href="{{ url('detail/'.$item->sku) }}" title="Read More" class="read-more">View More<i class="fa fa-long-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                @endforeach
            </div>
            </div>
            <!-- Container /- -->
        </div>
@endif
<!------------------------------------------------------------------->
<!------------------------------------------------------------------->
@if(count($trending))
<div class="blog-section latest-blog container-fluid">
            <!-- Container -->
            <div class="container">

                <!-- Section Header -->
                <div class="section-header">
                    <h3>Trending</h3>
                    <img src="{{ asset('assets/theam1/images/section-seprator.png') }}" alt="section-seprator" />
                </div>
                <!-- Section Header /- -->
                <div class="row"> 
                @foreach ($trending as $item)
                    
                    <div class="col-md-3 col-sm-6 col-xs-6">
                                    <div class="type-post">
                                        <div class="entry-cover" style="text-align: center;">
                                            <a href="{{ url('detail/'.$item->sku) }}">
                                                <img src="{{ asset($item->thumbnail) }}" style="object-fit: cover;height: 300px;">
                                            </a>
                                            <!-- <span class="post-date"><a href="#"><i class="fa fa-calendar-o"></i>june 26</a></span> -->
                                        </div>

                                        <div class="blog-content">
                                            <h3 class="entry-title" style="height: 50px;overflow: hidden;">
                                                <a title="{{ $item->productName }}" href="{{ url('detail/'.$item->sku) }}">
                                                    <span>{{ $item->title }}</span>
                                                </a>
                                            </h3>
                                            

                                            <div class="entry-meta">
                                                <span class="post-like">
                                                    <del>
                                                        <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                        {{number_format($item->product_price,2)}}
                                                    </del>
                                                    &nbsp;
                                                    <b>
                                                        {{ $item->discount }}% Off
                                                    </b>
                                                </span>

                                                <span class="post-admin" style="color: #ec0000;">
                                                    <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                    <b>{{number_format($item->selling_price,2)}}</b>
                                                </span>

                                            </div>
                                            <div class="entry-content">
                                                
												
                                                <a href="{{ url('detail/'.$item->sku) }}" title="Read More" class="read-more">View More<i class="fa fa-long-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                @endforeach
            </div>
            </div>
            <!-- Container /- -->
        </div>
@endif
<!------------------------------------------------------------------->
<!------------------------------------------------------------------->
@if(isset($viewed)&&count($viewed))
<div class="blog-section latest-blog container-fluid">
            <!-- Container -->
            <div class="container">

                <!-- Section Header -->
                <div class="section-header">
                    <h3>Recently Viewed</h3>
                    <img src="{{ asset('assets/theam1/images/section-seprator.png') }}" alt="section-seprator" />
                </div>
                <!-- Section Header /- -->
                <div class="row"> 
                @foreach ($viewed as $item)
                    
                    <div class="col-md-3 col-sm-6 col-xs-6">
                                    <div class="type-post">
                                        <div class="entry-cover" style="text-align: center;">
                                            <a href="{{ url('detail/'.$item->sku) }}">
                                                <img src="{{ asset($item->thumbnail) }}" style="object-fit: cover;height: 300px;">
                                            </a>
                                            <!-- <span class="post-date"><a href="#"><i class="fa fa-calendar-o"></i>june 26</a></span> -->
                                        </div>

                                        <div class="blog-content">
                                            <h3 class="entry-title" style="height: 50px;overflow: hidden;">
                                                <a title="{{ $item->productName }}" href="{{ url('detail/'.$item->sku) }}">
                                                    <span>{{ $item->title }}</span>
                                                </a>
                                            </h3>
                                            

                                            <div class="entry-meta">
                                                <span class="post-like">
                                                    <del>
                                                        <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                        {{number_format($item->product_price,2)}}
                                                    </del>
                                                    &nbsp;
                                                    <b>
                                                        {{ $item->discount }}% Off
                                                    </b>
                                                </span>

                                                <span class="post-admin" style="color: #ec0000;">
                                                    <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                                                    <b>{{number_format($item->selling_price,2)}}</b>
                                                </span>

                                            </div>
                                            <div class="entry-content">
                                                
												
                                                <a href="{{ url('detail/'.$item->sku) }}" title="Read More" class="read-more">View More<i class="fa fa-long-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                @endforeach
            </div>
            </div>
            <!-- Container /- -->
        </div>
@endif
<!------------------------------------------------------------------->

@endsection
