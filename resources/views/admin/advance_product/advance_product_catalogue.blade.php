@extends('layouts.app')
@section('pageTitle')
<style>
.hide{
	display:none;
}
</style>
<h4 class="page-title"> <i class="dripicons-calendar"></i>Advance Product Catalogue</h4>
@endsection
@section('contentData')
<div class="row">
   <div class="col-12">
      <div class="card m-b-20">
         <div class="card-header">Advance Product Catalogue</div>
         <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success">
               {{ session('status') }}
            </div>
            @endif
            {!! Form::open(['url' => 'admin/advance_product_catalogue']) !!}
            <div class="form-group">
               <label for="title">Title :</label>
               <input type='text' @if(isset($pre)) value="{{ $pre->title }}" @endif required name='title'  class='form-control'>
            </div>
			<div class="form-group">
               <label for="description">Description :</label>
               <textarea type='text'   name='description' required class='form-control'>@if(isset($pre)) {{ $pre->description }} @endif</textarea>
            </div>
			<div class='form-group'>
			     <label for="image">Image:</label>
				 <div class="input-group">
				   <input readonly type="text"  class="form-control" name="image" id="imageimage" required="" required @if(isset($pre)) value="{{ $pre->image }}" @endif>
				   <div class="input-group-prepend" onclick="openImagePopup('image')">
					  <span class="input-group-text"><i class="mdi mdi-file-image"></i></span>
				   </div>
				</div>
			</div>
            <div class="form-group">
               <label for="order">Order :</label>
               <input type='number' required name='order' class='form-control' @if(isset($pre)) value="{{ $pre->order }}" @endif>
            </div>
            <div class="form-actions" style="text-align:center;margin-top:40px">
               <input type="hidden" class="id" name="product_id" value="{{ $id }}">
			   @if(isset($pre))  
				   <input type="hidden" value="{{ $pre->id }}" name="pre_id">
			   @endif
			   <input type="hidden" value="" id="position">
               <input type="submit" class="btn btn-outline-success" value="@if(isset($pre)) Update @else Add @endif">
            </div>
            {!! Form::close() !!}
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-12">
      <div class="card m-b-20">
         <div class="card-header">View Advance Product Catalogue</div>
         <div class="card-body">
            <table class='table table-bordered table-striped'>
              <thead>
			     <tr>
				     <th>#</th>
				     <th>Title</th>
				     <th>Description</th>
				     <th>Image</th>
				     <th>Order</th>
				     <th>Action</th>
				 </tr>
			  </thead>
			  <tbody>
			     @if(count($data))
				  @foreach($data as $key=>$row)
                    <tr>
					  <td>{{ ($key+1) }}</td>
					  <td>{{ $row->title }}</td>
					  <td>{{ $row->description }}</td>
					  <td><img src='{{ url($row->image) }}' width='50'></td>
					  <td>{{ $row->order }}</td>
					  <td>
					     <a class='btn btn-primary btn-xs btn-sm' href="{{ url('admin/advance_product_catalogue/'.$id.'/'.$row->id) }}" >Edit</a>
					     <a class='btn btn-danger btn-xs btn-sm' href="{{ url('admin/advance_product_catalogue_delete/'.$row->id) }}" >Delete</a>
					  </td>
					</tr>
                  @endforeach			  
				 @else
				 <tr>
				   <td colspan='5'>No Data Found</td>
				 </tr>
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