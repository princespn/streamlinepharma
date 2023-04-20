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
                    <div class="col-xl-4 col-lg-6 col-md-12 m-auto">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <img class="border-radius-15" src="assets/imgs/page/forgot_password.svg" alt="" />
                                    <h2 class="mb-15 mt-15">Forgot your password?</h2>
                                    @if($errors->any())
                        <h4>{{$errors->first()}}</h4>
                    @endif
                                </div>
                                @if($OTP)
                                <div class="form-group">
                                        <input type="text" id="enteredPhone" required="" value="{{$phone}}"  />
                                </div>
                                <div class="form-group">
                                        <input type="text" id="enteredOTP" required="" name="phone" placeholder="Enter OTP*" />
                                </div>
                                <div class="form-group">
                                        <input type="password" id="enteredPassword" required=""  placeholder="Enter new password *" />
                                </div>
                                <div class="form-group">
                                <button type="button" class="btn btn-heading btn-block hover-up" onclick="changePassword();">Change Password</button>
                                </div>
                                <div class="form-group">
                                        
                                <input type="hidden" id="generatedOTP" class="form-control" value="{{$OTP}}" required required/>
                                <input type="hidden" value="{{ csrf_token() }}" id="csrfToken">
                                </div>

                                @else
                                {!! Form::open(['route' => 'forgotPasswordSubmitUser','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
                                {{ csrf_field() }}
                                    <div class="form-group">
                                        <input type="text" required="" name="phone" placeholder="Enter Phone Number" />
                                    </div>
                                    
                                   
                                    <div class="form-group">
                                        <button type="submit" title="Submit" class="btn btn-heading btn-block hover-up" name="login">SEND OTP</button>
                                    </div>
                                {!! Form::close() !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
    
</script>
@endsection