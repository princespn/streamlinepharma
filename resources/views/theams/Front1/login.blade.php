@extends('theams/Front1/app') 
@section('title','Product Detail') 


@section('MainSection')

<main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Pages <span></span> My Account
                </div>
            </div>
        </div>
        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                        <div class="row">
                            <div class="col-lg-6 pr-30 d-none d-lg-block">
                                <img class="border-radius-15" src="assets/imgs/page/login-1.png" alt="" />
                            </div>
                            <div class="col-lg-6 col-md-8">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h1 class="mb-5">Login</h1>
                                            <p class="mb-30">Don't have an account? <a href="{{url('useregister')}}">Create here</a></p>
                                        </div>
                                        {!! Form::open(['route' => 'userloginSubmit','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
                                        {{ csrf_field() }}
                                            <div class="form-group">
                                                <input type="number" required="" name="phone" placeholder="Enter your mobile *" />
                                                <span id="loginError" style="color: red;"></span>
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="password" id="password" name="password" placeholder="Your password *" />
                                                <input type="password" style="display: none;" name="login_otp" id="login_otp" class="form-control" placeholder="Enter OTP *">
                                                <span id="loginErrorOtp" style="color: red;"></span>
                                            </div>
                                          

                                            <div class="login_footer form-group mb-50">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="" />
                                                        <label class="form-check-label" for="exampleCheckbox1"><span>Remember me</span></label>
                                                    </div>
                                                </div>
                                                <a class="text-muted" href="{{url('forgotPasswordUser')}}">Forgot password?</a>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-heading btn-block hover-up" name="login">Log in</button>

                                                <button title="Request OTP" class="btn btn-heading btn-block hover-up" id="requestOTP" onclick="requestOtp()" type="button" name="post">Request OTP</button>
                                            </div>
                                            {!! Form::close() !!} 
                                            <input type="hidden" value="{{ csrf_token() }}" id="csrfToken">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
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
@endsection