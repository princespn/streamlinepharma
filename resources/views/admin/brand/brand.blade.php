@extends('layouts.app')

@section('pageTitle')

<div class="float-right">
  
  <a class="btn btn-outline-light" href="{{url('admin/view_advance_product')}}">View Added Product</a>
    
</div>

<h4 class="page-title"> <i class="dripicons-calendar"></i>Brand Management</h4>

@endsection

@section('contentData')


<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
		    <div class="card-header">Brand Management</div>
            <div class="card-body">
			@if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
		    @endif
			{!! Form::open(['url' => 'admin/brand','class'=>'form-inline']) !!}
			      <label for="brand" class="mr-sm-2">Brand:</label>
				  <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Enter Brand Name" id="brand" name="brand">
				  <label for="image" class="mr-sm-2">Image:</label>
				  <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Enter Image Link" id="image" name="image">
				  <button type="submit" class="btn btn-primary">Add</button>
			{!! Form::close() !!}
			</div>
		</div>
		<div class="card m-b-20">
		    <div class="card-header">Added</div>
            <div class="card-body">
			  <table class='table table-bordered table-striped'>
			    <thead>
				   <tr>
				      <th>#</th>
				      <th>Name</th>
				      <th>Image</th>
				   </tr>
				</thead>
				<tbody>
			    @foreach($data as $key=>$row)
				   <tr>
				      <td>{{ $key+1 }}</td>
				      <td>{{ $row->name }}</td>
				      <td><img src='{{ $row->image }}' width='70'></td>
				   </tr>
				@endforeach
				</tbody>
			  </table>
			</div>
		</div>
	</div>
</div>

@endsection
