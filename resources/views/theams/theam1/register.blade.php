@extends('theams/theam1/layouts.app')

@section('theme1Content')

    <!-- Page Banner -->

    <div class="page-banner container-fluid no-padding">

        <!-- Container -->

        <div class="container">

            <div class="banner-content">

                <h3>Register</h3>

            </div>

            <ol class="breadcrumb">

                <li><a href="/" title="Home">Home</a></li>

                <li class="active">Register</li>

            </ol>

        </div><!-- Container /- -->

    </div><!-- Page Banner /- -->


    <!-- Register Section -->

    <div class="contact-us container-fluid no-padding">


        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3">

            <div class="form-detail">

                <!-- Section Header -->

                <div class="section-header">

                    <h3>Register</h3>
					@if($errors->any())
                        <h4>{{$errors->first()}}</h4>
                    @endif

                </div><!-- Section Header /- -->

                {!! Form::open(['route' => 'registerSubmit','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
                {{ csrf_field() }}

                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                        <input type="text" name="name" class="form-control" placeholder="Name *" required/>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                        <input type="number" name="phone" class="form-control" placeholder="Phone number without contry code*" required/>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email address *" required/>
                    </div>
					<div class="col-md-6 col-sm-6 col-xs-12 form-group">
                        <input type="text" name="landmark" class="form-control" placeholder="Landmark *" required/>
                    </div>
					<div class="col-md-12 col-sm-12 col-xs-12 form-group">
                        <input type="text" name="address" class="form-control" placeholder="Address *" required/>
                    </div>
					<div class="col-md-6 col-sm-6 col-xs-12 form-group">
                        <input type="number" name="zipCode" id="zipCode" placeholder="Zip Code" onchange="zipCodeCheck(this.value);" class="form-control" required/>
                        <p id="zipMSG"></p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password *" required>
                    </div>
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <input type="hidden" value="{{ csrf_token() }}" id="csrfToken">
                        <button title="Submit" type="submit" name="post">Sign Up</button>
                    </div>
                    

                {!! Form::close() !!} 



                <div class="col-md-12 col-sm-12 col-xs-12">

                    <h5 class="entry-title">

                        Already have an account? <a href="{{route('login')}}"><span class="read-more">Login</span></a>

                    </h5>

                </div>



            </div>

        </div>

    </div>

    <!-- Register Section /- -->



    @endsection