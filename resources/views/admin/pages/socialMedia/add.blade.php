@extends('layouts.app')

@section('pageTitle')

    <div class="float-right">
        <a href="{{route('socialMedia.index')}}" class="btn btn-outline-light">
            Back
        </a>
    </div>
    <h4 class="page-title"> <i class="network-2"></i> Add social media</h4>

@endsection

@section('contentData')

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">

                    {!! Form::open(['route' => 'socialMedia.store','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
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
                                    <label>Facebook</label>
                                    <input type="text" name="facebook" class="form-control" />
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Twitter</label>
                                    <input type="text" name="twitter" class="form-control"/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Google Plus</label>
                                    <input type="text" name="googleplus" class="form-control"/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Instagram</label>
                                    <input type="text" name="instagram" class="form-control"/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Pinterest</label>
                                    <input type="text" name="pinterest" class="form-control"/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Dribble</label>
                                    <input type="text" name="dribble" class="form-control"/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Vimeo</label>
                                    <input type="text" name="vimeo" class="form-control"/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Youtube</label>
                                    <input type="text" name="youtube" class="form-control"/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Latitude</label>
                                    <input type="text" name="latitude" class="form-control"/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Longitude</label>
                                    <input type="text" name="longitude" class="form-control"/>
                                </div>
                            </div>
							
							<div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Linkedin</label>
                                    <input type="text" name="linkedin" class="form-control" />
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