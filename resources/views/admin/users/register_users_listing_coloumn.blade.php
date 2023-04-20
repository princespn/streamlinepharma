@extends('layouts.app')

@section('pageTitle')



<h4 class="page-title"> <i class="dripicons-calendar"></i>Register Users listing Coloumn</h4>

@endsection

@section('contentData')


<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
		    <div class="card-header">Register Users listing Coloumn</div>
            <div class="card-body">
			@if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
		    @endif
			{!! Form::open(['url' => url('admin/register_users_listing_coloumn'),'class'=>'form-group']) !!}
            <div class="form-group form-check">
                <label class="form-check-label"><input class="form-check-input" type="checkbox"  name="users_listing_coloumn[]" required @if(in_array('Last Order',$array)) checked @endif value='Last Order'>Last Order</label>
            </div>
            <div class="form-group form-check">
                <label class="form-check-label"><input class="form-check-input" type="checkbox" name="users_listing_coloumn[]" required @if(in_array('Referral',$array)) checked @endif value='Referral'>Referral</label>
            </div>
            <div class="form-group form-check">
                <label class="form-check-label"><input class="form-check-input" type="checkbox" name="users_listing_coloumn[]" required @if(in_array('Membership and Scheme',$array)) checked @endif value='Membership and Scheme'>Membership and Scheme</label>
            </div>
            <div class="form-group form-check">
                <label class="form-check-label"><input class="form-check-input" type="checkbox" name="users_listing_coloumn[]" required @if(in_array('Last Login',$array)) checked @endif value='Last Login'>Last Login </label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
			{!! Form::close() !!}
			</div>
		</div>
		
	</div>
</div>

@endsection
