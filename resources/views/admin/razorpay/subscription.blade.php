@extends('layouts.app')

@section('pageTitle')

<div class="float-right">

    <a class="btn btn-outline-light" href="{{url('admin/razorpay_plan')}}">Plan</a>
    <a class="btn btn-outline-light" href="{{url('admin/razorpay_subscription')}}">Subscriptions</a>
</div>

<h4 class="page-title"> <i class="dripicons-calendar"></i>Razorpay Subscription</h4>

@endsection

@section('contentData')


<div class="row">
    <div class="col-6">
        <div class="card m-b-20">
		    <div class="card-header">Razorpay Subscription</div>
            <div class="card-body">
			    @if (session('status'))
					<div class="alert alert-success">
						{{ session('status') }}
					</div>
				@endif
                {!! Form::open(['url' => 'admin/razorpay_subscription','method'=>'POST','id'=>'form']) !!}
                {{ csrf_field() }}
                  <div class="form-group">
					<label for="name">Select Plan:</label>
					<select  class="form-control" id="plan_id" name='plan_id' required >
					   <option value=''></option>
					  @foreach($data['items'] as $row)
					   <option value="{{ $row['id'] }}">{{ $row['item']['name'] }} - {{ $row['item']['unit_amount']/100 }} - {{ $row['period'] }}</option>
					  @endforeach
					<select> 
				  </div>
				  <div class="form-group">
					<label for="charges">Total Count:</label>
					<input type="number" class="form-control" placeholder="No. of billing cycles to be charged" id="total_count" name='total_count' required >
				  </div>
				  
				  
				  <button type="submit" class="btn btn-primary">Submit</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
	<div class="col-6">
        <div class="card m-b-20">
		    <div class="card-header">Razorpay Subscription List</div>
            <div class="card-body">
			  <table class='table table-bordered table-striped'>
			    <thead>
				   <tr>
				      <th>Subscription Id	</th>
				      <th>Plan Id</th>
				      <th>Created At</th>
				   </tr>
				</thead>
				<tbody>
			    @foreach($list['items'] as $row)
				  <tr>
				     <td>{{ $row['id'] }}</td>
				     <td>{{ $row['plan_id'] }}</td>
				     <td>{{ $row['created_at'] }}</td>
				  </tr>
				@endforeach
				</tbody>
			  </table>
			</div>
		</div>
	</div>
</div>

@endsection
