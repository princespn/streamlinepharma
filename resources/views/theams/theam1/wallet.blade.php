@extends('theams/theam1/layouts.app')

@section('theme1Content')



    <!-- Page Banner -->

    <div class="page-banner container-fluid no-padding">

        <!-- Container -->

        <div class="container">

            <div class="banner-content">

                <h3>Wallet</h3>

            </div>

            <ol class="breadcrumb">

                <li><a href="/" title="Home">Home</a></li>

                <li class="active">Wallet</li>

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
                    
                        
                        <h3 style="margin-left: 15px;">Balance : {{$amount}} ₹</h3>
                        
                        <table class='table table-bordered table-striped'>
						  <thead>
						      <tr>
							    <th style='text-align: center;background-color: #f2f2f2;' colspan='5'>Transaction History</th>
							  </tr>
							  <tr>
							    <th>Date</th>
							    <th>Transaction Id</th>
							    <th>Credit</th>
							    <th>Debit</th>
							    <th>Amount</th>
							  </tr>
						  </thead>
						  <tbody>
                              @foreach($wallet_amount as $key=>$wallet_amount_value)
                              <tr>
                                  <td>{{$wallet_amount_value->created_at}}</td>
                                  <td>SDC{{(1000000+$wallet_amount_value->id)}}</td>	
                                  <td>{{$wallet_amount_value->credit}}</td>
                                  <td>{{$wallet_amount_value->debit}}</td>
                                  <td>{{$wallet_amount_value->amount}}</td>
                              </tr>
                              @endforeach
                              @if(count($wallet_amount) =='0')
						      <tr>
							    <td colspan='5'>No History Found!</td>
							  </tr>
                              @endif
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