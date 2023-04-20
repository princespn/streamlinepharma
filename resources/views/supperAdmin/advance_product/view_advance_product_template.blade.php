@extends('layouts.app')
@section('pageTitle')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<h4 class="page-title"> <i class="dripicons-list"></i>View Advance Product Template</h4>

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
		
            <table class='table table-bordered table-striped'>
               <thead>
                  <tr>
                     <th>#</th>
                     <th>Name</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
			   @foreach($data as $key=>$row)
			     <tr>
				   <td>{{ $key+1 }}</td>
				   <td>{{ $row->name }}</td>
				   <td>
				     <a class='btn btn-sm btn-primary' href="{{ url('admin/advance_product_template/'.$row->id) }}">Edit</a>
				   </td>
				 </tr>
			   @endforeach
               </tbody>
            </table>
			
         </div>
      </div>
   </div>
</div>
@endsection
