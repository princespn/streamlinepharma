@extends('FrontEndTheme.Nest.layout.layout')
@section('title', 'Checkout')
@section('page-content')
<main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Shop
                    <span></span> Checkout
                </div>
            </div>
        </div>
        <div class="container mb-80 mt-50">
            <div class="row">
                <div class="col-lg-8 mb-40">
                    <h1 class="heading-2 mb-10">Checkout</h1>
                    <div class="d-flex justify-content-between">
                        <h6 class="text-body">There are <span class="text-brand">{{ count($cartList) }}</span> products in your cart</h6>
                    </div>
                </div>
				
				
				
            </div>
            <div class="row">
                <div class="col-lg-7">
                    <div class="row mb-50">
                        <div class="col-lg-12 col-sm-12">
                            @if(Session::get('register'))
								<h3>Welcome {{Session::get('register')->name}}</h3>
							
							
							  @if(count($all_address))
								  <h4 class="mb-30">Select Address</h4>
							  <form method='post' id='saveAddressForm' action="{{ url('updateAddress') }}">
							  @csrf
							    <div class='row'>
								  @foreach($all_address as $row)
							        <div class="col-md-4">
							         <div class="card">
									  <div class="card-body">
									   <label>
									     <input id='address_radio{{ $row->id }}' style='height:15px;width:15px;display:none' name='selected_address' type='radio' value='{{ $row->id }}' @if(Session::get('selected_address')&&Session::get('selected_address')==$row->id) checked @endif> <strong style='font-size: 19px;'> {{ $row->name }}</strong><br>
										 {{ $row->landmark }}, {{ $row->cityId }}<br>
										 {{ $row->stateId }}, {{ $row->countryId }}, {{ $row->zipCode }}<br>
										 Mo. {{ $row->phone }}<br>Email {{ $row->email }}
										</label>		 
										 </div>
										 <div class='card-footer address_footer'>
										    <div class='row'>
											  <div class='col-md-12'>
											    @if(Session::get('selected_address')&&Session::get('selected_address')==$row->id)  
												 <label class='btn btn-xs btn-sm selected'>Selected</label>
												@else
											     <label class='btn btn-xs btn-sm btn-primary' for='address_radio{{ $row->id }}'>Delivery Here</label>
											    @endif
											  </div>
											</div>
										    <div class='row'>
											    <div class='col-6'>
												  <label class='btn btn-xs btn-sm btn-success' onclick="openAddressModal('edit','{{ md5($row->id) }}')">Edit</label>
												</div>
												<div class='col-6'>
												   <a href="{{ url('deleted_address/'.md5($row->id)) }}" class='btn btn-xs btn-sm btn-primary' onclick="if(confirm('Are you sure?')){return true;}else{return false;}">Delete</a>
												</div>
											</div>
										 </div>
									 </div>
									</div>
							      @endforeach
								</div>
								  </form>
								  <br>
								  <button type='button' class='btn btn-primary btn-sm' onclick="openAddressModal('add')">Add New Address</button>
							  @else
								  <h4 class="mb-30">Select Address</h4>
								  <p>You don't have any saved address.</p>
								  <button type='button' class='btn btn-primary btn-sm' data-bs-toggle="modal" data-bs-target="#address_modal">Click here to add address to Proceed to Your order.</button>
							  @endif
							
							@else
							<h4 class="mb-30">Login or Signup</h4>
                            <div class="login_form" id="loginform">
                                <div class="panel-body">
								<ul class="nav nav-tabs">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#logi_with_otp">Login with OTP</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#logi_with_password">Login with Password</a>
									</li>
								</ul>
								<div class="tab-content">
								    <div class="tab-pane active container" id="logi_with_otp">
										<form method="post"> 
										@csrf
											<div class="form-group">
												<input type="text" name="mobile" id='mobile' placeholder="Mobile" >
												<span class='error mobile_error'></span>
											</div>
											<div class="form-group otp_div">
												<input type="text" name="otp" id='otp' placeholder="OTP" >
											</div>
											
											<div class="form-group password_div">
												<input type="text" name="password" id='password' placeholder="Set Password" >
											</div>
											<span class='error checkout_error'></span>
											<div class="login_footer form-group">
												<div class="chek-form">
												</div>
												
											</div>
											<div class="form-group continue_div">
												<button class="btn btn-md" type='button' onclick='submitMobilefromCheckoutp()'  name="login">Continue</button>
											</div>

											<div class="form-group proceed_to_checkout_div">
												<button class="btn btn-md" type='button' onclick='verifyOTP()';  name="login">Process to Checkout</button>
											</div>
										</form>
									</div>
									<div class="tab-pane container" id="logi_with_password">
									    <form method="post">
										    @csrf
                                            <div class="mb-3 mt-3">
												<label for="login_email" class="form-label">E Mail or Mobile:</label>
												<input type="text" class="form-control" id="login_email" placeholder="Enter EMail" name="login_email">
                                            </div>
											<div class="mb-3 mt-3">
												<label for="login_password" class="form-label">Password:</label>
												<input type="password" class="form-control" id="login_password" placeholder="Enter Password" name="login_password">
                                            </div>
											<span class='login_error'></span>
											<button type="button" class="btn btn-primary" onclick='initiateLogin()'>Login</button>
											<p><a href="{{ url('forogot-password') }}">Forgot your password? Reset here</a></p>
                                        </form>
									</div>
                                </div>
                                </div>
                            </div>
							@endif
                        </div>
                        
                    </div>
                    <!--------------------->
					@if(Session::get('register'))
					<div class="row mt-50">
                        
                        <div class="col-md-6">
                            <div class="p-40">
                                <h4 class="mb-10">Apply Coupon</h4>
                                <p class="mb-30">Using A Promo Code?</p>
                                <p class="mb-30" id='coupon_responce'></p>
                                
                                    <div class="d-flex justify-content-between" id='coupon_continer'>
                                        <input form='orderForm' class="font-medium mr-15 coupon" name="coupon_code" id="coupon_code" placeholder="Enter Your Coupon">
                                        <button class="btn" type='button' onclick="applyCoupon()"><i class="fi-rs-label mr-10"></i>Apply</button>
                                    </div>
                                
                            </div>
                        </div>
                    </div>
					@endif
					@if(Session::get('register')&&Session::get('selected_address'))
					<form  method='post' action="{{ url('processOrder') }}" id='orderForm'>
				    @csrf
					@if(!isset($is_servicable))
						{{--<strong  style='color:red'>Please select address to make the order.</strong>
					@elseif($is_servicable==false) --}}
					    <strong class='alert' style='color:red'>Sorry! We cannot deliver to the selected address,Please change another address.</strong>
					@elseif($is_servicable==true)
					<div class="payment ml-30">
                        <h4 class="mb-30">Payment</h4>
                        <div class="payment_option">
						@if($amount > 0)
                           
						    <div class="form-check" style='padding-left:0px'>
							    <input style='height:15px;width:15px' type="checkbox" id="pay_with_wallet"  name="pay_with_wallet" onclick="salectwallet()" value="{{$amount}}" class='orm-check-input'>
                                <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse" data-target="#cash_on_delivery" aria-controls="cash_on_delivery">Use Your  ₹ {{$amount}}  Pay with Wallet</label>
                            </div>
                        @endif
                            <div class="custome-radio">
                                <input class="form-check-input" required="" type="radio" name="transactionType" id="exampleRadios3" checked="" value='1'>
                                <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse" data-target="#cash_on_delivery" aria-controls="cash_on_delivery">Cash On Delivery</label>
                            </div>
							@if($account->instamojoApiKey)
                            <!--div class="custome-radio">
                                <input class="form-check-input" required="" type="radio" name="transactionType" id="exampleRadios4" value='3'>
                                <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse" data-target="#instamojo" aria-controls="instamojo">Instamojo</label>
                            </div-->
							@endif
							@if($account->razorPayApiKey)
                            <div class="custome-radio">
                                <input class="form-check-input" required="" type="radio" name="transactionType" id="exampleRadios5" value='2'>
                                <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse" data-target="#rajorPay" aria-controls="rajorPay">Rajorpay</label>
                            </div>
							@endif
                        </div>
                        <div class="payment-logo d-flex">
                            <img class="mr-15" src="{{ url('Nest/assets/imgs/theme/icons/payment-paypal.svg')}}" alt="">
                            <img class="mr-15" src="{{ url('Nest/assets/imgs/theme/icons/payment-visa.svg')}}" alt="">
                            <img class="mr-15" src="{{ url('Nest/assets/imgs/theme/icons/payment-master.svg')}}" alt="">
                            <img src="{{ url('Nest/assets/imgs/theme/icons/payment-zapper.svg')}}" alt="">
                        </div>
                        <button type='submit' class="btn btn-fill-out btn-block mt-30">Place an Order<i class="fi-rs-sign-out ml-15"></i></button>
                    </div>
					@endif
					</form>
					@endif
                    <!--------------------->
                </div>
                <div class="col-lg-5">
                    <div class="border p-40 cart-totals ml-30 mb-50">
                        <div class="d-flex align-items-end justify-content-between mb-30">
                            <h4>Your Order</h4>
                        </div>
                        <div class="divider-2 mb-30"></div>
                        <div class="table-responsive order_table checkout">
                            <table class="table no-border">
							    <thead>
								  <tr>
								    <th colspan='2'>Product</th>
								    <th>Quantity</th>
								    <th>Shipping</th>
								    <th>Price</th>
								  </tr>
								</thead>
                                <tbody>
                                @php $cart_total = 0; @endphp
                                @foreach($cartList as $item)
								@php
if($item->product->dynamic_selling_price!=0&& date("Y-m-d H:i:s",strtotime("-15 minutes ".$item->created_at)) < date("Y-m-d H:i:s")){
$product_pr = ( $item->product->tax_method=='Exclusive' ? ( $item->product->dynamic_selling_price + $item->product->dynamic_selling_price*($item->product->product_tax/100) ) : $item->product->dynamic_selling_price );	
}else{
$product_pr = ( $item->product->tax_method=='Exclusive' ? ( $item->product->selling_price + $item->product->selling_price*($item->product->product_tax/100) ) : $item->product->selling_price );
}
                                @endphp
                                    <tr>
                                        <td class="image product-thumbnail"><img src="{{ $item->product->thumbnail }}" alt="#"></td>
                                        <td>
                                            <h6 class="w-160 mb-5"><a href="{{ url('product-detail/'.$item->product->sku) }}" class="text-heading">{{ $item->product->title }}</a></h6></span>
                                            <div class="product-rate-cover">
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width:90%">
                                                    </div>
                                                </div>
                                                <span class="font-small ml-5 text-muted"> (0.0)</span>
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="text-muted pl-20 pr-20">x {{ $item->qty }}</h6>
                                        </td>
										<td>
										{{ ($item->shipping==0? (  $item->product->shipping_method=='Exclusive' ? 'Std shipping charges apply ' : 'Free') : ($item->qty==1 ? '' : $item->qty."*" )."₹ ".$item->shipping) }}
										
										</td>
                                        <td>
                                            <h4 class="text-brand" id='pr_{{ $item->product->id }}'>@if(!$item->scheme_id)
                              Rs <span id="pr_price_{{ $item->product->id }}">{{number_format(($product_pr) * ($item->qty),2)}}</span>
							  @php $cart_total += (($product_pr) * ($item->qty) ) + ($item->qty*$item->shipping); @endphp
							  @else
								  
							  @php $cart_total +=  $item->ReferralScheme->special_charges; @endphp
							  
								 <del>Rs {{number_format(($item->product->selling_price) * ($item->qty),2)}}</del>
								  <br>
								  <span style='color:red;font-family:bold;font-size: 20px;'>{{ $item->ReferralScheme->scheme_name }} Price Rs : {{  $item->ReferralScheme->special_charges }} </span>
							  @endif</h4>
                                        </td>
                                    </tr>
									@if($item->product->purchase_product_offer&&$item->qty>=$item->product->purchase_product_offer->qty)
							@php
						       $offerered_qty = intdiv($item->qty,$item->product->purchase_product_offer->qty);
						    @endphp 
							<tr class="pt-30">
                                    <td class="image product-thumbnail pt-40"><img src="{{ $item->product->purchase_product_offer->offerProduct->thumbnail }}"></td>
                                    <td class="product-des product-name">
                                       <h6 class="mb-5">{{ $item->product->purchase_product_offer->offerProduct->title }}</h6><br>
									<span class='offer'><strong>Offer Applied - </strong>{{ $item->product->purchase_product_offer->sceheme->title }}</span>
                                    </td>
                                    <td class="product-quantity">
									{{ $offerered_qty }}
                                    </td>
                                    <td data-title="Unit Price" class="product-unit-price">
                                        Rs {{number_format($item->product->purchase_product_offer->offerProduct->selling_price,2)}}
										<br>
										<small>Incl : {{ $item->product->purchase_product_offer->offerProduct->product_tax }}% Tax</small>
                                    </td>
                                    <td data-title="Total" class="product-subtotal" colspan='2'>
									<span style='text-decoration: line-through;'>Rs {{number_format(($item->product->purchase_product_offer->offerProduct->selling_price) * ($offerered_qty),2)}}
									</span><br> Rs 0
									</td>
                                      
                                </tr>

							      @endif
                                  @endforeach 
                                    <tr>
                                      <th colspan='5'><h4 class='text-brand' id='total_h4'>Total  - ₹{{ $cart_total }}</h4></th>
                                    </tr>                                  
                                </tbody>
                            </table>
							<input type='hidden' id='cart_value' value='{{ $cart_total }}'>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </main>
	
	<!---------------------------------->
@endsection
@push('custom-css')
<style>
  .otp_div,.password_div,.proceed_to_checkout_div{
    display:none;
  }
  .nav-tabs .nav-link{
	padding:20px !important;
  }
</style>
@endpush
@push('custom-scripts')
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
	var coupon_discount = 0;
function submitMobilefromCheckoutp(){
	var mobile = $('#mobile').val();
	
	
	if(mobile.length!=10||isNaN(mobile)){
		$('.mobile_error').html('Please enter valid 10 digit mobile.');
		return false;
	}else{
		$('.mobile_error').html('');
	}
	var myKeyVals = { 
	                  mobile : mobile,
	                  _token : $('input[name=_token]').val(),
					}
	var saveData = $.ajax({
		  type: 'POST',
		  url: "{{ url('submitMobilefromCheckoutp') }}",
		  data: myKeyVals,
		  dataType: "text",
		  success: function(data){ 
		     data = JSON.parse(data);
			 console.log(data);
             $('.proceed_to_checkout_div').show();
             $('.continue_div').hide();
			 if(data.is_new==true){
				$('.password_div').show(); 
				$('.otp_div').show(); 
			 }else{
				$('.password_div').hide();
				$('.otp_div').show();  
			 }
			 $('.mobile_error').html(data.message);
		  }
	});
    saveData.error(function(){ 
	    $('.mobile_error').html('Something went wrong, please try after some time.');
	});
}
function verifyOTP(){
    var otp      = $('#otp').val();
    var mobile      = $('#mobile').val();
    var password = $('#password').val();
	var myKeyVals = { 
	                  mobile   : mobile,
	                  otp      : otp,
	                  password : password,
	                  _token   : $('input[name=_token]').val(),
					}
	var saveData = $.ajax({
		  type: 'POST',
		  url: "{{ url('verifyOTP') }}",
		  data: myKeyVals,
		  dataType: "text",
		  success: function(data){ 
		     data = JSON.parse(data);
			 $('.checkout_error').html(data.message);
			 if(data.error==false){
				 location.reload();
			 }
		  }
	});
    saveData.error(function(){ 
	    $('.mobile_error').html('Something went wrong, please try after some time.');
	});
}

function applyCoupon(){
    var coupon_code      = $('#coupon_code').val();
    var cart_value      = $('#cart_value').val();
	var myKeyVals = { 
	                  coupon_code   : coupon_code,
	                  cart_value      : cart_value,
	                  _token   : $('input[name=_token]').val(),
					}
	var saveData = $.ajax({
		  type: 'POST',
		  url: "{{ url('applyCoupon') }}",
		  data: myKeyVals,
		  dataType: "text",
		  success: function(data){ 
		     data = JSON.parse(data);
			 console.log(data);
			 if(data.error==false){
				 var style="style='color:green'";
				 $('#coupon_continer').attr('style','display:none !important');
				 if(data.type=='product'||data.type=='salex'){
					 var pr_text = $("#pr_"+data.product_id).html();
					 var pr_price = Number($("#pr_price_"+data.product_id).html());
					 
					 $("#pr_"+data.product_id).html("<span style='text-decoration: line-through'>"+pr_text+"</span><br>Discount Price : "+(pr_price-Number(data.discount)));
				 }
			 }else{
				 var style="style='color:red'";
			 }
			 $("#coupon_responce").html("<span "+style+">"+data.message+"</span>");
			 coupon_discount = Number(data.discount);
			 $("#total_h4").html("Total  - ₹"+(cart_value-Number(data.discount)));
		  }
	});
    saveData.error(function(){ 
	    $('.mobile_error').html('Something went wrong, please try after some time.');
	});
}

    $('#saveAddressForm').change(
    function(){
        
            $("#saveAddressForm").submit();
        
    });
	@if($amount > 0)
	$("#pay_with_wallet").change(function(){
		var cart_value  = $('#cart_value').val();
        if( $('#pay_with_wallet').is(':checked') ){
			var total_value = cart_value - coupon_discount;
			if({{ $amount }} < total_value){
			   $("#total_h4").html("Total  - ₹"+(total_value-Number({{ $amount }})));
			}else{
			   $("#total_h4").html("Total  - ₹0");
			}
		}else{
			$("#total_h4").html("Total  - ₹"+(cart_value));
		}
	});
	@endif


	function initiateLogin(){
	var email      = $('#login_email').val();
    var password   = $('#login_password').val();
	var myKeyVals = { 
	                  email    : email,
	                  password : password,
	                  _token   : $('input[name=_token]').val(),
					}
	var saveData = $.ajax({
		  type: 'POST',
		  url: "{{ url('login_check') }}",
		  data: myKeyVals,
		  dataType: "text",
		  success: function(data){ 
		     data = JSON.parse(data);
			 $('.login_error').html(data.message);
			 if(data.error==false){
				 window.location = "{{ url('checkout') }}";
			 }
		  }
	});
    saveData.error(function(){ 
	    $('.mobile_error').html('Something went wrong, please try after some time.');
	});
}
</script>
@endpush