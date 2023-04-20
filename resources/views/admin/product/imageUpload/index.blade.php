@extends('layouts.app')

@section('pageTitle')
<div class="float-right">

    @php $ref_id = $_GET['ref_id']; @endphp
    <input type="hidden" value="{{ $ref_id }}" id="ref_id" form='image_upload_form' name='ref_id'>
    <input type="hidden" value="{{ csrf_token() }}" id="csrfToken">
    
    @if($ref_id == 0)
        <button data-toggle="modal" data-target=".addFolder" class="btn btn-outline-light">
            Create New Folder
        </button>
    @else 
        <a  href="{{route('imageUpload.index')}}?ref_id=0" class="btn btn-outline-light">
            Go Back
        </a>
    @endif
    
    <button data-toggle="modal" data-target=".addImages" class="btn btn-outline-light">
        Upload Images
    </button>

</div>
<h4 class="page-title"> <i class="dripicons-wallet"></i> Image listing</h4>

@endsection

@section('contentData')
  @if(session('success')||session('error'))
    <div class="row">

        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card">
			   @if(session('success'))
				   <div class="alert alert-success">
				    {!! session('success') !!}
				   </div>
			   @endif
			   @if(session('error'))
				   <div class="alert alert-danger">
				    {!! session('error') !!}
				   </div>
			   @endif
			</div>
	    </div>
	</div>
  @endif
    <div class="row">

        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="mb-2 text-center card-body text-muted">
                    <ul class="new_friend_list list-unstyled row">
                        @foreach ($imageUploadList as $key=>$image)
                            
                            @if($image->mediaType == 1)
                            <li class="col-lg-1 col-md-1 col-sm-3">

                                <a href="{{route('imageUpload.index')}}?ref_id={{$image->id}}">
                                    <img src="http://ecommerce.uniqueandcommon.com/assets/images/folder.png" class="img-thumbnail">
                                    <h6 class="users_name">{{$image->title}}</h6>
                                </a>
                                <i class="mdi mdi-pencil" data-toggle="modal" data-target="#renameFolder" onclick='$("#renameFolder #title").val("{{$image->title}}");$("#renameFolder #id").val("{{$image->id}}");'></i>
                            </li>
                            @else
                            <li class="col-lg-1 col-md-2 col-sm-3" onclick="$('#image_display_modal .modal-header').html('{{$image->title}}');
							$('#image_display_modal .modal-body').html('<img src=\'{{URL::asset($image->name)}}\'>');">
                                <img src="{{URL::asset($image->name)}}" class="img-thumbnail" data-toggle="modal" data-target="#image_display_modal">
                                <h6 class="users_name">{{$image->title}}</h6>
								<i class="mdi mdi-pencil" data-toggle="modal" data-target="#renameFolder" onclick='$("#renameFolder #title").val("{{$image->title}}");$("#renameFolder #id").val("{{$image->id}}");'></i>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade addFolder" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title mt-0">Create New Folder</h5>

                    <button type="button" id="createFolder" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <input type="text" id="folderName" class="form-control" />
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" onclick="createFolder();">Submit</button>
                </div>

            </div>

        </div>

    </div>

    <div class="modal fade addImages" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title mt-0">Upload Image</h5>
                    
                    <button type="button" id="uploadImage" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                </div>

                <div class="modal-body">
				{!! Form::open(['url' => 'admin/image_upload_form','id'=>'image_upload_form', 'files' => true]) !!}
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <select class="select2 form-control" id="mediaType" required>
                                    <option value="1">Product</option>
                                    <option value="2">Slider</option>
                                </select>
                            </div>
                        </div>
						<!--div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <input class="select2 form-control" name="filename" placeholder="File Name" id="fileName" required />
                            </div>
                        </div-->

                        <div class="col-sm-6 col-md-12 col-lg-12">
                            <div class="form-group">
                                <input type="file" multiple id="image" name='images[]' class="form-control"  accept="image/x-png,image/gif,image/jpeg"required />
                            </div>
                        </div>
                    </div>
				  {!! Form::close() !!}
                </div>

                <div class="modal-footer">
                    <div class="text-left">
                        1. Slider image dimension sould be 1242px and 450px <br>
                        2. Product image dimension sould be less than 800px and 960px
                    </div>
                    <button type="submit" class="btn btn-outline-danger" form='image_upload_form'>Submit</button>
                </div>

            </div>

        </div>

    </div>
 <!------------------------------------------>
 <!-- The Modal -->
<div class="modal" id="image_display_modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
 <!------------------------------------------>
 <div class="modal" id="renameFolder">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Rename</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
	  {!! Form::open(['url' => 'admin/rename_form','id'=>'rename_form']) !!}
        <input type='text' name='title' id='title' form='rename_form' class='form-control'>
        <input type='hidden' id='id' name='id' form='rename_form' class='form-control'>
	  {!! Form::close() !!}
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit"  form='rename_form' class="btn btn-primary" >Update</button>
        <button type="button"   class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
 <!------------------------------------------>
@endsection