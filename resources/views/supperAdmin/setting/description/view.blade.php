@extends('layouts.app')
@section('pageTitle')
<div class="float-right">
  
  <a class="btn btn-outline-light" href="{{url('admin/add_description')}}">Add</a>
    
</div>
<h4 class="page-title"> <i class="dripicons-list"></i>Description</h4>

@endsection
@section('contentData')
<div class="row">
   <div class="col-12">
      <div class="card m-b-20">
         <div class="card-body">
		 @if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
		@endif
		<div class="table-responsive">
			<table class='table table-bordered table-striped'>
			<thead>
		    <tr>
			  <th>#</th>
			
              <th>Description</th>
              <th>Action</th>
			</tr>
		  </thead>
		  <tbody>
              @foreach($data as $key=> $value)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$value->name}}</td>
                <td>
                <a href="#" class="btn btn-danger btn-sm"> Delete</a>
                <a href="#" class="btn btn-info btn-sm"> Edit</a>
              
                </td>
            </tr>
            @endforeach
		  </tbody>
			</table>
         </div>
</div>
      </div>
   </div>
</div>

<!----------------------------------------------------->

<!----------------------------------------------------->
@endsection
@section('css')
<style>
.share_container a{
	display: inline-block;
    margin: 5px;
    border: 1px solid black;
    text-align: center;
    padding: 5px 10px;
    border-radius: 50%;
}
</style>


@stop
