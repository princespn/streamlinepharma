@extends('theams/theam1/layouts.app')
@section('theme1Content')
<!-- Page Banner -->
<div class="page-banner container-fluid no-padding">
   <!-- Container -->
   <div class="container">
      <div class="banner-content">
         <h3>OrderList</h3>
         <p>our vision is to be Earth's most customer centric company</p>
      </div>
      <ol class="breadcrumb">
         <li><a href="/" title="Home">Home</a></li>
         <li class="active">orderList</li>
      </ol>
   </div>
   <!-- Container /- -->
</div>
<!-- Page Banner /- -->
<!-- Checkout -->
<div class="container-fluid contact-us no-left-padding no-right-padding woocommerce-checkout">
   <!-- Container -->
   <div class="container">
      <div class="row">
         <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <input type="hidden" value="{{ csrf_token() }}" id="csrfToken">
            <form>
               @foreach ($data as $order)
               <!-- <h3>
                  <a href="{{route('orderReturn', array('orderNo' => $order->orderNo))}}" style="margin-left: 20px;">
                  Return order
                  </a>
                  </h3> -->
               <div class="col-lg-12">
                  <div class="order-summary">
                     <div class="collapse in" id="order-cart-section">
                        <table class="table table-mini-cart">
                           <thead>
                              <tr>
                                 <th style="width:65%">
                                    <span style="display:block">{{$order->name}}</span>
                                    <span style="display:block">{{$order->phone}}</span>
                                    <span style="display:block">{{$order->email}}</span>
                                    <span style="display:block">{{$order->landmark}},{{$order->address}},{{$order->zipCode}}</span>
                                    <span style="display:block">{{$order->variation4}}</span> 
                                 </th>
                                 <th>
                                    <span style="display:block">
                                    {{$order->order_id}}
                                    </span>
                                    <span style="display:block">{{$order->transactionId}}</span>
                                    <span style="display:block">{{ date('d-m-Y h:m a', strtotime($order->created_at))  }}</span>
                                 </th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($order->products as $product)
                              <tr>
                                 <td class='product-col'>
                                    <figure class="product-image-container">
                                       <img src="{{ $product->thumbnail }}" style="height: 100px;">
                                    </figure>
                                    <div>
                                       <h2 class="product-title" style="max-width: none;">
                                          {{ $product->title }}
                                       </h2>
                                       <span class="product-qty"></span>
                                       <span class="product-qty"></span>
                                       <span class="product-qty"></span>
                                       <span class="product-qty"></span>
                                       <span class="product-qty"></span>
                                       <span class="product-qty"></span>
                                    </div>
                                 </td>
                                 <td class='price-col'>
                                    <span class="product-title">Price : Rs. {{ $product->selling_price }}</span>
                                    <span class="product-qty">Qty : {{ $product->qty }}</span>
                                    <span class="product-qty">Sub Total : Rs. {{ $product->selling_price }}</span>
                                    <span class="product-qty">Tax (0 %) : Rs. {{ $product->product_tax }}</span>
                                    <span class="product-qty">Shipping : Rs. {{ $product->shipping_charges }}</span>
                                 </td>
                              </tr>
                              @endforeach
                           </tbody>
						   <tfoot>
						     <tr>
							   <th colspan='2' class='text-center alert alert-success'>Order Status : {{ $constant_order_status[$order->status] }}</th>
							 </tr>
							 @if($order->status < 2)
							 <tr>
							   <th colspan='2' class='text-center alert alert-success'>
							    <a href="{{ url('userOrderCancel/'.$order->order_id) }}" class='btn btn-danger'>Cancel Order</a>
							   </th>
							 </tr> 
							 @endif
							 
						   </tfoot>
                        </table>
                     </div>
                     <!-- End #order-cart-section -->
                  </div>
                  <!-- End .order-summary -->
               </div>
               @endforeach
            </form>
         </div>
         <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div id="footer-main" class="footer-main container-fluid" style="padding-left:20px;margin-top:30px;">
               <!-- Container -->
               <div class="container">
                  <div class="row">
                     <!-- Widget Links -->
                     <aside class="col-md-3 col-sm-6 col-xs-6 ftr-widget widget_links">
                        <h4 style="margin-top: -45px;padding-bottom:10px;">Useful Link</h4>
                        @include('theams.theam1.account_menu');
                     </aside>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Container /- -->
</div>
<!-- Checkout /- -->
@endsection