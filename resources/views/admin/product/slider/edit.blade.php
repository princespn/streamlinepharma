@extends('layouts.app')



@section('pageTitle')



    <div class="float-right">

        <input type="hidden" value="1" id="position">
        <input type="hidden" value="{{ csrf_token() }}" id="csrfToken">
        <a href="{{route('slider.index')}}" class="btn btn-outline-light">

            Back

        </a>

    </div>

    <h4 class="page-title"> <i class="dripicons-toggles"></i> Edit slider</h4>

    

@endsection



@section('contentData')



    <div class="row">

        <div class="col-12">

            <div class="card m-b-20">

                <div class="card-body">

                    {{ Form::model($slider, array('route' => array('slider.update', $slider->id), 'method' => 'PUT','enctype'=>'multipart/form-data')) }}

                    {{ csrf_field() }}

                

                        <div class="row">



                            <div class="col-sm-12 col-md-12 col-lg-12">

                                @if($errors->any())

                                    <div class="alert bg-danger text-white msgPopup" role="alert">

                                    {{$errors->first()}}

                                    </div>

                                @endif

                            </div>



                            <div class="col-sm-3 col-md-3 col-lg-3">

                                <div class="form-group">

                                    <label>Title</label>

                                    <input type="text" name="title" class="form-control" value="{{$slider->title}}" required/>

                                </div>

                            </div>



                            <div class="col-sm-3 col-md-3 col-lg-3">

                                <div class="form-group">

                                    <label onclick="openImagePopup(1)">Image URL <i class="mdi mdi-file-image"></i></label>

                                    <input type="text" onchange="validateImageUrl(1)" name="imageURL" id="image1" class="form-control" value="{{$slider->imageURL}}" required/>

                                </div>

                            </div>



                            <div class="col-sm-3 col-md-3 col-lg-3">

                                <div class="form-group">

                                    <label>Link URL</label>

                                    <input type="text" name="linkURL" class="form-control" value="{{$slider->linkURL}}" required/>

                                </div>

                            </div>



                            <div class="col-sm-3 col-md-3 col-lg-3">

                                <div class="form-group">

                                    <label>Select Status</label>

                                    <select name="status" class="form-control select2" value="{{$slider->status}}" required>

                                        <option value="0" {{$slider->status == 0 ? 'selected' : ''}}>Inactive</option>

                                        <option value="1" {{$slider->status == 1 ? 'selected' : ''}}>Active</option>

                                    </select>

                                </div>

                            </div>



                            <div class="col-sm-12 col-md-12 col-lg-12">

                                

                                <button type="submit" class="btn btn-outline-primary">

                                    Submit

                                </button>



                            </div>

                        </div>



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
                                            <h6 class="users_name">{{$image->name}}</h6>
                                        </li>
                                    @else
                                        <li class="col-lg-3 col-md-4 col-sm-6" onclick="setImageUrl('{{$image->name}}')">
                                            <img src="{{URL::asset($image->name)}}" class="img-thumbnail" >
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