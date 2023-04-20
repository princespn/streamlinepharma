@extends('theams/Front1/app') 
@section('title','Manage Product') 

@section('MainSection')
{!! Form::open(['route' => 'confirmOrder','method'=>'POST','id'=>'formCheckOut','enctype'=>'multipart/form-data']) !!}
{{ csrf_field() }}
  <!--End header-->
  <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
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
                        <h6 class="text-body">There are <span class="text-brand">3</span> products in your cart</h6>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7">
                    <div class="row mb-50">
                        <div class="col-lg-6 mb-sm-15 mb-lg-0 mb-md-3">
                        
                            <div class="toggle_info">
                            @if(Session::get('register'))
                          
                            <span><i class="fi-rs-user mr-10"></i><span class="text-muted font-lg">Welcome {{Session::get('register')->name}}</span></span>
                            @else
                           
                            <span><i class="fi-rs-user mr-10"></i><span class="text-muted font-lg">Already have an account?</span> <a href="{{url('userlogin')}}" data-bs-toggle="collapse" class="collapsed font-lg" aria-expanded="false">Click here Login or SignUp</a></span>
                            @endif
                            </div>
                            <div class="panel-collapse collapse login_form" id="loginform">
                                <div class="panel-body">
                                    <p class="mb-30 font-sm">If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing &amp; Shipping section.</p>
                                    <form method="post">
                                        <div class="form-group">
                                            <input type="text" name="email" placeholder="Username Or Email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" placeholder="Password">
                                        </div>
                                        <div class="login_footer form-group">
                                            <div class="chek-form">
                                                <div class="custome-checkbox">
                                                    <input class="form-check-input" type="checkbox" name="checkbox" id="remember" value="">
                                                    <label class="form-check-label" for="remember"><span>Remember me</span></label>
                                                </div>
                                            </div>
                                            <a href="#">Forgot password?</a>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-md" name="login">Log in</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                           
                        </div>
                    </div>
                    <div class="row">
                        <h4 class="mb-30">Billing Details</h4>
                       
                        <div class="row">
                            <div class="form-group col-lg-12">
                            
                            <div class="col-md-12 col-sm-12 col-xs-12 delivery_summary @if(!Session::get('register') || Session::get('addressCodeID')) hide @endif" >
               @if(Session::get('register'))
               <h3>
               Shipping Address</h2>
               @php
               $isAddressComplete = true;
               if (isset($allAddresses) && $allAddresses->count() > 0) {
               $count = $allAddresses->count();
               $fadd = $allAddresses->toArray()[0];
               if ($count >= 1 && $fadd && $fadd['address'] != '') {
               // $isAddressComplete = true;
               }
               }
               @endphp
               @if($isAddressComplete)
               <ul class="checkout-steps" id="oldAddress">
                  <li>
                     <div class="form-group required-field">
                        <label>Address </label>
                        <select class="form-control" id="shippingAddres" name="shipping_address" onchange='proceedTOSummary(1)' required>
                           <option value="">Select Address</option>
                           @foreach ($allAddresses as $k=> $add)
                           <option @if($k==0) salected @endif value="{{$add->id}}"  data-zipCode="{{$add->zipCode}}"
                           @if(Session::get('addressCodeID')==$add->id)
                           selected
                           @endif
                           >{{$add->landmark}} {{$add->address}} {{$add->cityId}} {{$add->stateId}} {{$add->zipCode}}</option>
                           @endforeach
                        </select>
                     </div>
                  </li>
                  <li>

                     <div class="">
             <!--            
                        <button type="button" id="" class="btn btn-primary" onclick='proceedTOSummary(1)'>Continue</button>
            -->
                        <button type="button" id="addAddessss" onclick="proceedTOSummary(2)" class="btn btn-primary">Add New Address</button>
                        <br/>
                        <span id="oldAddMsg"></span>
                     </div>
                  </li>
               </ul>
               @endif
               <ul id="newAddress" class="checkout-steps @if($isAddressComplete) hide @endif">
                  <li>
                     <div class="form-group required-field">
                        <label>Name </label>
                        <input type="text" name="name" id="name" class="form-control" value="{{$addresses['name']}}"  >
                     </div>
                     <div class="form-group required-field">
                        <label>Phone</label>
                        <input type="tel" name="phone" id="phone" class="form-control" value="{{$addresses['phone']}}"  >
                     </div>
                     <div class="form-group required-field">
                        <label>Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{$addresses['email']}}"  >
                     </div>
                     <div class="form-group required-field">
                        <label>Landmark</label>
                        <input type="text" name="landmark" id="landmark" class="form-control" value="{{$addresses['landmark']}}"  >
                     </div>
                     <div class="form-group required-field">
                        <label>Address</label>
                        <input type="text" name="address" id="address" class="form-control" value="{{$addresses['address']}}" >
                     </div>
                     <div class="form-group required-field">
                        <label>Zip/Postal Code </label>
                        <input type="text" name="zipCode" id="zipCode" onchange="zipCodeCheck(this.value);" class="form-control" value="{{$addresses['zipCode']}}" >
                        <p id="zipMSG"></p>
                        <input type="hidden" value="{{ csrf_token() }}" id="csrfToken">
                     </div>
                     <div class="form-group required-field">
                        <label>City</label>
                        <input type="text" name="cityId" id="cityId"  class="form-control" value="{{$addresses['cityId']}}" >
                        <p id="zipMSG"></p>
                     </div>
                     <div class="form-group required-field">
                        <label>State</label>
                        <input type="text" name="stateId" id="stateId" class="form-control" value="{{$addresses['stateId']}}" >
                        <p id="zipMSG"></p>
                     </div>
                  </li>
                  <li>
                     <button type="button" id="" class="btn btn-primary" onclick='proceedToOrderSummary()'>Continue</button>
                  </li>
               </ul>
               @endif
               <br>
               <br>
            </div>
                            </div>
                              
                        </div>
                    </div>
                    
                </div>
                
                <div class="col-lg-5">
                @if(count($cartList)>0)
                    <div class="border p-40 cart-totals ml-30 mb-50">
                        <div class="d-flex align-items-end justify-content-between mb-30">
                            <h4>Your Order</h4>
                            <h6 class="text-muted">Subtotal</h6>
                        </div>
                        <div class="divider-2 mb-30"></div>
                        <div class="table-responsive order_table checkout">
                            <table class="table no-border">
                                <tbody>
                                @php $total = 0; @endphp
                                 @foreach ($cartList as $item)
                                    <tr>
                                        <td class="image product-thumbnail"><img src="{{ $item->product->thumbnail }}" alt="#"></td>
                                        <td>
                                            <h6 class="w-160 mb-5"><a href="shop-product-full.html" class="text-heading"> {{ $item->product->title }} </a></h6></span>
                                            <div class="product-rate-cover">
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width:90%">
                                                    </div>
                                                </div>
                                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="text-muted pl-20 pr-20">x{{$item->qty}}</h6>
                                        </td>
                                        <td>
                                        @if(!$item->scheme_id)
                                        <h4 class="text-brand">₹{{number_format(($item->product->selling_price) * ($item->qty),2)}}</h4>
                                        @php $total += ($item->product->selling_price) * ($item->qty); @endphp
                                        @else
                                            
                                        @php $total += ($item->product->selling_price- $item->product->selling_price*($item->ReferralScheme->discount/100)) + $item->ReferralScheme->special_charges; @endphp
                                        
                                            <del>Rs {{number_format(($item->product->selling_price) * ($item->qty),2)}}</del>
                                            <br>
                                            <span style='color:red;font-family:bold;font-size: 20px;'>{{ $item->ReferralScheme->scheme_name }} Price Rs : {{  $item->product->selling_price- $item->product->selling_price*($item->ReferralScheme->discount/100) }} </span>
                                        @endif
                                            
                                        </td>
                                    </tr>
                                    @if($item->scheme_id)
                                        <tr>
                                        <td class="product-col">
                                            <h2 class="product-title" style="max-width: none;">
                                            {{ $item->ReferralScheme->special_charges_label }}
                                            </h2>
                                        </td>
                                        <td class="price-col">Rs {{ $item->ReferralScheme->special_charges }}
                                        
                                        </td>
                                        </tr>
                                    @endif
                                    <!--------------------------->
                                    @if($item->product->purchase_product_offer&&$item->qty>=$item->product->purchase_product_offer->qty)
                                    @php
                                    $offerered_qty = intdiv($item->qty,$item->product->purchase_product_offer->qty);
                                    @endphp
						            <!--------------------------->
                                    <tr>
                           <td class="product-col">
                              <figure class="product-image-container">
                                 <img src="{{ $item->product->purchase_product_offer->offerProduct->thumbnail }}" style="height: 50px;">
                              </figure>
                              <div>

                                 <h2 class="product-title" style="max-width: none;">
                                    {{ $item->product->purchase_product_offer->offerProduct->title }}<br><br>
									<span class='offer'><strong>Offer Applied - </strong>{{ $item->product->purchase_product_offer->sceheme->title }}</span> 
                                 </h2>
                                 <span class="product-qty">Qty: {{ $offerered_qty }}</span>
                                 <br>
                                 <span class="product-qty">
                                 </span>
                              </div>
                           </td>
                           <td class="price-col">
                              <span style='text-decoration: line-through;'>Rs {{number_format(($item->product->purchase_product_offer->offerProduct->selling_price) * ($offerered_qty),2)}}
									</span><br> Rs 0
                           </td>
                        </tr>
						@endif
                        @endforeach
                        <tr>
                           <td class="product-col">
                              <h6 class="product-title" style="max-width: none;">
                                 Sub Total
                              </h6>
                           </td>
                           <td class="price-col">Rs {{number_format($total,2)}}
						   <br>
						   <small>Incl :  Tax</small>
						   </td>
                        </tr>
                        <tr>
                           <td class="product-col">
                              <h6 class="product-title" style="max-width: none;">
                                 Shipping
                              </h6>
                           </td>
                           <td class="price-col">
                              RS. <span id="shipmentDisplay">0</span>
                           </td>
                        </tr>
                        <tr>
                        <td colspan="2">
                             

                            <div class="input-group pull-right">
                                <input type="text" class="form-control"  name="coupon" placeholder="Coupon Code" form='process_order' id="coupon_code" placeholder="Coupon Code" aria-label="Recipient's username" aria-describedby="button-addon2">
                                <input type="hidden" name="product_id" id="product_id" form='process_order' value="{{$item->product_id}}" />
                              <input type="hidden" name="setting_id" id="setting_id" form='process_order' value="{{$item->product->setting_id}}" />
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary"  onclick="checkCoupon()" type="button">Apply</button>
                                </div>
                            </div>
                            <span id="couponError" style="color: red;"></span>
                              <input type="hidden"  name="coupon_amount" id="coupon_amount" />
                           </td>
                        </tr>
                      
                        <tr id="isCouponApply" style="display: none;">
                           <td class="product-col">
                              <h2 class="product-title">Coupon Discount Amount</h2>
                           </td>
                           <td id="discountAmount" class="price-col">
                           </td>
                        </tr>
                        <tr>
                           <td class="product-col">
                              <h6 class="product-title" style="max-width: none;">
                                 Grand Total 
                              </h6>
                           </td>
                           <td class="price-col">
                              RS. <span id="grandTotalDisplay">{{$total}}</span>
                              <input type="hidden" id="grandTotal" name="grandTotal" class="form-control" value="{{$total}}">
                           </td>
                        </tr>
                        @if($amount > 0)
                        <tr>
                        <td class="product-col">
                          
                           <h4><input type="checkbox" id="pay_with_wallet" form='process_order' name="pay_with_wallet" onclick="salectwallet()" value="{{$amount}}" > Use Your  ₹ {{$amount}}  Pay with Wallet </h4>
                          
                           
                           
                        </td>
                        <tr>
                        @endif
                        <tr>
                            <td></td>
                            <td>

                                           <!----------------------------------------->
  
                            </td>
                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="payment ml-30">
                        <h4 class="mb-30">Payment</h4>
                        <div class="payment_option">
                            <div class="">
                           
                                <input class="form-check-input second" type="radio" checked id="first" name="transactionType" value="1" form='process_order'>
                                <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse">Cash on delivery</label>
                            </div>
 
                            @if($account->razorPayDisplayName!=Null)
                            <div class="">
                                <input class="form-check-input second" type="radio" name="transactionType" value="2" form='process_order'>
                                <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse">Pay with Razor Pay</label>
                            </div>
                            @endif
                            <div class="">
                            <input class="form-check-input second" type="radio" name="transactionType" value="3" form='process_order'>
                                <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse">Pay with Instamojo</label>
                            </div>
                           
                        </div>
                        <div class="payment-logo d-flex">
                          
                        </div>
                        <button id="submitButton" form='process_order' type="submit" class="btn btn-fill-out btn-block mt-30">Place an Order<i class="fi-rs-sign-out ml-15"></i></button>
                    </div>
                    @endif
                </div>
               
                <!-------================---------->

            </div>
        </div>
    </main>
    {!! Form::close() !!} 

               <form action="{{ url('process_order') }}" id='process_order' method='post'>
               {{ Form::token() }}
               </form>
    <script>
   function salectwallet(){
      if (document.getElementById('pay_with_wallet').checked) 
      {
         var walletamount=document.getElementById('pay_with_wallet').value;
         var grandTotalDisplay=document.getElementById('grandTotalDisplay').innerHTML;
         if(grandTotalDisplay < walletamount){
            $(".second").attr('disabled', true);
            console.log(grandTotalDisplay);
         }else{
            $("#first").prop("checked", true);
            console.log('tow');
         }
         
      } else {
         $(".second").attr('disabled', false);
      }
      
     
   }
     
   function requestOtp() {
           var phone = $('input[name="phone"]')
           var phno = phone.val().trim()
           if (!phno) {
               phone.focus()
               return false;
           }
   
           var csrfToken = document.getElementById("csrfToken").value;
           $('#loginErrorOtp').text('')
           $('#loginError').text('')
           $.ajax({
               url: "{{ url('request_otp') }}",
               type: 'GET',
               data: "mobile=" + phno,
               dataType: 'json',
               headers: {
                   'X-CSRF-TOKEN': csrfToken,
                   'Accept': 'application/json',
                   'Content-Type': 'application/json'
               },
               success: function(data) {
   				console.log(data);
                   if (data.status) {
                       $('#old_password').prop('required', false)
                       $('#old_password').val('')
                       $('#old_password').hide()
                       $('#login_otp').show()
                       $('#login_otp').prop('required', true)
                       $('#loginErrorOtp').text('OTP sent to your number.')
                       $('#requestOTPOR').hide()
                       $('#requestOTP').text('Resend OTP')
                   } else {
                       $('#loginError').text(data.msg)
                   }
               }
           });
       }
       var clicks = 0;
   	function checkCoupon() {
       clicks += 1;
        
       
       var code = $('#coupon_code').val();
           var setting_id=$('#setting_id').val();
         
		    var subTotal = Number($('#grandTotalDisplay').html()); 
           var csrfToken = document.getElementById("csrfToken").value;
           $('#discountAmount').text('');
           $('#couponError').text('')
           $('#coupon_amount').val(0)
           $.ajax({
               url: "{{ url('check_coupon') }}",
               type: 'GET',
               data: "code=" + code + '&subTotal=' + subTotal + '&setting_id=' + setting_id + '&clicks=' +clicks,
               dataType: 'json',
               headers: {
                   'X-CSRF-TOKEN': csrfToken,
                   'Accept': 'application/json',
                   'Content-Type': 'application/json'
               },
               success: function(data) {
                   if (data.status) {
                       $('#discountAmount').text('RS.' + data.discountAmount);
                       $('#isCouponApply').show()
                       $('#coupon_amount').val(data.discountAmount)
                       $('#grandTotalDisplay').text(data.grandtotal)
                   } else {
                       $('#couponError').text(data.msg)
                   }
               }
           });
       }
   	 function proceedTOSummary(type) {
           var shiping = $('#shippingAddres')
           var zipCode = $('#shippingAddres option:selected').data('zipcode')
   		    $('#oldAddMsg').text('Checking Shipping available on selected address.')
           if (zipCode) {
               const param = {
                   "pinCode": zipCode
               };
               var csrfToken = document.getElementById("csrfToken").value;
               jQuery.ajax({
                   url: "{{route('deliverycode')}}",
                   type: "POST",
                   headers: {
                       'X-CSRF-TOKEN': csrfToken,
                       'Accept': 'application/json',
                       'Content-Type': 'application/json'
                   },
                   data: JSON.stringify({
                       data: param
                   }),
                   success: function(data) {
   					console.log(data);
                       if (data.length > 0) {
                           nextStep(type)
                       } else {
                           alert('Not able to deliver product on selected address. Choose another address or add new address.');
                       }
                   }
               });
           }else{
   			if($('#shippingAddres').val() && (!zipCode) ){
   				alert('Choose valid address or add new address.')
   			}else{
   				nextStep(type)
   			}
   
               //
           }
   
       }
   
       function nextStep(type) {
           var shiping = $('#shippingAddres')
           if (type == 1) {
   
               if (shiping.val()) {
   
                   $('.delivery_summary').addClass('hide');
                   $('.delivery_address_header').css('background', '#ec0000');
                   //$('.order_summary').removeClass('hide');
                   $('.delivery_summary input').prop('required', false)
   				 addresscode()
               } else {
                   shiping.focus()
               }
           } else if (type == 2) {
               $('#oldAddress').hide();
               $('#newAddress').removeClass('hide')
               shiping.prop('disabled', true)
           }
       }
   	 function addresscode() {
           var shiping = $('#shippingAddres')
           var zipCode = $('#shippingAddres option:selected').data('zipcode')
           var preZip = "{{Session::get('addressCode')}}";
   		console.log(zipCode+'/'+preZip);
           //if (zipCode!=preZip) {
               const param = {
                   "pinCode": zipCode,
   				"pinCodeId":shiping.val()
               };
               var csrfToken = document.getElementById("csrfToken").value;
               jQuery.ajax({
                   url: "{{route('addresscode')}}",
                   type: "POST",
                   headers: {
                       'X-CSRF-TOKEN': csrfToken,
                       'Accept': 'application/json',
                       'Content-Type': 'application/json'
                   },
                   data: JSON.stringify({
                       data: param
                   }),
                   success: function(data) {
   					console.log(data);
                       if (data.status) {
                           window.location.reload();
                       }
                   }
               });
           //}
   
       }
       
    
</script>
@endsection