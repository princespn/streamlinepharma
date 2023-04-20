@extends('theams/theam1/layouts.app')

@section('theme1Content')



<!-- Latest Blog -->

    
        <div class="blog-section latest-blog container-fluid">
            <!-- Container -->
            <div class="container">

                <!-- Section Header -->
                <div class="section-header">
                    <h3>{{ $offer_page_title }}</h3>
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
   

@endsection
