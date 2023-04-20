@extends('theams/theam1/layouts.app')

@section('theme1Content')



    <!-- Page Banner -->

    <div class="page-banner container-fluid no-padding">

        <!-- Container -->

        <div class="container">

            <div class="banner-content">

                <h3>My Coupons</h3>

            </div>

            <ol class="breadcrumb">

                <li><a href="/" title="Home">Home</a></li>

                <li class="active">My Coupons</li>

            </ol>

        </div><!-- Container /- -->

    </div><!-- Page Banner /- -->  

    <div class="container-fluid no-left-padding no-right-padding woocommerce-checkout">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">                     
                        @if(Session::get('register')&&$membership)
						<h3 style="margin-left: 15px;">{{ $membership->name }} - <small>Billed - {{ $membership->charge_recurring }}</small></h3>
						@endif
                    
                        
                        <h3 style="margin-left: 15px;"></h3>
                        
                        <table class='table table-bordered table-striped'>
						  <thead>
						      <tr>
							    <th style='text-align: center;background-color: #f2f2f2;' colspan='8'>Coupon History</th>
							  </tr>
							  <tr>
                                <th>Scheme Name</th>
                                <th>Template</th>
                                <th>Coupon</th>
							    <th>Used by</th>
							    <th>Used Time</th>
							    <th>Product Name</th>
							    <th>Price</th>
                                <th>Refferal Benifit / Refree Benifit</th>
							  </tr>
						  </thead>
						  <tbody>
                             @foreach($dataCoupon as $k=>$valueCoupon) 
                              <tr>
                                  @if($k==0)
                                  <td rowspan="{{count($dataCoupon)+1}}">{{$valueCoupon->scheme_name}}
                                  <small>Valid on : {{$valueCoupon->validity_date}}</small>
                                  </td>
                                  @endif
                                  <td>{{$otherdata->template($valueCoupon->template)}}</td>
                                  <td>{{$valueCoupon->coupon}}</td>
                                  @if($valueCoupon->uesttime != null)
                                  <td>{{$valueCoupon->username}}</td>	
                                  <td>{{$valueCoupon->uesttime}}</td>
                                  <td>{{$valueCoupon->title}}</td>
                                  <td>{{($valueCoupon->selling_price-$valueCoupon->refferal_benifit)}}</td>
                                  <td>{{$valueCoupon->refferal_benifit}} / {{$valueCoupon->refree_benifit}}</td>
                                  @else
                                  <td colspan="5">Unused</td>
                                  @endif
                              </tr>
                              @endforeach
                            
						  </tbody>
						</table>               
    
                            
    
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