@extends('layouts.app')

@section('pageTitle')

<div class="float-right">
    <a href="{{route('schemes.index')}}" class="btn btn-outline-light">
        Back
    </a>
</div>

<input type="hidden" value="1" id="position">
<h4 class="page-title"> <i class="dripicons-calendar"></i>Add Scheme</h4>

@endsection

@section('contentData')

<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">
                {!! Form::open(['route' => 'schemes.store','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        @if($errors->any())
                        <div class="alert bg-danger text-white msgPopup" role="alert">
                            {{$errors->first()}}
                        </div>
                        @endif
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label>Scheme Name</label>
                                    <input type="text" placeholder="Enter schemes name" name="schemes" class="form-control" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <label onclick="openImagePopup('schemes')">Scheme Banner File</label>
                                    <input type="text" id="imageschemes" onclick="openImagePopup('schemes')" placeholder="Choose image file" value="" name="schemes_file" class="form-control " required />
                                </div>
                            </div>
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
                                <img src="{{URL::asset($image->name)}}" class="img-thumbnail">
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