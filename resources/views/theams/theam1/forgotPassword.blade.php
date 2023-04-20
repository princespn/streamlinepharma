@extends('theams/theam1/layouts.app')

@section('theme1Content')



    <!-- Page Banner -->

    <div class="page-banner container-fluid no-padding">

        <!-- Container -->

        <div class="container">

            <div class="banner-content">

                <h3>Forgot Password</h3>

            </div>

            <ol class="breadcrumb">

                <li><a href="/" title="Home">Home</a></li>

                <li class="active">Forgot Password</li>

            </ol>

        </div><!-- Container /- -->

    </div><!-- Page Banner /- -->



    <!-- Forgot Password Section -->

    <div class="contact-us container-fluid no-padding">



        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3">

            <div class="form-detail">

                <!-- Section Header -->

                <div class="section-header">

                    <h3>Forgot Password</h3>
                    @if($errors->any())
                        <h4>{{$errors->first()}}</h4>
                    @endif

                </div><!-- Section Header /- -->
    

                @if($OTP)
                   
                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                            <input type="text" id="enteredPhone" class="form-control" value="{{$phone}}" required readonly/>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                            <input type="text" id="enteredOTP" class="form-control" placeholder="Enter OTP*" required/>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                            <input type="password" id="enteredPassword" class="form-control" placeholder="Enter new password *" required/>
                        </div>

                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <button type="button" onclick="changePassword();">Change Password</button>
                        </div>

                        <input type="hidden" id="generatedOTP" class="form-control" value="{{$OTP}}" required required/>
                        <input type="hidden" value="{{ csrf_token() }}" id="csrfToken">
                    
                @else

                    {!! Form::open(['route' => 'forgotPasswordSubmit','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
                    {{ csrf_field() }}

                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                            <input type="text" name="phone" class="form-control" placeholder="Phone Number *" required/>
                        </div>

                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <button title="Submit" type="submit" name="post">Send OTP</button>
                        </div>

                    {!! Form::close() !!}

                @endif

                
                <div class="col-md-12 col-sm-12 col-xs-12">

                    <h5 class="entry-title">

                        Return to login click here <a href="{{route('login')}}"><span class="read-more">Login</span></a>

                    </h5>

                </div>

            </div>

        </div>

    </div>

    <!-- Forgot Password Section /- -->



    @endsection