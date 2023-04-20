@extends('layouts.app')

@section('pageTitle')



<h4 class="page-title"> <i class="dripicons-calendar"></i>Deals of the Day</h4>

@endsection

@section('contentData')


<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
		    <div class="card-header">Deals of the Day</div>
            <div class="card-body">
			@if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
		    @endif
			@if(count($data)<4)
			{!! Form::open(['url' => 'admin/deals-of-the-day','class'=>'']) !!}
			  <div class='form-group'>
			     <label for="sku">SKU:</label>
				 <input type="text" readonly id="sku" name="sku" class="form-control" placeholder="Deal Product" required data-toggle="modal" data-target="#offeringProductModal">
			  </div>
			  <div class='form-group'>
			     <label for="date">Valit Till:</label>
				 <input type="date" id="date" name="date" class="form-control" placeholder="" required>
			  </div>
			  
			  
			  <div class='form-group'>
			     <label for="image">Image:</label>
				 <div class="input-group">
				   <input type="text" class="form-control" name="image" id="imageimage" required="" required>
				   <div class="input-group-prepend" onclick="openImagePopup('image')">
					  <span class="input-group-text"><i class="mdi mdi-file-image"></i></span>
				   </div>
				</div>
			  </div>
			  <div class='form-actions' style='text-align:center'>
                  <input type="hidden" value="" id="position">	
                  <input type="hidden" value="{{ $type }}" id="type" name="type">		  
				  <button type="submit" class="btn btn-primary" style='width:100%'>Add</button>
			  </div>
			{!! Form::close() !!}
			@else
				<strong class='error'>Please delete any banner to add new.</strong>
			@endif
			</div>
		</div>
		<div class="card m-b-20">
		    <div class="card-header">Added</div>
            <div class="card-body">
			  <table class='table table-bordered table-striped'>
			    <thead>
				   <tr>
				      <th>#</th>
				      <th>SKU</th>
				      <th>Valid till</th>
				      <th>Image</th>
					  <th>Action</th>
				   </tr>
				</thead>
				<tbody>
			    @foreach($data as $key=>$row)
				   <tr>
				      <td>{{ $key+1 }}</td>
				      <td>{{ $row->sku }}</td>
				      <td>{{ $row->date }}</td>
				      <td><img src='{{ $row->image }}' width='120'></td>
					  <td>
					    <button type='submit' form='deleteBanner' name='delete_button' value='{{ $row->id }}' class='btn btn-danger btn-sm' onclick="return confirm('Are you sure?')">Delete</button>
					  </td>
				   </tr>
				@endforeach
				</tbody>
			  </table>
			  {!! Form::open(['url' => 'admin/home-banner-action','id'=>'deleteBanner']) !!}
			     <input type='hidden' name='banner_type' value='4' >
			  {!! Form::close() !!}
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
<!--------------------------------------------->
<div class="modal" id="offeringProductModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Offering Product</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <input type='text' class='form-control' placeholder='type sku or title' onkeyup='advanceProductSearch(this.value)'>
		<div class='result_product'></div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!--------------------------------------------->
@endsection
@section('script')
<script>
function advanceProductSearch(value){
	$.ajax({
			  url: "{{ url('admin/advance_product_search') }}",
			  data : { searchTerm:value },
			  cache: false,
			  success: function(data){
				console.log(data);
				var html = '';
				for(var i=0;i<data.length;i++){
					html += "<div class='row' style='margin-top:50px;cursor: pointer;'  data-dismiss='modal' onclick=\"$('#sku').val('"+data[i].sku+"');\"><div class='col-md-2'><img src='"+data[i].thumbnail+"' style='width: 100%'></div><div class='col-md-10'><h5 style='margin:0px'>"+data[i].title+"</h5><strong> Template - </strong>"+data[i].name+"<br><strong>SKU - </strong>"+data[i].sku+" <strong> HSN - </strong>"+data[i].hsn_code+"<br><strong>Price - </strong>"+data[i].product_price+" <strong> "+data[i].selling_price_label+" - </strong>"+data[i].selling_price+"<br><strong> Description - </strong>"+data[i].description+"</div></div><hr>";
				}
				$('.result_product').html(html);
			  }
	});
}
</script>
@stop
