@extends('layouts.app')

@section('pageTitle')

    <div class="float-right">
        <a href="{{route('register.index')}}" class="btn btn-outline-light">
            Back
        </a>
    </div>
    <h4 class="page-title"> <i class="dripicons-list"></i> Edit User</h4>
    
@endsection

@section('contentData')

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    {{ Form::model($register, array('route' => array('register.update', $register->id), 'method' => 'PUT','enctype'=>'multipart/form-data')) }}
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
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="{{$register->name}}" required readonly/>
                                </div>
                            </div>

                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="number" name="phone" class="form-control" value="{{$register->phone}}" required readonly/>
                                </div>
                            </div>

                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="{{$register->email}}" required readonly/>
                                </div>
                            </div>

                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" required/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Select Status</label>
                                    <select name="status" class="form-control select2" value="{{$register->status}}" required>
                                        <option value="0" {{$register->status == 0 ? 'selected' : ''}}>Inactive</option>
                                        <option value="1" {{$register->status == 1 ? 'selected' : ''}}>Active</option>
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