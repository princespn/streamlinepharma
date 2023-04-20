@extends('layouts.app')

@section('pageTitle')




@endsection

@section('contentData')


<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
		    <div class="card-header">Bank Detail Management</div>
            <div class="card-body">
			@if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
		        @endif
                        @if($errors->any())
                        <div class="alert alert-danger">{{$errors->first()}}</div>
                                @endif
			{!! Form::open(['url' => 'admin/bank-detail']) !!}
            <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" placeholder="Enter Name" id="name" name='name' @if(isset($data)) value="{{ $data['contact']['name'] }}" @endif>
            </div>
            <div class="form-group">
                    <label for="name">Mobile:</label>
                    <input type="text" class="form-control" placeholder="Enter Mobile" id="mobile" name='mobile'  @if(isset($data)) value="{{ substr($data['contact']['contact'],2) }}" @endif>
            </div>
            <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" placeholder="Enter Email" id="email" name='email'  @if(isset($data)) value="{{ $data['contact']['email'] }} @endif">
            </div>
            <div class="form-group">
                    <label for="ifsc">IFSC:</label>
                    <input type="text" class="form-control" placeholder="Enter IFSC" id="ifsc" name='ifsc'  @if(isset($data)) value="{{ $data['funds']['bank_account']['ifsc'] }}" @endif>
            </div>
            <div class="form-group">
                    <label for="account_number">Account Number:</label>
                    <input type="text" class="form-control" placeholder="Enter Account Number" id="account_number" name='account_number'  @if(isset($data)) value="{{ $data['funds']['bank_account']['account_number'] }}" @endif>
            </div>
            @if(!isset($data))
            <button type="submit" class="btn btn-primary">Submit</button>
			{!! Form::close() !!}
			</div>
	    </div>
            @endif
		
	</div>
</div>

@endsection
