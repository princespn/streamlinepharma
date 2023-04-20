@extends('layouts.app')

@section('pageTitle')

    <div class="float-right">
        <a href="{{route('userReason.index')}}" class="btn btn-outline-light">
            Back
        </a>
    </div>
    <h4 class="page-title"> <i class="dripicons-toggles"></i> Edit User Reason</h4>
    
@endsection

@section('contentData')

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    {{ Form::model($userReason, array('route' => array('userReason.update', $userReason->id), 'method' => 'PUT','enctype'=>'multipart/form-data')) }}
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
                                    <label>Select Type</label>
                                    <select name="type" class="form-control select2" required>
                                        <option value="1" {{$userReason->type == 1 ? 'selected' : ''}}>Cancel</option>
                                        <option value="2" {{$userReason->type == 2 ? 'selected' : ''}}>Return</option>
                                        <option value="3" {{$userReason->type == 3 ? 'selected' : ''}}>Replacement</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" value="{{$userReason->title}}" required/>
                                </div>
                            </div>

                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Select Status</label>
                                    <select name="status" class="form-control select2" value="{{$userReason->status}}" required>
                                        <option value="0" {{$userReason->status == 0 ? 'selected' : ''}}>Inactive</option>
                                        <option value="1" {{$userReason->status == 1 ? 'selected' : ''}}>Active</option>
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