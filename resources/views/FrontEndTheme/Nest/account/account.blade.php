@extends('FrontEndTheme.Nest.layout.layout')
@section('title', 'Dashboard')
@section('page-content')
@php $order_menu = 'account'; @endphp
<main class="main pages">
   <div class="page-header breadcrumb-wrap">
      <div class="container">
         <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Pages <span></span> My Account
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
                                 <h3 class="mb-0">My Account</h3>
                              </div>
                              <div class="card-body">
							    <div class='row'>
                                  <strong>Name : </strong><span>{{ Session::get('register')->name }}</span><br>
                                  <strong>Mobile : </strong><span>{{ Session::get('register')->mobile }}</span><br>
                                  <strong>Email : </strong><span>{{ Session::get('register')->email }}</span><br>
								</div>
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