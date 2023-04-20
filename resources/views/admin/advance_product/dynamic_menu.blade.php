@extends('layouts.app')

@section('pageTitle')


<div class="float-right">
  
  <a class="btn btn-outline-light" href="{{url('admin/view_advance_product')}}">View Added Product</a>
    
</div>
<h4 class="page-title"> <i class="dripicons-calendar"></i>Dynamic Menu</h4>

@endsection

@section('contentData')


<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
		    <div class="card-header">Dynamic Menu</div>
            <div class="card-body">
			@if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
		    @endif
			{!! Form::open(['url' => 'admin/dynamic_menu','class'=>'']) !!}
			  <div class='form-group'>
			     <label for="category">Category:</label>
				 <select id="category" name="category" class="form-control">
				    <option></option>
					@foreach($category as $row)
					   <option value='{{ $row->id }}'>{{ $row->name }}</option>
					@endforeach
				 </select>
			  </div>
			  <div class='form-group'>
			     <label for="sub_category">Sub Category:</label>
				 <select id="sub_category" name="sub_category" class="form-control">
				    <option></option>
					@foreach($sub_category as $row)
					   <option value='{{ $row->id }}'>{{ $row->name }}</option>
					@endforeach
				 </select>
			  </div>
			  <div class='form-group'>
			     <label for="setting">Template:</label>
				 <select id="setting" name="setting" class="form-control" required>
				    <option></option>
					@foreach($subscribed as $row)
					   <option value='{{ $row->id }}'>{{ $row->name }}</option>
					@endforeach
				 </select>
			  </div>
			  
			  <div class='form-actions' style='text-align:center'>
                  <input type="hidden" value="" id="position">			  			  
				  <button type="submit" class="btn btn-primary" style='width:100%'>Add</button>
			  </div>
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
				      <th>Category</th>
				      <th>Sub Category</th>
				      <th>Menu</th>
				      <th>Grouping</th>
					  <th width='150'>Return, Replace & Cancel Reason</th>	
					  <th width="480">Action</th>
				   </tr>
				</thead>
				<tbody>
			      @foreach($data as $key=>$row)
				     <tr>
					    <td>{{ $key+1 }}</td>
					    <td>{{ ($row->cat ? $row->cat->name : '') }}</td>
					    <td>{{ ($row->sub_cat ? $row->sub_cat->name : '') }}</td>
					    <td>{{ ($row->template ? $row->template->name : '') }}</td>
					    <td>
						@if($row->template->grouping!=Null)
					      <strong>Grouping Available on : </strong> {{ $row->template->grouping }}
						  @if($row->grouping_name!=Null&&count(json_decode($row->grouping_name,true)))
							  @foreach(json_decode($row->grouping_name,true)[0] as $kr=>$gr)
							  <br><strong>{{ $gr }} : </strong> {{ json_decode($row->grouping_name,true)[1][$kr] }}
							  @endforeach
						  @endif
						@endif
						</td>
					    <td>
						  <strong>Return : </strong>{{ $row->template->is_return }}
						  <br>
						  <strong>Replace : </strong>{{ $row->template->is_replace }}
						  <br>
						  <strong>Cancel Reason : </strong>{!! ($row->template->cancel_reason ? '<br>'.implode('<br>',explode(',',$row->template->cancel_reason)) : '') !!}
						  <br>
						  <a href="{{ url('admin/advance_product_category_action/'.$row->setting) }}" class='btn btn-primary btn-sm'>Edit</a>
						</td>
					    <td>
						<a href="{{ url('admin/add_advance_product/'.$row->id) }}" class='btn btn-primary btn-sm'>+</a>
						<a href="{{ url('admin/delete_dynamic_menu/'.$row->id) }}" class='btn btn-sm btn-xs btn-danger'>Delete</a>
						<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#brand_modal" onclick="$('#brand_setting_id').val({{ $row->id }});">
						  Update Brand
					   </button>
					   
					   <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#grouping_modal" onclick="groupingFunction({{ $row->id }},'{{ $row->template->grouping }}')">
						  Grouping Name
					   </button>
					   
					   
					   
					   <a href="#" class='btn btn-sm btn-info'>Download Excel</a>
						</td>
					 </tr>
				  @endforeach
				</tbody>
			  </table>
			  
			</div>
		</div>
	</div>
</div>
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
@endsection
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
