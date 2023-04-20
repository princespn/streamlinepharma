@extends('theams/theam1/layouts.app')
@section('theme1Content')
{!! Form::open(['route' => 'confirmOrder','method'=>'POST','id'=>'formCheckOut','enctype'=>'multipart/form-data']) !!}
{{ csrf_field() }}
<!-- Page Banner -->
<!--div class="page-banner container-fluid no-padding">
   <div class="container">
   
       <div class="banner-content">
   
           <h3>Login</h3>
   
       </div>
   
       <ol class="breadcrumb">
   
           <li><a href="/" title="Home">Home</a></li>
   
           <li class="active">Login</li>
   
       </ol>
   
   </div>
   
   </div--><!-- Page Banner /- -->
<style>
   .hide{
   display:none;
   }
   .section-header{
   margin-bottom:0px !important;
   }
   .form-detail{
   margin-bottom:30px !important;
   }
</style>
<!-- Login Section -->
<div class="contact-us container-fluid no-padding">
   <div class="row">
      <div class="col-md-6 col-sm-6 col-md-offset-1 col-xs-12 ">
         <div class="form-detail" style="
            padding-top: 23px;
            padding: 0px;
            margin-bottom: 10px;
            ">
            <!-- Section Header -->
            <div class="section-header" style="
               text-align: left;
               background: #ec0000;
               color: #fff !important;
               padding: 12px;
               ">
               <h3 class="" style="color: #fff;margin-bottom: 0px;">
                  @if(Session::get('register'))
                  1-  Welcome {{Session::get('register')->name}}
                  @else
                  1- Login or SignUp
                  @endif 
               </h3>
            </div>
            @if($errors->any())
            <h4>{{$errors->first()}}</h4>
            @endif
            <!-- Section Header /- -->
            @if(!Session::get('register'))
            <input name="_token" type="hidden" value="mS9hGqSxiWHHDKnBwZGAN9TC2pDN4So7TYd2A9Lf">
            <input type="hidden" name="_token" value="mS9hGqSxiWHHDKnBwZGAN9TC2pDN4So7TYd2A9Lf">
            <br>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
               <input type="number" name="phone" id='pre_phone' class="form-control" placeholder="Enter your phone number *" required="">
               <span class='hide change_number_btn' onclick='resetLoginForm()' style='padding: 3px 5px;
                  cursor: pointer;
                  background: #fff;
                  display: inline-block;
                  margin-top: 5px;
                  border: 1px solid #EC0000;
                  font-size: 12px;'>Change Number</span>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group new_login hide" >
               <input type="number" name="new_otp" id='new_otp' class="form-control" placeholder="Enter OTP" required="">
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group new_login hide"  >
               <input type="password" name="set_password" id='set_password' class="form-control" placeholder="Set Password" required="">
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group old_login hide"  >
               <input type="password" name="old_password" id='old_password' class="form-control" placeholder="Enter Your Password" required="">
               <input type="password" style="display: none;" name="login_otp" id="login_otp" class="form-control" placeholder="Enter OTP *">
               <span id="loginErrorOtp" style="color: red;"></span>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group" style="
               /* display: none; */
               ">
               By continuing, you agree to Terms and Conditions
            </div>
            <div class="form-group col-md-12 col-sm-12 col-xs-12 old_login hide" >
               <button  class='' type="button" name="post" onclick="checkLoginDetails()">Continue to Login</button>
               <br/>
               <div class="" id="requestOTPOR" style="text-align: center;">OR</div>
               <br/>
               <div class="">
                  <button title="Request OTP" id="requestOTP" onclick="requestOtp()" type="button" name="post">Request OTP</button>
                  <input type="hidden" value="{{ csrf_token() }}" id="csrfToken">
               </div>
            </div>
            <div class="form-group col-md-12 col-sm-12 col-xs-12 new_login hide" >
               <button title="Submit" type="button" name="post" onclick="ajaxSignUp()">Continue to Sign Up</button>
            </div>
            <div class="form-group col-md-12 col-sm-12 col-xs-12 pre_set_btn">
               <button title="Submit" type="button" name="post" onclick="checkMobile()">Continue</button>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group ajax_message_response">
            </div>
            <h5>
               Forgotten your password? <a class="active" href="https://mountmiller.com/forgotPassword">Recover Password</a>
            </h5>
            </form>
            @endif
            <div class="col-md-12 col-sm-12 col-xs-12" style="
               display: none;
               ">
               <h5 class="entry-title">
                  Dont have an account? <a href="https://mountmiller.com/backup/public/register"><span class="read-more">Register</span></a>
               </h5>
               <h5>
                  Forgotten your password? <a class="active" href="https://mountmiller.com/backup/public/forgotPassword">Recover Password</a>
               </h5>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-6 col-sm-6 col-md-offset-1 col-xs-12 ">
         <div class="form-detail" style="
            padding-top: 23px;
            padding: 0px;
            ">
            <!-- Section Header -->
            <div class="section-header delivery_address_header" style="
               text-align: left;
               background: grey;
               color: #fff !important;
               padding: 12px;
               margin-bottom: 0px;
               " onclick='proceedtoAddress()'>
               <h3 class="" style="color: #fff;margin-bottom: 0px;">2 Delivery Address</h3>
            </div>
            <!-- Section Header /- -->
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
                        <select class="form-control" id="shippingAddres" name="shipping_address">
                           <option value="">Select Address</option>
                           @foreach ($allAddresses as $add)
                           <option value="{{$add->id}}"  data-zipCode="{{$add->zipCode}}"
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
                        <button type="button" id="" class="btn btn-primary" onclick='proceedTOSummary(1)'>Continue</button>
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
   <div class="row">
      <div class="col-md-6 col-sm-6 col-md-offset-1 col-xs-12 ">
         <div class="form-detail " style="
            padding-top: 23px;
            padding: 0px;
            ">
            <!-- Section Header -->
            <div class="section-header order_summary_header" style="
               text-align: left;
               background: grey;
               color: #fff !important;
               padding: 12px;
               margin-bottom: 0px;
               ">
               <h3 class="" style="color: #fff;margin-bottom: 0px;">3 Order Summary</h3>
            </div>
            <!-- Section Header /- -->
            <div class="col-md-12 col-sm-12 col-xs-12 order_summary  @if(!Session::get('addressCodeID')) hide @endif">
               <!----------------------------------------->
               <h4>
                  <a data-toggle="collapse" href="#order-cart-section" class="collapsed" role="button" aria-expanded="true" aria-controls="order-cart-section">{{count($cartList)}} products in Cart</a>
               </h4>
               <div class="collapse in" id="order-cart-section" style="">
                  <table class="table table-mini-cart">
                     <tbody>
                        @php $total = 0; @endphp
                        @foreach ($cartList as $item)
                        
                        <tr>
                           <td class="product-col">
                              <figure class="product-image-container">
                                 <img src="{{ $item->product->thumbnail }}" style="height: 50px;">
                              </figure>
                              <div>
                                 <h2 class="product-title" style="max-width: none;">
                                    {{ $item->product->title }}  
                                 </h2>
                                 <span class="product-qty">Qty: {{$item->qty}}</span>
                                 <br>
                                 <span class="product-qty">
                                   
                                 </span>
                              </div>
                           </td>
                           <td class="price-col">
						      @if(!$item->scheme_id)
                              Rs {{number_format(($item->product->selling_price) * ($item->qty),2)}}
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
                              <h2 class="product-title" style="max-width: none;">
                                 Sub Total
                              </h2>
                           </td>
                           <td class="price-col">Rs {{number_format($total,2)}}
						   <br>
						   <small>Incl :  Tax</small>
						   </td>
                        </tr>
                        <!--tr>
                           <td class="product-col">
                              <h2 class="product-title" style="max-width: none;">
                                 Tax
                              </h2>
                           </td>
                           <td class="price-col">Rs 0</td>
                        </tr-->
                        <tr>
                           <td class="product-col">
                              <h2 class="product-title" style="max-width: none;">
                                 Shipping
                              </h2>
                           </td>
                           <td class="price-col">
                              RS. <span id="shipmentDisplay">0</span>
                           </td>
                        </tr>
                        <tr>
                           <td class="product-col">
                              
                              <h2 class="product-title">Apply Coupon</h2>
                           </td>
                           <td>
                              <input type="text" name="coupon" placeholder="Coupon Code" form='process_order' id="coupon_code" />
                             
                             <input type="hidden" name="product_id" id="product_id" form='process_order' value="{{$item->product_id}}" />
                              <input type="hidden" name="setting_id" id="setting_id" form='process_order' value="{{$item->product->setting_id}}" />
                              <button type="button" class="btn" onclick="checkCoupon()">Apply</button>
                              
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
                              <h2 class="product-title" style="max-width: none;">
                                 Grand Total 
                              </h2>
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
                     </tbody>
                  </table>
               </div>
               <!----------------------------------------->
               <button type="button" id="" class="btn btn-primary" onclick='proceedToPaymentOption()'>Continue</button>
               <br>
               <br>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-6 col-sm-6 col-md-offset-1 col-xs-12 ">
         <div class="form-detail" style="
            padding-top: 23px;
            padding: 0px;
            ">
            <!-- Section Header -->
            <div class="section-header" style="
               text-align: left;
               background: grey;
               color: #fff !important;
               padding: 12px;
               margin-bottom: 0px;
               ">
               <h3 class="" style="color: #fff;margin-bottom: 0px;">4 Payment Options</h3>
            </div>
            <!-- Section Header /- -->
            <div class="col-md-12 col-sm-12 col-xs-12">
               <!---------------------------------------------------------->
			   
               <table class="table payment_div_summary hide" style="border:0px">
                  <tbody>
                 
                   
                    
                     <tr>
                        <td>
                           <h4><input type="radio" class="second" id="first" name="transactionType" value="1" form='process_order'> Cash on delivery</h4>
                        </td>
                     </tr>
				@if($account->razorPayDisplayName!=Null)
                     <tr>
                        <td>
                           <h4><input type="radio" class="second" name="transactionType" value="2" form='process_order'> Pay with Razor Pay</h4>
                        </td>
                     </tr>
				@endif
                     <tr>
                        <td>
                           <h4><input type="radio" class="second" name="transactionType" value="3" form='process_order'> Pay with Instamojo</h4>
                        </td>
                     </tr>
                     
                     <tr>
                       

                     </tr>
                   
                     <tr>
                        <td>
                           <button type="submit" id="submitButton" class="btn btn-primary" form='process_order'>Confirm</button>
                        </td>
                     </tr>
                  </tbody>
               </table>
			   
               <!---------------------------------------------------------->
            </div>
         </div>
      </div>
   </div>
</div>
{!! Form::close() !!} 

               <form action="{{ url('process_order') }}" id='process_order' method='post'>
               {{ Form::token() }}
               </form>
<!-- Login Section /- -->
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