@extends('layouts.app')

@section('pageTitle')

    <div class="float-right">
        <a href="{{route('shipping.index')}}" class="btn btn-outline-light">
            Back
        </a>
    </div>
    <h4 class="page-title"> <i class="dripicons-list"></i> Edit shipping policy</h4>
    
@endsection

@section('contentData')

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    {{ Form::model($shipping, array('route' => array('shipping.update', $shipping->id), 'method' => 'PUT','enctype'=>'multipart/form-data')) }}
                    {{ csrf_field() }}
                
                        <div class="row">

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                @if($errors->any())
                                    <div class="alert bg-danger text-white msgPopup" role="alert">
                                    {{$errors->first()}}
                                    </div>
                                @endif
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Heading</label>
                                    <input type="text" name="heading" class="form-control" value="{{$shipping->heading}}" required/>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="summernote">{{$shipping->description}}</textarea>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Select Status</label>
                                    <select name="status" class="form-control select2" value="{{$shipping->status}}" required>
                                        <option value="0" {{$shipping->status == 0 ? 'selected' : ''}}>Inactive</option>
                                        <option value="1" {{$shipping->status == 1 ? 'selected' : ''}}>Active</option>
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

@endsection