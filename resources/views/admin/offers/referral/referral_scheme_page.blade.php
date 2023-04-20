@extends('layouts.app')

@section('pageTitle')


<input type="hidden" value="1" id="position">
<input type="hidden" value="{{ csrf_token() }}" id="csrfToken">
<h4 class="page-title"> <i class="dripicons-calendar"></i>Membership Page</h4>

@endsection

@section('contentData')

<div class="row">
    <div class="col-6">
        <div class="card m-b-20">
		    <div class="card-header">Referral Scheme Page</div>
            <div class="card-body">
			    @if (session('status'))
					<div class="alert alert-success">
						{{ session('status') }}
					</div>
				@endif
                {!! Form::open(['url' => 'admin/referral_scheme_page','method'=>'POST','id'=>'form']) !!}
                {{ csrf_field() }}
                  <div class="form-group">
					<label for="title">Title:</label>
					<textarea type="text" class="summernote form-control" placeholder="" id="title" name='title' required >@if(isset($mem_data)) {{ $mem_data->title }} @endif</textarea>
				  </div>
				  <div class="form-group">
					<label for="sub_title">Sub Title:</label>
					<textarea type="text" class="summernote form-control" placeholder="" id="sub_title" name='sub_title' required >@if(isset($mem_data)) {{ $mem_data->sub_title }} @endif</textarea>
				  </div>
				  
				  
				  
				  
				  <div class="form-group">
					<label for="image">Image:</label>
					<input type='text' readonly @if(isset($mem_data)) value='{{ $mem_data->image }}' @endif class='form-control' name='image' id='image123' onclick="openImagePopup('123')">
				  </div>
				  
				  
				  <div class="form-group">
					<label for="sorting_order">Sorting Order :</label>
					<input type="number" class="form-control" placeholder="" id="sorting_order" name='sorting_order' @if(isset($mem_data)) value='{{ $mem_data->sorting_order }}' @endif>
				  </div>
				  
				  @if(isset($mem_data))
					  <input type='hidden' name='id' value='{{ $mem_data->id }}'>
				  @endif
				  @if(count($data)<5)
				  {{ 5-count($data) }} Remaining.<br>
				  @endif
				  @if(count($data)<5||isset($mem_data))
				     <button type="submit" class="btn btn-primary">@if(isset($mem_data)) Update @else Submit @endif</button>
			      @endif
                {!! Form::close() !!}
            </div>
        </div>
    </div>
	<div class="col-6">
        <div class="card m-b-20">
		    <div class="card-header">Referral Page</div>
            <div class="card-body">
			    <table class='table table-bordered table-striped table-responsive'>
				  <thead>
				    <tr>
					  <th>Title</th>
					  <th>Sub Title</th>
					  <th>Image</th>
					  <th>Sorting Order</th>
					  
					  <th>Action</th>
					</tr>
				  </thead>
				  <tbody>
				  @if(count($data))
					  @foreach($data as $key=>$row)
					    <tr>
						   <td>{!! strip_tags($row->title) !!}</td>
						   <td>{!! strip_tags($row->sub_title) !!}</td>
						   <td><img width='80' src="{{ url($row->image) }}"></td>
						   <td>{!! $row->sorting_order !!}</td>
						   
						   <td>
						     <a href="{{ url('admin/membership_page/'.$row->id) }}" class='btn btn-outline-primary btn-sm'>Edit</a><br><br>
						     <button data-toggle="modal" data-target="#preview_modal{{ $key }}"  class='btn btn-outline-danger btn-sm'>PreView</button>
							 <!---------------------------------------->
							 <div class="modal" id="preview_modal{{ $key }}">
							  <div class="modal-dialog modal-lg">
								<div class="modal-content">

								  <!-- Modal Header -->
								  <div class="modal-header">
									<h4 class="modal-title">PreView</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								  </div>

								  <!-- Modal body -->
								  <div class="modal-body">
									<div style="position:relative">
									  <img src="{{ $row->image }}" style="width:100%;">
									  <div style="width: 100%;position: absolute;top:0px;">
									    <h2>{!! $row->title !!}</h2>
										<h4>{!! $row->sub_title !!}</h4>
									  </div>
									</div>
								  </div>

								  <!-- Modal footer -->
								  <div class="modal-footer">
									<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
								  </div>

								</div>
							  </div>
							</div>
							 <!---------------------------------------->
						   </td>
						</tr>
					  @endforeach
				  @else
					<tr><th colspan='5'>No Data Found!</th></tr>  
				  @endif
				  </tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div id="myModal" class="modal fade" tabindex="-1" role="dialog">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title mt-0">Choose Image</h5>
                
                <button type="button" id="closeButton" class="close" data-dismiss="modal" aria-hidden="true">×</button>

            </div>

            <div class="modal-body">

                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="mb-2 text-center card-body text-muted">
                        <ul class="new_friend_list list-unstyled row" id="replceFolderImage">
                        
                            @foreach ($imageUploadList as $key=>$image)
                                
                                @if($image->mediaType == 1)
                                    <li class="col-lg-3 col-md-4 col-sm-6" onclick="openFolder('{{$image->id}}')">
                                        <img src="http://ecommerce.uniqueandcommon.com/assets/images/folder.png" class="img-thumbnail">
                                        <h6 class="users_name">{{$image->title}}</h6>
                                    </li>
                                @else
                                    <li class="col-lg-3 col-md-4 col-sm-6" onclick="setImageUrl('{{$image->name}}')">
                                        <img src="{{URL::asset($image->name)}}" class="img-thumbnail" >
                                        <h6 class="users_name">{{$image->title}}</h6>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>
@endsection