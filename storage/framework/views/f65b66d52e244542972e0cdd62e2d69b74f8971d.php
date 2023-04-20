<?php $__env->startSection('theme1Content'); ?>



    <!-- Page Banner -->

    <div class="page-banner container-fluid no-padding">

        <!-- Container -->

        <div class="container">

            <div class="banner-content">

                <h3>Login</h3>

            </div>

            <ol class="breadcrumb">

                <li><a href="/" title="Home">Home</a></li>

                <li class="active">Login</li>

            </ol>

        </div><!-- Container /- -->

    </div><!-- Page Banner /- -->



    <!-- Login Section -->

    <div class="contact-us container-fluid no-padding">



        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3">

            <div class="form-detail">

                <!-- Section Header -->

                <div class="section-header">

                    <h3>Welcome Back!</h3>
                    <?php if($errors->any()): ?>
                        <h4><?php echo e($errors->first()); ?></h4>
                    <?php endif; ?>
                   

                </div><!-- Section Header /- -->

                <?php echo Form::open(['route' => 'loginSubmit','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']); ?>

                <?php echo e(csrf_field()); ?>


                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                        <input type="number" name="phone" class="form-control" placeholder="Enter your phone number *" required/>
						<span id="loginError" style="color: red;"></span>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter password *" required>
						<input type="password" style="display: none;" name="login_otp" id="login_otp" class="form-control" placeholder="Enter OTP *">
                <span id="loginErrorOtp" style="color: red;"></span>
                    </div>
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <button title="Submit" type="submit"  name="post">Login</button>
                    </div>
            <div class="form-group col-md-12 col-sm-12 col-xs-12" style="text-align: center;" id="requestOTPOR">OR</div>
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <button title="Request OTP" id="requestOTP" onclick="requestOtp()" type="button" name="post">Request OTP</button>
            </div>

                <?php echo Form::close(); ?> 
<input type="hidden" value="<?php echo e(csrf_token()); ?>" id="csrfToken">
                <div class="col-md-12 col-sm-12 col-xs-12">

                    <!--h5 class="entry-title">

                        Dont have an account? <a href="<?php echo e(route('register')); ?>"><span class="read-more">Register</span></a>

                    </h5-->

                    <h5>

                        Forgotten your password? <a class="active" href="<?php echo e(route('forgotPassword')); ?>">Recover Password</a>

                    </h5>

                </div>

            </div>

        </div>

    </div>

    <!-- Login Section /- -->

<script>
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
            url: "<?php echo e(url('request_otp')); ?>",
            type: 'GET',
            data: "mobile=" + phno,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            success: function(data) {
                if (data.status) {
                    $('#password').prop('required', false)
                    $('#password').val('')
                    $('#password').hide()
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
</script>

    <?php $__env->stopSection(); ?>
<?php echo $__env->make('theams/theam1/layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/theams/theam1/login.blade.php ENDPATH**/ ?>