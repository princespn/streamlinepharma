@extends('layouts.app')

@section('pageTitle')

    <div class="float-right">
        <a href="{{route('label.index')}}" class="btn btn-outline-light">
            Back
        </a>
    </div>
    <h4 class="page-title"> <i class="dripicons-tags"></i> Add label</h4>

@endsection

@section('contentData')

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">

                    {!! Form::open(['route' => 'label.store','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
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
                                    <label>Select Tag</label>
                                    <select name="tag_id" class="form-control select2" required>
                                        <option value="">Select Tag</option>
                                        @foreach ($tagList as $key=>$tag)
                                        <option value="{{$tag->id}}">{{$tag->tag}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Label</label>
                                    <input type="text" name="label" class="form-control" required/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-2">
                                <div class="form-group">
                                    <label>Highlight</label>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="highlight" value="1" class="custom-control-input" id="highlight">
                                        <label class="custom-control-label" for="highlight"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-2">
                                <div class="form-group">
                                    <label>Filter</label>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="filter" value="1" class="custom-control-input" id="filter">
                                        <label class="custom-control-label" for="filter"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-2">
                                <div class="form-group">
                                    <label>Option</label>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="option" value="1" class="custom-control-input" id="option">
                                        <label class="custom-control-label" for="option"></label>
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

@endsection