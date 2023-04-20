@extends('layouts.app')
@section('pageTitle')
<div class="float-right">
  
  <a class="btn btn-outline-light" href="{{url('admin/create_employee')}}">Add</a>
    
</div>
<h4 class="page-title"> <i class="dripicons-list"></i>Referral Scheme</h4>

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
			  <th>Name</th>
			  <th>Phone</th>
			  <th>Email</th>
              <!--<th>Description</th> -->
              <th>Action</th>
			</tr>
		  </thead>
		  <tbody>
              @foreach($emp as $k=> $emp)
            <tr>
                <td>{{$k+1}}</td>
                <td>{{$emp->title}}</td>
                <td>{{$emp->phone}}</td>
                <td>{{$emp->email}}</td>
                
                <td>
                
                <a href="#" class="btn btn-danger btn-sm"> Delete</a>
                <a href="{{'edit_employee/'.$emp->id}}" class="btn btn-outline-info btn-sm"> Edit</a>
                @if($emp->status =='1')
                <a href="{{'status_update/deactive/'.$emp->id}}" class="btn btn-warning btn-sm"> Deactive</a>
                @else
                <a href="{{'status_update/Active/'.$emp->id}}" class="btn btn-success btn-sm"> Active</a>
                @endif
                
               <!-- <a href="{{'given_permission/'.$emp->id}}" class="btn btn-primary btn-sm"> Given Permission</a> -->
                
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
<div class="modal" id="user_list">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Share to</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <table class='table table-bordered table-striped'>
		  <thead>
		    <tr>
			  <th>#</th>
			  <th>Name</th>
			  <th>Phone</th>
			  <th>Email</th>
              <th>Description</th>
              <th>Action</th>
			</tr>
		  </thead>
		  <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
		  </tbody>
		</table>
		
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" form='referral_scheme_shared_with' class="btn btn-primary" >Share with Selected User</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
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
