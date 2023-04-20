@extends('layouts.app')

@section('pageTitle')

<div class="float-right">
  
  
    
</div>

<h4 class="page-title"> <i class="dripicons-calendar"></i>In Cart Products</h4>

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
				      <th>User</th>
				      <th>Mobile</th>
				      <th>Products</th>
				   </tr>
				</thead>
				<tbody>
				@foreach($data as $key=>$row)
				   <tr>
				     <td>{{ $key+1 }}</td>
					 <td>{{ $row->register->name }}</td>
					 <td>{{ $row->register->phone }}</td>
					 <td>
					   <table style="width: 100%;" class='table table-striped'>
					   <tbody>
						@foreach($row->register->inCart as $pr)
						  <tr>
							<td><img src='{{ $pr->product->thumbnail }}' width='30'></td>
							<td>{{ $pr->product->title }}</td>
							<td>{{ $pr->product->sku }}</td>
							<td>Rs. {{ $pr->product->selling_price }} </td>
							<td>{{ $pr->qty }}</td>
						  </tr>
						@endforeach
					   </tbody>
					   </table>
					 </td>
				   </tr>
				@endforeach()
				</tbody>
			  </table>
			  
			</div>
		</div>
	</div>
</div>


@endsection
