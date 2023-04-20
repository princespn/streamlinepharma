@extends('FrontEndTheme.Nest.layout.layout')
@section('title', 'Dashboard')
@section('page-content')
@php $order_menu = 'orders'; @endphp
<main class="main pages">
   <div class="page-header breadcrumb-wrap">
      <div class="container">
         <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Pages <span></span> Orders
         </div>
      </div>
   </div>
   <div class="page-content pt-150 pb-150">
      <div class="container">
         <div class="row">
            <div class="col-lg-10 m-auto">
               <div class="row">
                  <div class="col-md-3">
                     <div class="dashboard-menu">
                        @include('FrontEndTheme.Nest.layout.dashboard_menu');
                     </div>
                  </div>
                  <div class="col-md-9">
                     <div class="account dashboard-content pl-50">
                        <div class="card">
                           <div class="card-header">
                              <h3 class="mb-0">My Orders</h3>
                           </div>
                           <div class="card-body">
                              @foreach ($orders as $order)
							  
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
                                          <img src="{{ $product->thumbnail }}" style="height: 100px;">
                                          <div>
                                            
                                                {{ $product->title }}
                                             
                                             
                                          </div>
                                       </td>
                                       <td class='price-col'>
                                          <span class="product-title">Price : Rs. {{ $product->selling_price }}</span><br>
                                          <span class="product-qty">Qty : {{ $product->qty }}</span><br>
                                          <span class="product-qty">Sub Total : Rs. {{ $product->selling_price }}</span><br>
                                          <span class="product-qty">Tax (0 %) : Rs. {{ $product->product_tax }}</span><br>
                                          <span class="product-qty">Shipping : Rs. {{ $product->shipping_charges }}</span>
                                       </td>
                                    </tr>
                                    @endforeach
                                 </tbody>
                                 <tfoot>
								    <tr>
									  <th>Total</th>
									  <th>{{ $order->grand_total }}</th>
									</tr>
									@if($order->coupon)
									<tr>
									  <th>Coupon Discount</th>
									  <th>{{ $order->discount_coupon_amount }} ({{ $order->coupon }})</th>
									</tr>
									<tr>
									  <th>Grand Total</th>
									  <th>{{ $order->grand_total-$order->discount_coupon_amount }}</th>
									</tr>
                           
									@endif
                           @if($order->do_to_wallet>0)
                           <tr>
									  <th>Paid By Wallet</th>
									  <th>{{ $order->do_to_wallet }}</th>
									</tr>
                           @endif
                                    <tr>
                                       <th colspan='2' class='text-center alert alert-success'>Order Status : {{ $constant_order_status[$order->status] }}</th>
                                    </tr>
									
							        <tr>
								       <th colspan='2' class='text-center'>
									   @if($order->status==4)
									     <a href="{{ url('invoice/'.$order->order_id) }}" class='btn-sm btn-xs btn-success'>Invoice</a>
									   @endif
										 @if($order->status==4)
										 <button type='button' class='btn btn-sm btn-xs btn-primary'>Track Order</button>
									     @endif
										 @if($order->status<2)
										 <a href="{{ url('userOrderCancel/'.$order->order_id) }}" class='btn-danger btn-xs btn-sm'>Cancel Order</a>
										 @endif
									   </th>
								    </tr>			
									
                                    @if($order->shirocketWebHook!=Null)
									<tr>
								     <td colspan='2'>
									 @php $ship = json_decode($order->shirocketWebHook,true); @endphp
									 <strong>Current Status : </strong>{{ $ship['current_status'] }} <button data-bs-toggle="modal" data-bs-target="#trackModal" class='btn btn-primary btn-sm btn-xs' onclick='getTrackingDetail({{ $order->id }})'>Track Package</button>
									 </td>
                                    </tr>									
								  @endif
                                 </tfoot>
                              </table>
                              @endforeach
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
<!---------------------------------------------------------------->
<div class="modal" id="trackModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Tracking</h4>
        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!---------------------------------------------------------------->
@endsection
@section('custom-css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


 <style>   
	.track_tbl td.track_dot {
    width: 50px;
    position: relative;
    padding: 0;
    text-align: center;
}
.track_tbl td.track_dot:after {
    content: "\f111";
    font-family: FontAwesome;
    position: absolute;
    margin-left: -5px;
    top: 14px;
}
.track_tbl td.track_dot span.track_line {
    background: #000;
    width: 3px;
    min-height: 50px;
    position: absolute;
    height: 101%;
}
.track_tbl tbody tr:first-child td.track_dot span.track_line {
    top: 30px;
    min-height: 25px;
}
.track_tbl tbody tr:last-child td.track_dot span.track_line {
    top: 0;
    min-height: 25px;
    height: 10%;
}
	</style>
@stop
@section('custom-scripts')
<script>   
function getTrackingDetail(id){
	    $('#trackModal .modal-body').html('Getting detail...');
		$.ajax({
		  url: "{{ url('getTrackingDetail') }}/"+id,
		  cache: false,
		  success: function(data){
			$('#trackModal .modal-body').html(data);
			
		  }
		});
	
}
</script>
@stop