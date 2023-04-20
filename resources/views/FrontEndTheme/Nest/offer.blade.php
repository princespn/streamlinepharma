@extends('FrontEndTheme.Nest.layout.layout')
@section('title', $offer_page_title)
@section('page-content')
<main class="main">
        
        <section class="product-tabs section-padding position-relative">
      <div class="container">
         <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3>{{ $offer_page_title }}</h3>
         </div>
         <div class="row product-grid-4">
            @foreach($deals as $item)
            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
               <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                  <div class="product-img-action-wrap">
                     <div class="product-img product-img-zoom">
                        <a href="{{ url('/product-detail/'.$item->buyProduct->sku) }}">
                        <img class="default-img" src="{{ asset($item->buyProduct->thumbnail) }}" alt="" />
                        </a>
                     </div>
                  </div>
                  <div class="product-content-wrap">
                     <div class="product-category">
                        <a href="{{ url('/product-detail/'.$item->buyProduct->sku) }}">{{ $item->buyProduct->productName }}</a>
                     </div>
                     <h2><a href="{{ url('/product-detail/'.$item->buyProduct->sku) }}">{{ $item->buyProduct->title }}</a></h2>
                     <div>
                                              <p style="text-align:center">
												<strong class="offer" style="color:green;margin-top:10px">{{ $item->sceheme->title }}</strong><br><br><span style='color:red'>Get {{ $item->get_qty }} {{ $item->offerProduct->title }}</span> if you buy {{ $item->qty }}
												</p>
                     </div>
                     <div class="product-card-bottom">
                        <div class="product-price">
                           <span>{{number_format($item->buyProduct->selling_price,2)}}</span>
                           <span class="old-price">{{number_format($item->buyProduct->product_price,2)}}</span>
                        </div>
                        <div class="add-cart">
                           <a class="add" href="{{ url('/product-detail/'.$item->buyProduct->sku) }}"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
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
@endsection