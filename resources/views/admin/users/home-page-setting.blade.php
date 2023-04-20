@extends('layouts.app')

@section('pageTitle')



<h4 class="page-title"> <i class="dripicons-calendar"></i>Home Page Setting</h4>

@endsection

@section('contentData')


<div class="row">
    <div class="col-12">
	
        <div class="card m-b-20">
		    <div class="card-header">Home Page Setting</div>
            <div class="card-body">
			@if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
		    @endif
			
			{!! Form::open(['url' => 'admin/home-page-setting','class'=>'']) !!}
			  <div class='form-group'>
			     <label for="home_page">Seelct Layout:</label>
				 <select type="text" id="home_page" name="home_page" class="form-control" placeholder="" >
				    <option value='1' @if($home->home_page==1) selected @endif>Homepage 1</option>
				    <option value='2' @if($home->home_page==2) selected @endif>Homepage 2</option>
				    <option value='3' @if($home->home_page==3) selected @endif>Homepage 3</option>
				    <option value='4' @if($home->home_page==4) selected @endif>Homepage 4</option>
				    <option value='5' @if($home->home_page==5) selected @endif>Homepage 5</option>
				    <option value='6' @if($home->home_page==6) selected @endif>Homepage 6</option>
				    <option value='7' @if($home->home_page==7) selected @endif>Homepage 7</option>
				 </select>
			  </div>
			  
			  <div class='form-actions' style='text-align:center'>
                  <input type="hidden" value="" id="position">			  
				  <button type="submit" class="btn btn-primary" style='width:100%'>Update</button>
			  </div>
			{!! Form::close() !!}
			
			</div>
		</div>
		
	</div>
</div>

@endsection
