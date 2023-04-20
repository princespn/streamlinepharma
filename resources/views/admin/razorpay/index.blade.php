@extends('layouts.app')

@section('pageTitle')

<div class="float-right">

    <a class="btn btn-outline-light" href="{{url('admin/razorpay_plan')}}">Plan</a>
    <!--a class="btn btn-outline-light" href="{{url('admin/razorpay_subscription')}}">Subscriptions</a-->
</div>

<h4 class="page-title"> <i class="dripicons-calendar"></i>Razorpay Subscription</h4>

@endsection

@section('contentData')


<div class="row">
    <div class="col-6">
        <div class="card m-b-20">
		    <div class="card-header">Razorpay Plan</div>
            <div class="card-body">
			    @if (session('status'))
					<div class="alert alert-success">
						{{ session('status') }}
					</div>
				@endif
                {!! Form::open(['url' => 'admin/razorpay_plan','method'=>'POST','id'=>'form']) !!}
                {{ csrf_field() }}
                  <div class="form-group">
					<label for="name">Plan Name:</label>
					<input type="text" class="form-control" placeholder="The name known to your customers" id="name" name='name' required >
				  </div>
				  <div class="form-group">
					<label for="charges">Plan Description:</label>
					<textarea  class="form-control" placeholder="Optional" id="charges" name='description' ></textarea>
				  </div>
				  <div class="form-group">
					<label for="charge_recurring">Billing Frequency:</label>
					<div class="input-group">
					  <div class="input-group-prepend">
						<div class="input-group-text">
						  Every
						</div>
					  </div>
					  <input type="number" min='1' placeholder='' value='1' class="form-control" required name='interval'>
					  <select  class="form-control" id="charge_recurring" name='period' required >
					   <option value='daily'>Days(s)</option>
					   <option value='weekly'>Week(s)</option>
					   <option value='monthly'>Month(s)</option>
					   <option value='yearly'>Year(s)</option>
					<select>
					</div>
					
				  </div>
				  <div class="form-group">
					<label for="benifits">Billing Amount:</label>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
						  <span class="input-group-text">₹</span>
						</div>
						<input name='amount' type="text" class="form-control">
					 </div>
				  </div>
				  
				  <button type="submit" class="btn btn-primary">Submit</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
	<div class="col-6">
        <div class="card m-b-20">
		    <div class="card-header">Razorpay Plan List</div>
            <div class="card-body">
			  <table class='table table-bordered table-striped'>
			    <thead>
				   <tr>
				      <th>Plan Id</th>
				      <th>Plan Name</th>
				      <th>Amount/Unit</th>
				      <th>Billing Cycle</th>
				      <th>Created At</th>
				   </tr>
				</thead>
				<tbody>
				@if(count($data))
			    @foreach($data['items'] as $row)
				  <tr>
				     <td>{{ $row['id'] }}</td>
				     <td>{{ $row['item']['name'] }}</td>
				     <td>{{ $row['item']['unit_amount']/100 }}</td>
				     <td>{{ $row['period'] }}</td>
				     <td>{{ $row['item']['created_at'] }}</td>
				  </tr>
				@endforeach
				@endif
				</tbody>
			  </table>
			</div>
		</div>
	</div>
</div>

@endsection
