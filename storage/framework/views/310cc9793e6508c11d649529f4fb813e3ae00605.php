<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Razorpay Payment Gateway </title>
    
</head>
<body>
    <form method="POST" action="https://api.razorpay.com/v1/checkout/embedded">
	  <input type="hidden" name="key_id" value="<?php echo e($account->razorPayApiKey); ?>">
	  <input type="hidden" name="order_id" value="<?php echo e($razorpay_order_id); ?>">
	  <input type="hidden" name="name" value="<?php echo e($account->title); ?>">
	  <input type="hidden" name="description" value="Payment to <?php echo e($account->domain); ?>">
	  <input type="hidden" name="image" value="https://<?php echo e($account->domain.'/'.$account->logo); ?>">
	  <input type="hidden" name="prefill[name]" value="<?php echo e($user_data['name']); ?>">
	  <input type="hidden" name="prefill[contact]" value="<?php echo e($user_data['contact']); ?>">
	  <input type="hidden" name="prefill[email]" value="<?php echo e($user_data['email']); ?>">
	  <input type="hidden" name="notes[shipping address]" value="">
	  <!--input type="hidden" name="subscription_id" value="sub_HLjAvoZwaDy2OC"-->
	  <input type="hidden" name="callback_url" value="<?php echo e(url('order_r_process')); ?>">
	  <input type="hidden" name="cancel_url" value="<?php echo e(url('cancel_payment')); ?>">
	</form>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script> 
		$(document).ready(function(){
					
				$("form").submit(); 
			
		});
	</script>
</body>
</html><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/theams/theam1/razorpayView.blade.php ENDPATH**/ ?>