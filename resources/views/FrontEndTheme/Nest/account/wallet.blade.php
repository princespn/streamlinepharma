@extends('FrontEndTheme.Nest.layout.layout')
@section('title', 'Wallet')
@section('page-content')
@php $order_menu = 'wallet'; @endphp
<main class="main pages">
   <div class="page-header breadcrumb-wrap">
      <div class="container">
         <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Pages <span></span> Wallet
         </div>
      </div>
   </div>
   <div class="page-content pt-150 pb-150">
      <div class="container">
         <div class="row">
            <div class="col-lg-10 m-auto">
               <div class="row">
                  <div class="col-md-3">
                     <div class="dashboard-menu">
                        @include('FrontEndTheme.Nest.layout.dashboard_menu');
                     </div>
                  </div>
                  <div class="col-md-9">
                     <div class="account dashboard-content pl-50">
                           <div class="card">
                              <div class="card-header">
                                 <h3 class="mb-0">Balance : {{$amount}} ₹</h3>
                              </div>
                              <div class="card-body">
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