@extends('layouts.app')

@section('pageTitle')

    <div class="float-right">

        <input type="hidden" value="1" id="position">
        <input type="hidden" value="{{ csrf_token() }}" id="csrfToken">
        <a href="{{route('category.index')}}" class="btn btn-outline-light">

            Back

        </a>

    </div>

    <h4 class="page-title"> <i class="dripicons-wallet"></i> Add category</h4>



@endsection

@section('contentData')

    <div class="row">

        <div class="col-12">

            <div class="card m-b-20">

                <div class="card-body">

                    {!! Form::open(['route' => 'category.store','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}

                    {{ csrf_field() }}                

                        <div class="row">

                            <div class="col-sm-12 col-md-12 col-lg-12">

                                @if($errors->any())

                                    <div class="alert bg-danger text-white msgPopup" role="alert">

                                    {{$errors->first()}}

                                    </div>

                                @endif

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>Select Default Category</label>

                                    <select name="ref_id" class="form-control select2">

                                        <option value="">Select Default Category</option>

                                        @foreach ($categoryList as $key=>$category)



                                            @if($category->parentCategory && $category->parentCategory->parentCategory)



                                                <option value="{{$category->parentCategory->parentCategory->id}}"> {{ $category->parentCategory->parentCategory->name }} -> {{ $category->parentCategory->name }}  -> {{ $category->name }} </option>



                                            @elseif($category->parentCategory)

                                                <option value="{{$category->parentCategory->id}}">{{ $category->parentCategory->name }}  -> {{ $category->name }} </option>

                                            @else

                                                <option value="{{$category->id}}">{{ $category->name }} </option>

                                            @endif

                                        @endforeach

                                    </select>

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>Name</label>

                                    <input type="text" name="name" class="form-control" required/>

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label onclick="openImagePopup(1)">Image url for website <i class="mdi mdi-file-image"></i></label>

                                    <input type="text" onchange="validateImageUrl(1)" name="website_url_image" id="image1" class="form-control" required/>

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label onclick="openImagePopup(2)">Image url for mobile <i class="mdi mdi-file-image"></i></label>

                                    <input type="text" onchange="validateImageUrl(2)" name="mobile_url_image" id="image2" class="form-control" required/>

                                </div>

                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">

                                <div class="form-group">

                                    <label>Description</label>

                                    <textarea name="description" class="summernote" required></textarea>

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