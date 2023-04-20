@extends('layouts.app')

@section('pageTitle')

<div class="float-right">

    <a class="btn btn-outline-light" href="{{url('admin/membership')}}">Membership</a>
    <a class="btn btn-outline-light" href="{{url('admin/membership_page')}}">Membership Page</a>
</div>

<h4 class="page-title"> <i class="dripicons-calendar"></i>Membership</h4>

@endsection

@section('contentData')

<div class="row">
    <div class="col-6">
        <div class="card m-b-20">
		    <div class="card-header">Membership Form</div>
            <div class="card-body">
			    @if (session('status'))
					<div class="alert alert-success">
						{{ session('status') }}
					</div>
				@endif
                {!! Form::open(['url' => 'admin/membership_action','method'=>'POST','id'=>'form']) !!}
                {{ csrf_field() }}
                  <div class="form-group">
					<label for="name">Membership Name:</label>
					<input type="text" class="form-control" placeholder="" id="name" name='name' required @if(isset($mem_data)) value='{{ $mem_data->name }}' @endif>
				  </div>
				  <div class="form-group">
					<label for="charges">Charges:</label>
					<input type="number" class="form-control" placeholder="" id="charges" name='charges' required @if(isset($mem_data)) value='{{ $mem_data->charges }}' @endif>
				  </div>
				  
				  
				  <div class="form-group">
					<label for="razorpay_subscription_id">Razorpay Plan ID:</label>
					<select class="form-control" id="razorpay_subscription_id" name='razorpay_subscription_id' required >
					      <option value=''></option>
					@if(array_key_exists("items",$sub_list))
					   @foreach($sub_list['items'] as $row)
				          <option @if(isset($mem_data)&&$mem_data->razorpay_subscription_id==$row['id']) selected @endif value="{{ $row['id'] }}">{{ $row['id'] }} - {{ $row['item']['name'] }}</option>
				      @endforeach
					@endif
					<select>
				  </div>
				  
				  <div class="form-group">
					<label for="charge_recurring">Charge Recurring:</label>
					<select class="form-control" id="charge_recurring" name='charge_recurring' required >
					   <option @if(isset($mem_data)&&$mem_data->charge_recurring=='Monthly') selected @endif>Monthly</option>
					   <option @if(isset($mem_data)&&$mem_data->charge_recurring=='Quarterly') selected @endif>Quarterly</option>
					   <option @if(isset($mem_data)&&$mem_data->charge_recurring=='Annually') selected @endif>Annually</option>
					<select>
				  </div>
				  <div class="form-group">
					<label for="benifits">Benefits - Extra Discount % :</label>
					<input type="number" class="form-control" placeholder="" id="benifits" name='benifits' @if(isset($mem_data)) value='{{ $mem_data->benifits }}' @endif>
				  </div>
				  <div class="form-group">
					<label for="">Shipping Charges Off :</label>
					<div class="form-check-inline">
					  <label class="form-check-label">
						<input type="radio" class="form-check-input" name="shipping_charges" value='Yes' required @if(isset($mem_data)&&$mem_data->shipping_charges=='Yes') checked @endif>Yes
					  </label>
					</div>
					<div class="form-check-inline">
					  <label class="form-check-label">
						<input type="radio" class="form-check-input" name="shipping_charges" value='No' required  @if(isset($mem_data)&&$mem_data->shipping_charges=='No') checked @endif>No
					  </label>
					</div>
				  </div>
				  
				  <div class="form-group">
					<label for="freebies_amount">Freebies – Equivalent Amount :</label>
					<input type="number" class="form-control" placeholder="" id="freebies_amount" name='freebies_amount' required @if(isset($mem_data)) value='{{ $mem_data->freebies_amount }}' @endif>
				  </div>
				  <div class="form-group">
					<label for="freebies_scheduling">Freebies – Scheduling for accruing:</label>
					<select class="form-control" id="freebies_scheduling" name='freebies_scheduling' required>
					   <option @if(isset($mem_data)&&$mem_data->freebies_scheduling=='Monthly') selected @endif>Monthly</option>
					   <option @if(isset($mem_data)&&$mem_data->freebies_scheduling=='Quarterly') selected @endif>Quarterly</option>
					   <option @if(isset($mem_data)&&$mem_data->freebies_scheduling=='Half Yearly') selected @endif>Half Yearly</option>
					   <option @if(isset($mem_data)&&$mem_data->freebies_scheduling=='Annually') selected @endif>Annually</option>
					<select>
				  </div>
				  <div class="form-group">
					<label for="terms_and_conditions">Terms and Conditions :</label>
					<textarea  class="form-control" placeholder="" id="terms_and_conditions" name='terms_and_conditions' required>@if(isset($mem_data)) {{ $mem_data->terms_and_conditions }} @endif</textarea>
				  </div>
				  @if(isset($mem_data))
					  <input type='hidden' name='id' value='{{ $mem_data->id }}'>
				  @endif
				  <button type="submit" class="btn btn-primary">@if(isset($mem_data)) Update @else Submit @endif</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
	<div class="col-6">
        <div class="card m-b-20">
		    <div class="card-header">Membership List</div>
            <div class="card-body">
			    <table class='table table-bordered table-striped'>
				  <thead>
				    <tr>
					  <th>#</th>
					  <th>Membership Name</th>
					  <th>Charges</th>
					  <th>Action</th>
					</tr>
				  </thead>
				  <tbody>
				  @if(count($data))
					  @foreach($data as $key=>$row)
				        <tr>
						   <td>{{ $key+1 }}</td>
						   <td>{{ $row->name }}</td>
						   <td>{{ $row->charges }}</td>
						   <td><a href="{{ url('admin/membership/'.$row->id) }}" class='btn btn-outline-primary btn-sm'>View or Edit</a></td>
						</tr>
				      @endforeach
				  @else
				    <tr>
					  <td colspan='4'>No Data Found</td>
					</tr>
				  @endif
				  </tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection