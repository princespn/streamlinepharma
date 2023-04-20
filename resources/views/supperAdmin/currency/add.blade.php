@extends('layouts.app')

@section('pageTitle')

    <div class="float-right">
        <a href="{{route('currency.index')}}" class="btn btn-outline-light">
            Back
        </a>
    </div>
    <h4 class="page-title"> <i class="dripicons-wallet"></i> Add currency</h4>

@endsection

@section('contentData')

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">

                    {!! Form::open(['route' => 'currency.store','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
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
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" required/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Code</label>
                                    <input type="text" name="code" class="form-control" required/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Select Symbol Side</label>
                                    <select name="symbolSide" class="form-control select2" required>
                                        <option value="">Select Symbol Side</option>
                                        <option value="1">Left</option>
                                        <option value="2">Right</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Symbol</label>
                                    <input type="text" name="symbol" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Value</label>
                                    <input type="text" name="value" class="form-control" required>
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