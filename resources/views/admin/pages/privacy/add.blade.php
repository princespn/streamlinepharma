@extends('layouts.app')

@section('pageTitle')

    <div class="float-right">
        <a href="{{route('privacy.index')}}" class="btn btn-outline-light">
            Back
        </a>
    </div>
    <h4 class="page-title"> <i class="dripicons-list"></i> Add privacy policy</h4>

@endsection

@section('contentData')

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">

                    {!! Form::open(['route' => 'privacy.store','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
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
                                    <input type="text" name="heading" class="form-control" required/>
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

@endsection