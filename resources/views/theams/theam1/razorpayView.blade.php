<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Razorpay Payment Gateway </title>
    
</head>
<body>
    <form method="POST" action="https://api.razorpay.com/v1/checkout/embedded">
	  <input type="hidden" name="key_id" value="{{ $account->razorPayApiKey }}">
	  <input type="hidden" name="order_id" value="{{ $razorpay_order_id }}">
	  <input type="hidden" name="name" value="{{ $account->title }}">
	  <input type="hidden" name="description" value="Payment to {{ $account->domain }}">
	  <input type="hidden" name="image" value="https://{{ $account->domain.'/'.$account->logo }}">
	  <input type="hidden" name="prefill[name]" value="{{ $user_data['name'] }}">
	  <input type="hidden" name="prefill[contact]" value="{{ $user_data['contact'] }}">
	  <input type="hidden" name="prefill[email]" value="{{ $user_data['email'] }}">
	  <input type="hidden" name="notes[shipping address]" value="">
	  <!--input type="hidden" name="subscription_id" value="sub_HLjAvoZwaDy2OC"-->
	  <input type="hidden" name="callback_url" value="{{ url('order_r_process') }}">
	  <input type="hidden" name="cancel_url" value="{{ url('cancel_payment') }}">
	</form>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script> 
		$(document).ready(function(){
					
				$("form").submit(); 
			
		});
	</script>
</body>
</html>