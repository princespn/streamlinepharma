@extends('FrontEndTheme.Nest.layout.layout')
@section('title', 'Dashboard')
@section('page-content')
@php $order_menu = 'address'; @endphp
<main class="main pages">
   <div class="page-header breadcrumb-wrap">
      <div class="container">
         <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Pages <span></span> Address
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
                                 <h3 class="mb-0">My Address</h3>
                              </div>
                              <div class="card-body">
							    <div class='row'>
                                 @foreach($address as $row)
								   <div class='col-md-4'>
								    <div class="card">
									  <div class="card-body">
								      <strong>{{ $row->name }}</strong><br>
								      <span>Mobile : {{ $row->phone }}</span><br>
								      <span>Email : {{ $row->email }}</span><br>
								      <span>{{ $row->address }}, {{ $row->landmark }}</span><br>
								      <span>{{ $row->cityId }}, {{ $row->stateId }}</span><br>
								      <span>{{ $row->countryId }}, {{ $row->zipCode }}</span><br>
								      </div>
									  <div class='card-footer address_footer'>
										    
										    <div class='row'>
											    <div class='col-6'>
												  <label class='btn btn-xs btn-sm btn-success' onclick="openAddressModal('edit','{{ md5($row->id) }}')">Edit</label>
												</div>
												<div class='col-6'>
												   <a href="{{ url('deleted_address/'.md5($row->id)) }}" class='btn btn-xs btn-sm btn-primary' onclick="if(confirm('Are you sure?')){return true;}else{return false;}">Delete</a>
												</div>
											</div>
										 </div>
								    </div>
								   </div>
								 @endforeach
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