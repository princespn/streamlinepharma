@extends('FrontEndTheme.Nest.layout.layout')
@section('title', 'Dashboard')
@section('page-content')
@php $order_menu = 'dashboard'; @endphp
<main class="main pages">
   <div class="page-header breadcrumb-wrap">
      <div class="container">
         <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Pages <span></span> Dashboard
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
                                 <h3 class="mb-0">Hello {{ Session::get('register')->name }}</h3>
                              </div>
                              <div class="card-body">
                                 <p>
                                    From your account dashboard. you can easily check &amp; view your <a href="{{ url('orders') }}">recent orders</a>,<br />
                                    manage your <a href="{{ url('my-address') }}">shipping addresses</a> and <a href="{{ url('account-detail') }}">see your  account details.</a>
                                 </p>
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