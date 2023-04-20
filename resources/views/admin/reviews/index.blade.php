@extends('layouts.app')



@section('pageTitle')



    



    <h4 class="page-title"> <i class="dripicons-tags"></i> Reviews</h4>



@endsection



@section('contentData')



    <div class="row">

        <div class="col-12">

            <div class="card m-b-20">

                <div class="card-body">

                    

                <table class='table table-bordered table-striped' style='margin-top:30px'>
				  <thead>
				    <tr>
					   <th>#</th>
					   <th>Product</th>
					   <th>User</th>
					   <th>Rating</th>
					   <th>Headline</th>
					   <th>Review</th>
					   <th>Photo</th>
					   <th>Reviewed at</th>
					   <th>Action</th>
					</tr>
				  </thead>
				  <tbody>
				    @if(count($data))
					  @foreach( $data as $key=>$row)
                       <tr>
					     <td>{{ $key+1 }}</td>
					     <td><a href="{{ url('product-detail/'.$row->product->sku) }}" target='_blank'>{{ $row->product->title }}</a></td>
					     <td>{{ $row->register->name }}</td>
					     <td>{{ $row->rating }}</td>
					     <td>{{ $row->headline }}</td>
					     <td>{{ $row->review }}</td>
					     <td><a href="{{ url('review/'.$row->photo) }}" target='_blank'>View Media</a></td>
						 <td>{{ $row->created_at }}</td>
						 <td>
						   @if($row->status==0)
							   <a href="{{ url('admin/review_status/'.$row->id.'/2') }}" class='btn btn-danger btn-sm btn-xs'>Reject</a>
							   <a href="{{ url('admin/review_status/'.$row->id.'/1') }}" class='btn btn-primary btn-sm btn-xs'>Approve</a>
						   @else
						   {{ $constant_review_status[$row->status] }}
						   @endif
						 </td>
					   </tr>
                      @endforeach				  
					@else
						<tr>
					       <td colspan='8'>No Data Found.</td>
					    </tr>
					@endif
				  </tbody>
				</table>

                </div>

            </div>

        </div>

    </div>



@endsection