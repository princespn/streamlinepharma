@extends('FrontEndTheme.Nest.layout.layout')
@section('title', 'Forgot Password')
@section('page-content')
<main class="main pages">
        
        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 m-auto">
                        <div class="row">
                            <div class="col-lg-6 col-md-8 col-sm-12 col-12" style="margin:auto">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h1 class="mb-5">Forgot Password</h1>
                                            
                                        </div>
                                        <form method="post">
										    @csrf
                                            <div class="mb-3 mt-3">
												<label for="login_email" class="form-label">E Mail or Mobile:</label>
												<input type="text" class="form-control" id="login_email" placeholder="Enter EMail or Mobile" name="login_email">
                                            </div>
											
											
											
											
											
											
											<span class='login_error'></span>
											
											
											<div class="mb-3 mt-3 otp_div">
												<label for="otp" class="form-label">OTP:</label>
												<input type="text" class="form-control" id="otp" placeholder="Enter otp" name="otp">
                                            </div>
											<span class='otp_error'></span>
											
											
											<div class="mb-3 mt-3 otp_div">
												<label for="otp" class="form-label">New Password:</label>
												<input type="password" class="form-control" id="new_password" placeholder="Enter New Password" name="new_password">
                                            </div>
											
											
											<button type="button" class="btn btn-primary send_otp_btn" onclick='initiateForgotPassoword()'>Send OTP</button>
											<button type="button" class="btn btn-primary otp_div" onclick='submitNewForgotPassoword()'>Submit</button>
											<p><a href="{{ url('forogot-password') }}">Click here to login or create new account.</a></p>
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
@endsection
@push('custom-css')
<style>
  .otp_div{
    display:none;
  }
</style>
@endpush
@push('custom-scripts')
<script>
function initiateForgotPassoword(){
	var email      = $('#login_email').val();
	var myKeyVals = { 
	                  email    : email,
	                  _token   : $('input[name=_token]').val(),
					}
	var saveData = $.ajax({
		  type: 'POST',
		  url: "{{ url('forgot_password_otp_genrate') }}",
		  data: myKeyVals,
		  dataType: "text",
		  success: function(data){ 
		     data = JSON.parse(data);
			 $('.login_error').html(data.message);
			 if(data.error==false){
				 $('.otp_div').show();
				 $('.send_otp_btn').hide();
			 }else{
				 $('.otp_div').hide();
				 $('.send_otp_btn').show();
			 }
		  }
	});
    saveData.error(function(){ 
	    $('.login_error').html('Something went wrong, please try after some time.');
	});
}
function submitNewForgotPassoword(){
	var email        = $('#login_email').val();
	var otp          = $('#otp').val();
	var new_password = $('#new_password').val();
	var myKeyVals = { 
	                  email        : email,
	                  otp          : otp,
	                  new_password : new_password,
	                  _token       : $('input[name=_token]').val(),
					}
	var saveData = $.ajax({
		  type: 'POST',
		  url: "{{ url('submitNewForgotPassoword') }}",
		  data: myKeyVals,
		  dataType: "text",
		  success: function(data){ 
		     data = JSON.parse(data);
			 $('.otp_error').html(data.message);
			 if(data.error==false){
				 alert(data.message);
				 window.location = "{{ url('login') }}";
			 }
		  }
	});
    saveData.error(function(){ 
	    $('.otp_error').html('Something went wrong, please try after some time.');
	});
}

</script>
@endpush