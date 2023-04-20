@extends('layouts.app')

@section('pageTitle')

<div class="float-right">
  
  <a class="btn btn-outline-light" href="#">View Service Provider</a>
    
</div>

<h4 class="page-title"> <i class="dripicons-calendar"></i>Service Provider</h4>

@endsection

@section('contentData')


<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
		    <div class="card-header">Create Service Provider</div>
            <div class="card-body">
			@if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
		    @endif
			{!! Form::open(['url' => '#']) !!}
			    <div class="control-group">
				    <label class="control-label" for='title'>Company Name</label>
					<div class="controls">
						<input type='text' name='brand' class='form-control'  >
					</div>
				</div>
				<div class="control-group">
				    <label class="control-label" for='title'>Name</label>
					<div class="controls">
						<input type='text' name='brand' class='form-control'  >
					</div>
				</div>
                <div class="control-group">
				    <label class="control-label" for='title'>Email</label>
					<div class="controls">
						<input type='text' name='brand' class='form-control'  >
					</div>
				</div>
                <div class="control-group">
				    <label class="control-label" for='title'>Mobile</label>
					<div class="controls">
						<input type='text' name='brand' class='form-control'  >
					</div>
				</div>
                <div class="control-group">
				    <label class="control-label" for='title'>Address</label>
					<div class="controls">
						<input type='text' name='brand' class='form-control'  >
					</div>
				</div>
                <div class="control-group">
				    <label class="control-label" for='title'>Pincode</label>
					<div class="controls">
						<input type='text' name='brand' class='form-control'  >
					</div>
				</div>
                <div class="control-group">
				    <label class="control-label" for='title'>Service Offering</label>
					<div class="controls">
						<select type='text' name='brand' class='form-control'  ></select>
					</div>
				</div>	
                <div class="form-actions" style='text-align:center;margin-top:40px'>
					<input type="submit" class="btn btn-outline-success" value="Add">
				</div>				
			{!! Form::close() !!}
			</div>
		</div>
		
	</div>
</div>

@endsection
