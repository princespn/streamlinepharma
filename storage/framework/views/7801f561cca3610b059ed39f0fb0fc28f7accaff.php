
<?php $__env->startSection('title', 'Login & Registration'); ?>
<?php $__env->startSection('page-content'); ?>
<main class="main pages">
        
        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 m-auto">
                        <div class="row">
                            <div class="col-lg-6 col-md-8">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h1 class="mb-5">Login</h1>
                                            
                                        </div>
                                        <form method="post">
										    <?php echo csrf_field(); ?>
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
											<p><a href="<?php echo e(url('forogot-password')); ?>">Forgot your password? Reset here</a></p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 pr-30 d-none d-lg-block">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h1 class="mb-5">Create an Account</h1>
                                            
                                        </div>
                                        <form method="post" action="<?php echo e(url('sign_up_process')); ?>" id='sign_up_form' onsubmit='return initiateSignUP();'>
										    <?php echo csrf_field(); ?>
                                            <div class="mb-3 mt-3">
												<label for="name" class="form-label">Name:</label>
												<input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" required>
                                            </div>
											<div class="mb-3 mt-3">
												<label for="phone" class="form-label">Phone:</label>
												<input type="text" class="form-control" id="phone" placeholder="Enter Phone" name="phone" required>
                                            </div>
											<div class="mb-3 mt-3">
												<label for="email" class="form-label">EMail:</label>
												<input type="email" class="form-control" id="email" placeholder="Enter EMail" name="email" required>
                                            </div>
											<div class="mb-3 mt-3">
												<label for="passwordv" class="form-label">Password:</label>
												<input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" required>
                                            </div>
											<div class="mb-3 mt-3 otp_div">
												<label for="otp" class="form-label">OTP:</label>
												<input type="text" class="form-control" id="otp" placeholder="Enter otp" name="otp">
                                            </div>
											<span class='sign_up_error'></span>
											<button type="submit" class="btn btn-primary sign_up_button">Sign Up</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-css'); ?>
<style>
  .otp_div{
    display:none;
  }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('custom-scripts'); ?>
<script>
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
		  url: "<?php echo e(url('login_check')); ?>",
		  data: myKeyVals,
		  dataType: "text",
		  success: function(data){ 
		     data = JSON.parse(data);
			 $('.login_error').html(data.message);
			 if(data.error==false){
				 window.location = "<?php echo e(url('dashboard')); ?>";
			 }
		  }
	});
    saveData.error(function(){ 
	    $('.mobile_error').html('Something went wrong, please try after some time.');
	});
}
function initiateSignUP(){
	
		var saveData = $.ajax({
			  type: 'POST',
			  url: "<?php echo e(url('initiate_sign_up')); ?>",
			  data: $("#sign_up_form").serialize(),
			  dataType: "text",
			  success: function(data){ 
				 data = JSON.parse(data);
				 $('.sign_up_error').html(data.message);
				 if(data.error==false){
					 if(data.is_logged==true){
					     window.location = "<?php echo e(url('dashboard')); ?>";
					 }else{
						 $('.otp_div').show();
					 }
				 }
				 return false;
			  }
		});
		saveData.error(function(){ 
			$('.sign_up_error').html('Something went wrong, please try after some time.');
		});
		return false;
	
}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('FrontEndTheme.Nest.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/FrontEndTheme/Nest/login.blade.php ENDPATH**/ ?>