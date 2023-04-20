@extends('layouts.app')

@section('pageTitle')

    <div class="float-right">
        <a href="{{route('currency.index')}}" class="btn btn-outline-light">
            Back
        </a>
    </div>
    <h4 class="page-title"> <i class="dripicons-wallet"></i> Edit currency</h4>
    
@endsection

@section('contentData')

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    {{ Form::model($currency, array('route' => array('currency.update', $currency->id), 'method' => 'PUT','enctype'=>'multipart/form-data')) }}
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
                                <input type="text" name="title" class="form-control" value="{{$currency->title}}" required/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Code</label>
                                    <input type="text" name="code" class="form-control" value="{{$currency->code}}" required/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Select Symbol Side</label>
                                    <select name="symbolSide" class="form-control select2" value="{{$currency->symbolSide}}" required>
                                        <option value="">Select Symbol Side</option>
                                        <option value="1" {{$currency->symbolSide == 1 ? 'selected' : ''}}>Left</option>
                                        <option value="2" {{$currency->symbolSide == 2 ? 'selected' : ''}}>Right</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Symbol</label>
                                    <input type="text" name="symbol" class="form-control" value="{{$currency->symbol}}" required>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Value</label>
                                    <input type="text" name="value" class="form-control" value="{{$currency->value}}" required>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Select Status</label>
                                    <select name="status" class="form-control select2" value="{{$currency->status}}" required>
                                        <option value="0" {{$currency->status == 0 ? 'selected' : ''}}>Inactive</option>
                                        <option value="1" {{$currency->status == 1 ? 'selected' : ''}}>Active</option>
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