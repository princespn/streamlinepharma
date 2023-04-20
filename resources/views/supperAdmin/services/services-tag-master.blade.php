@extends('layouts.app')

@section('pageTitle')



<h4 class="page-title"> <i class="dripicons-calendar"></i>Services Tag Master</h4>

@endsection

@section('contentData')


<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
		    <div class="card-header">Services Tag Master</div>
            <div class="card-body">
			@if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
		    @endif
			{!! Form::open(['url' => '#']) !!}
			    <div class="control-group">
				    <label class="control-label" for='title'>Select Service</label>
					<div class="controls">
						<select type='text' name='brand' class='form-control'  ></select>
					</div>
				</div>
				<div class="control-group">
				    <label class="control-label" for='title'>Service Tag</label>
					<div class="controls">
						<textarea type='text' name='brand' class='form-control'  ></textarea>
					</div>
				</div>
                <div class="form-actions" style='text-align:center;margin-top:40px'>
					<input type="submit" class="btn btn-outline-success" value="Update">
				</div>				
			{!! Form::close() !!}
			</div>
		</div>
		
	</div>
</div>

@endsection
