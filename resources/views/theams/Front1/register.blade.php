@extends('theams/Front1/app') 
@section('title','Manage Product') 

@section('MainSection')
 <!--End header-->
 <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Register <span></span>
                </div>
            </div>
        </div>
        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                        <div class="row">
                            <div class="col-lg-6 col-md-8">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h1 class="mb-5">Create an Account</h1>
                                            @if($errors->any())
                                                <h4 style="color-red">{{$errors->first()}}</h4>
                                               
                                            @endif
                                            <p class="mb-30">Already have an account? <a href="{{url('userlogin')}}">Login</a></p>
                                        </div>
                                        {!! Form::open(['route' => 'useregisterSubmit','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
                                         {{ csrf_field() }}
                                            <div class="form-group">
                                                <input type="text" required="" name="name" placeholder="Username" />
                                            </div>
                                            <div class="form-group">
                                                <input type="text" required="" name="phone" placeholder="phone" />
                                            </div>
                                            <div class="form-group">
                                                <input type="text" required="" name="email" placeholder="Email" />
                                            </div>
                                            <div class="form-group">
                                                <input type="text" required="" name="landmark" placeholder="Landmark" />
                                            </div>
                                            <div class="form-group">
                                                <input type="text" required="" name="address" placeholder="Address" />
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="password" name="password" placeholder="Password" />
                                            </div>
                                         
                                            <div class="form-group">
                                                    <input type="number" required="" name="zipCode" id="zipCode" onchange="zipCodeCheck(this.value);" placeholder="Zip Code *" />
                                        
                                            </div>
                                           
                                            <div class="login_footer form-group mb-50">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox12" value="" />
                                                        <label class="form-check-label" for="exampleCheckbox12"><span>I agree to terms &amp; Policy.</span></label>
                                                    </div>
                                                </div>
                                                <a href="page-privacy-policy.html"><i class="fi-rs-book-alt mr-5 text-muted"></i>Lean more</a>
                                            </div>
                                            <div class="form-group mb-30">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up font-weight-bold" name="login">Submit &amp; Register</button>
                                            </div>
                                            <p class="font-xs text-muted"><strong>Note:</strong>Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy</p>
                                            {!! Form::close() !!} 
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 pr-30 d-none d-lg-block">
                                <div class="card-login mt-115">
                                    <a href="#" class="social-login facebook-login">
                                        <img src="front_assets/imgs/theme/icons/logo-facebook.svg" alt="" />
                                        <span>Continue with Facebook</span>
                                    </a>
                                    <a href="#" class="social-login google-login">
                                        <img src="front_assets/imgs/theme/icons/logo-google.svg" alt="" />
                                        <span>Continue with Google</span>
                                    </a>
                                    <a href="#" class="social-login apple-login">
                                        <img src="front_assets/imgs/theme/icons/logo-apple.svg" alt="" />
                                        <span>Continue with Apple</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection