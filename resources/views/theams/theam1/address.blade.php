@extends('theams/theam1/layouts.app')

@section('theme1Content')



    <!-- Page Banner -->

    <div class="page-banner container-fluid no-padding">

        <!-- Container -->

        <div class="container">

            <div class="banner-content">

                <h3>Address</h3>

             
             


            </div>

            <ol class="breadcrumb">

                <li><a href="/" title="Home">Home</a></li>

                <li class="active">Update Address</li>

            </ol>

        </div><!-- Container /- -->

    </div><!-- Page Banner /- -->  
<style>
    .cust-address {
        width: 100%;
        float: left;
    }

    .cust-address>li {
        width: 47%;
        float: left;
        border: 1px solid;
        border-radius: 10px;
        padding: 14px;
        margin: 5px;
    }
</style>
    <div class="container-fluid no-left-padding no-right-padding woocommerce-checkout">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12"> 
                     
    
                        {!! Form::open(['route' => 'addressSubmit','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
                        {{ csrf_field() }}
                        <h3>Recover Address</h2>
                            @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
						 @if(isset($allAddresses) && $allAddresses->count()>0)
                    <ul class="cust-address" id="oldAddress">
                        @foreach ($allAddresses as $add)
                        <li id="{{$add->id}}">
                            {{$add->name}} ,<br />{{$add->phone}} ,<br />{{$add->landmark}} ,<br />{{$add->address}},<br /> {{$add->zipCode}}<br/>
                            <a title="Edit" href="?address={{$add->id}}" class="btn btn-primary">Edit</a>
                        </li>
                        @endforeach
                    </ul>
                    @endif
					 @if(isset($addresses) && $addresses)
                            <div class="col-md-6 col-sm-6 col-xs-6 form-group">
                                <label>Name </label>
                                <input type="text" name="name" class="form-control" value="{{$addresses['name']}}" require>
								<input type="hidden" name="id" class="form-control" value="{{$addresses['id']}}">
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 form-group">
                                <label>Phone</label>
                                <input type="tel" name="phone" class="form-control" value="{{$addresses['phone']}}" require>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{$addresses['email']}}" require>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 form-group">
                                <label>Landmark</label>
                                <input type="text" name="landmark" class="form-control" value="{{$addresses['landmark']}}" require>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 form-group">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control" value="{{$addresses['address']}}" require>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 form-group">
                                <label>Zip/Postal Code </label>
                                <input type="text" name="zipCode" class="form-control" value="{{$addresses['zipCode']}}" onchange="zipCodeCheck(this.value);" require>
                            </div>
                            <div class="form-footer form-group col-md-12 col-sm-12 col-xs-12">
                                <button title="Submit" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            <input type="hidden" value="{{ csrf_token() }}" id="csrfToken">
     @endif
                        {!! Form::close() !!}                 
    
                   
    
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div id="footer-main" class="footer-main container-fluid" style="margin-top:25px;padding-left:20px;">

                        <!-- Container -->
            
                        <div class="container">
            
                            <div class="row">
            
                                <!-- Widget Links -->
            
                                <aside class="col-md-3 col-sm-6 col-xs-6 ftr-widget widget_links">
            
                                    <h3 style="margin-top: -45px;padding-bottom:10px;">Useful Link</h3>
            
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