@extends('theams/theam1/layouts.app')
@section('theme1Content')
<!-- Latest Blog -->
<div class="blog-section latest-blog container-fluid">
   <!-- Container -->
   <div class="container">
      <!-- Section Header -->
      <div class="section-header">
         <h3>Advance Product</h3>
         <img src="{{ asset('assets/theam1/images/section-seprator.png') }}" alt="section-seprator" />
      </div>
      <!-- Section Header /- -->
      <div class="row">
         @foreach ($data as $item)
         <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="type-post">
               <div class="entry-cover" style="text-align: center;">
                  <a href="{{route('detail', array('id' => $item->id))}}">
                  <img src="{{ asset($item->thumbnail) }}" style="object-fit: cover;height: 300px;">
                  </a>
                  <!-- <span class="post-date"><a href="#"><i class="fa fa-calendar-o"></i>june 26</a></span> -->
               </div>
               <div class="blog-content">
                  <h3 class="entry-title" style="height: 50px;overflow: hidden;">
                     <a title="{{ $item->title }}" href="{{route('detail', array('id' => $item->id))}}">
                     <span>{{ $item->title }}</span>
                     </a>
                  </h3>
                  @php
                  $offPerchantage = round(($item->product_price - $item->selling_price) * 100 / $item->product_price)
                  @endphp
                  <div class="entry-meta">
                     <span class="post-like">
                     <del>
                     <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                     {{number_format($item->product_price,2)}}
                     </del>
                     &nbsp;
                     <b>
                     {{$offPerchantage}}% Off
                     </b>
                     </span>
                     <span class="post-admin" style="color: #ec0000;">
                     <i class="fa fa-rupee" style="font-size: unset;padding-right: 2px;"></i>
                     <b>{{number_format($item->selling_price,2)}}</b>
                     </span>
                  </div>
                  <div class="entry-content">
                     <p style="overflow: hidden;">{!! $item->description !!}</p>
                     <a href="{{ url('ap_details/'.$item->id) }}" title="Read More" class="read-more">View More<i class="fa fa-long-arrow-right"></i></a>
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