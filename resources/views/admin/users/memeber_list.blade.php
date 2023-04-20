@extends('layouts.app')

@section('pageTitle')

<div class="float-right">
  
 
    
</div>

<h4 class="page-title"> <i class="dripicons-calendar"></i>Member's List</h4>

@endsection

@section('contentData')


<div class="row">
    <div class="col-12">
        
		<div class="card m-b-20">
            <div class="card-body">
			  <table class='table table-bordered table-striped'>
			    <thead>
				   <tr>
				      <th>#</th>
				      <th>Name</th>
				      <th>Mobile</th>
				      <th>Membership Amount</th>
				   </tr>
				</thead>
				<tbody>
			    @foreach($user as $key=>$row)
				  <tr>
				    <td>{{ $key+1 }}</td>
				    <td>{{ $row->name }}</td>
				    <td>{{ $row->phone }}</td>
				    <td>{{ $row->charges }} ₹ {{ $row->charge_recurring }}</td>
				  </tr>
				@endforeach
				</tbody>
			  </table>
			</div>
		</div>
	</div>
</div>

@endsection
