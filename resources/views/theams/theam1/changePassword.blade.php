@extends('theams/theam1/layouts.app')

@section('theme1Content')



    <!-- Page Banner -->

    <div class="page-banner container-fluid no-padding">

        <!-- Container -->

        <div class="container">

            <div class="banner-content">

                <h3>Change Password</h3>

            </div>

            <ol class="breadcrumb">

                <li><a href="/" title="Home">Home</a></li>

                <li class="active">Change Password</li>

            </ol>

        </div><!-- Container /- -->

    </div><!-- Page Banner /- -->  

    <div class="container-fluid no-left-padding no-right-padding woocommerce-checkout">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">                     
    
                    {!! Form::open(['route' => 'changePasswordSubmit','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
                    {{ csrf_field() }}
                        <h3 style="margin-left: 15px;">Change Password</h3>
                        @if($errors->any())
                            <div class="alert alert-danger" style="margin-left: 10px;">
                                {{$errors->first()}}
                            </div>
                        @endif
                            <div class="col-md-6 col-sm-6 col-xs-6 form-group">
                                <input type="password" name="password" class="form-control" placeholder="Enter new password *" required/>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 form-group">
                                <input type="password" name="confirmPassword" class="form-control" placeholder="Enter Confirm password *" required/>
                            </div>
    
                            <div class="form-footer form-group col-md-6 col-sm-6 col-xs-6">
                                <button type="submit" class="btn btn-primary" >Change Password</button>
                            </div>                 
    
                    {!! Form::close() !!}           
    
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div id="footer-main" class="footer-main container-fluid" style="padding-left:20px;">

                        <!-- Container -->
            
                        <div class="container">
            
                            <div class="row">
            
                                <!-- Widget Links -->
            
                                <aside class="col-md-3 col-sm-6 col-xs-6 ftr-widget widget_links">
            
                                    <h4 style="margin-top: -45px;padding-bottom:10px;">Useful Link</h4>
            
                                    @include('theams.theam1.account_menu');
            
                                </aside>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="padding-bottom: 30px;"></div>
        </div>         
    </div>

    <!-- Login Section /- -->



    @endsection