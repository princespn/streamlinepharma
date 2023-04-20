@extends('layouts.app')

@section('pageTitle')

<div class="float-right">
  
  <a class="btn btn-outline-light" href="{{url('admin/view_advance_product')}}">View Added Product</a>
    
</div>

<h4 class="page-title"> <i class="dripicons-calendar"></i>Advance Product Template Subscription</h4>

@endsection

@section('contentData')


<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
		    <div class="card-header">Subscribe Template</div>
            <div class="card-body">
			@if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
		    @endif
			{!! Form::open(['url' => 'admin/advance_product_subscription']) !!}
			     <div class="form-group">
					<label for="email">Available :</label>
					<select class="form-control searchable_class" multiple  id="email" required  name='subscribed[]'>
					@foreach($available as $row)
					  <option value='{{ $row->id }}'>{{ $row->name }}</option>
					@endforeach
					</select>
				 </div>
				 <button type="submit" class="btn btn-primary">Subscribe</button>
			{!! Form::close() !!}
			</div>
		</div>
		<div class="card m-b-20">
		    <div class="card-header">Subscribed Template</div>
            <div class="card-body">
			  <table class='table table-bordered table-striped'>
			    <thead>
				   <tr>
				      <th>#</th>
				      <th>Name</th>
				      <th>Category</th>
				      <th>Sub Category</th>
				      <th>Grouping</th>
				      <th>Product Count</th>
				      <th>Banner</th>
				      <th>Return, Replace & Cancel Reason</th>
				      <th>Action</th>
				   </tr>
				</thead>
				<tbody>
			    @foreach($subscribed as $key=>$row)
				  <tr>
				    <td>{{ $key+1 }}</td>
				    <td>{{ $row->name }}</td>
				    <td>{{ $row->categories_name }}</td>
				    <td>{{ $row->sub_categories_name }}</td>
				    <td>
					@if($row->grouping!=Null)
					  
					   <strong>Grouping Available on : </strong> {{ $row->grouping }}
				      
				      @if($row->grouping_name!=Null&&count(json_decode($row->grouping_name,true)))
						  @foreach(json_decode($row->grouping_name,true)[0] as $kr=>$gr)
						  <br><strong>{{ $gr }} : </strong> {{ json_decode($row->grouping_name,true)[1][$kr] }}
						  @endforeach
					  @endif
				    @endif
				    </td>
					<td>{{ $row->added_product }}</td>
					<td>
					 <div id='banner_div{{ $row->cat_id }}'>
					    @if($row->banner)
							<img src="{{ url($row->banner) }}" width='80'>
						@else
							NA
						@endif
					 </div>
					 <button class='btn btn-sm btn-xs btn-primary' onclick="openImagePopup('banner_div{{ $row->cat_id }}')">Change</button>
					 <button type='submit' form='save_category_banner' class='btn btn-sm btn-xs btn-success'>Update</button>
					 <input type="hidden" value="" id="position">
					 <input type="hidden" value="{{ url('') }}" id="base_url">
					</td>
					<td>
					  <strong>Return : </strong>{{ $row->is_return }}
					  <br>
					  <strong>Replace : </strong>{{ $row->is_replace }}
					  <br>
					  <strong>Cancel Reason : </strong>{!! ($row->cancel_reason ? '<br>'.implode('<br>',explode(',',$row->cancel_reason)) : '') !!}
					  <br>
					  <a href="{{ url('admin/advance_product_category_action/'.$row->cat_id) }}" class='btn btn-primary btn-sm'>Edit</a>
					</td>
				    <td>
					@if( $row->categories_name!=''&&$row->sub_categories_name!='' )
					@if( ($row->grouping==Null && $row->grouping_name==Null) || ( $row->grouping!=Null && $row->grouping_name!=Null ) )
					   <a href="{{ url('admin/add_advance_product/'.$row->id) }}" class='btn btn-primary btn-sm'>+</a>
				    @endif
				    @endif
					   <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#category_modal" onclick="$('#setting_id').val({{ $row->id }});">
						  Update Category
					   </button>
					   <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#brand_modal" onclick="$('#brand_setting_id').val({{ $row->id }});">
						  Update Brand
					   </button>
					   @if($row->grouping!=Null)
					   <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#grouping_modal" onclick="groupingFunction({{ $row->id }},'{{ $row->grouping }}')">
						  Grouping Name
					   </button>
					   @endif
					   
					   <a href="advance_product_unsubscribe/{{ $row->id }}" class="btn btn-warning btn-sm" onclick="return confirm('Are you sure ?')">
						  Unsubscribe
					   </a>
					   <a href="{{ url('admin/advance_product_excel_download/'.$row->id) }}" class='btn btn-sm'>Download Excel</a>
					</td>
				  </tr>
				@endforeach
				@if(count($un_subscribed))
					<tr>
				      <th colspan='7'><h2>Unsubscribed but Product Added</h2></th>
				    </tr>
					<tr>
					   <th>#</th>
					   <th colspan='3'>Name</th>
					   <th>Category</th>
					   <th>Sub Category	</th>
					   <th>Product Count</th>
					</tr>
					@foreach($un_subscribed as $un_key=>$un_row)
				    <tr>
					   <td>{{ $un_key+1 }}</td>
					   <td colspan='3'>{{ $un_row->name }}</td>
				       <td>{{ $un_row->categories_name }}</td>
				       <td>{{ $un_row->sub_categories_name }}</td>
				       <td>{{ $un_row->added_product }}</td>
					</tr>
				    @endforeach
				@endif
				</tbody>
			  </table>
			  <!---------------------------------------------->
			  <div class="modal" id="grouping_modal">
				  <div class="modal-dialog">
					<div class="modal-content">

					  <!-- Modal Header -->
					  <div class="modal-header">
						<h4 class="modal-title">Grouping Modal</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					  </div>

					  <!-- Modal body -->
					  <div class="modal-body">
					  {!! Form::open(['url' => 'admin/save_grouping_name', 'id' => 'save_grouping_name']) !!}
						<div class='save_grouping_name_content'>
						
						</div>
					  {!! Form::close() !!}
					  </div>

					  <!-- Modal footer -->
					  <div class="modal-footer">
					   
					    <input type='hidden' id='grouping_setting_id' name='grouping_setting_id' form='save_grouping_name'>
						<button form='save_grouping_name' type="submit" class="btn btn-primary" >Update</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					  </div>

					</div>
				  </div>
				</div>
			  <!---------------------------------------------->
			  <!---------------------------------------------->
			  <div class="modal" id="category_modal">
				  <div class="modal-dialog">
					<div class="modal-content">

					  <!-- Modal Header -->
					  <div class="modal-header">
						<h4 class="modal-title">Update Category</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					  </div>

					  <!-- Modal body -->
					  <div class="modal-body">
					  {!! Form::open(['url' => 'admin/save_subscription_category', 'id' => 'save_subscription_category']) !!}
						<div class="form-group">
							<label for="email">Category:</label>
							<select class="form-control" onchange='getSubCategory(this.value)' id='category' name='category'>
							<option value=''></option>
							@foreach($category as $row)
							  <option value='{{ $row->id }}'>{{ $row->name }}</option>
							@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="pwd">Sub Category:</label>
							<select class="form-control"  id='sub_category' name='sub_category'>
							</select>
						 </div>
					  {!! Form::close() !!}
					  </div>

					  <!-- Modal footer -->
					  <div class="modal-footer">
					    <input type='hidden' id='setting_id' name='setting_id' form='save_subscription_category'>
						<button form='save_subscription_category' type="submit" class="btn btn-primary" >Update</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					  </div>

					</div>
				  </div>
				</div>
			  <!---------------------------------------------->
			  <!---------------------------------------------->
			  <div class="modal" id="brand_modal">
				  <div class="modal-dialog">
					<div class="modal-content">

					  <!-- Modal Header -->
					  <div class="modal-header">
						<h4 class="modal-title">Update Brand</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					  </div>
 
					  <!-- Modal body -->
					  <div class="modal-body">
					  {!! Form::open(['url' => 'admin/save_brand_for_template', 'id' => 'save_brand_for_template']) !!}
						<div class="form-group">
							<label for="email">Brand:</label>
							<select class="form-control searchable_class"  id='brand' name='brands[]' multiple>
							@foreach($brand as $row)
							  <option value='{{ $row->id }}'>{{ $row->name }}</option>
							@endforeach
							</select>
						</div>
						
					  {!! Form::close() !!}
					  </div>

					  <!-- Modal footer -->
					  <div class="modal-footer">
					    <input type='hidden' id='brand_setting_id' name='brand_setting_id' form='save_brand_for_template'>
						<button form='save_brand_for_template' type="submit" class="btn btn-primary" >Update</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					  </div>

					</div>
				  </div>
				</div>
			  <!---------------------------------------------->
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
                                    <li class="col-lg-3 col-md-4 col-sm-6" onclick="openFolder('{{$image->id}}','view')">
                                        <img src="http://ecommerce.uniqueandcommon.com/assets/images/folder.png" class="img-thumbnail">
                                        <h6 class="users_name">{{$image->title}}</h6>
                                    </li>
                                @else
                                    <li class="col-lg-3 col-md-4 col-sm-6" onclick="setImageUrl('{{$image->name}}','view')">
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
{!! Form::open(['url' => 'admin/save_category_banner', 'id' => 'save_category_banner']) !!}
<input type='hidden' name='category_banner_id' id='category_banner_id'>
<input type='hidden' name='category_banner_url' id='category_banner_url'>
{!! Form::close() !!}
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$('.searchable_class').select2({
	 width: 'resolve'
});
function getSubCategory(value){
	$('#sub_category').html("<option value=''></option>");
	if(value!=''){
		$.ajax({
		  url: "{{ url('admin/getSubCategory') }}/"+value,
		  cache: false,
		  success: function(data){
			if(data.length){
				for(var i = 0;i<data.length;i++){
					$('#sub_category').append($("<option></option>").attr("value", data[i].id).text(data[i].name)); 
				}
			}
		  }
		});
	}else{
		$('#sub_category').html("<option value=''></option>");
	}
}
function groupingFunction(id,value){
	$('#grouping_setting_id').val(id);
	var array = value.split(",");
	var html = '';
	for(var i =0;i<array.length;i++){
		html += '<div class="form-group"><label>'+array[i]+':</label><input type="hidden" class="form-control" value="'+array[i]+'" name="label[]" form="save_grouping_name"><input type="text" class="form-control" placeholder="Grouping Name" name="value[]"  form="save_grouping_name"></div>';
		$('#save_grouping_name .save_grouping_name_content').html(html);
	}
}
</script>
@stop