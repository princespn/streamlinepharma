@extends('layouts.app')

@section('pageTitle')

    <div class="float-right">
        <a href="{{route('extraService.index')}}" class="btn btn-outline-light">
            Back
        </a>
    </div>
    <h4 class="page-title"> <i class="dripicons-list"></i> Add extra service</h4>

@endsection

@section('contentData')

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">

                    {!! Form::open(['route' => 'extraService.store','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
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
                                    <label>Delivery Status</label>
                                    <select name="delivery" class="form-control select2" required>
                                        <option value="0">Inactive</option>
                                        <option value="1">Active</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-8 col-lg-9">
                                <div class="form-group">
                                    <label>Delivery Title</label>
                                    <input type="text" name="deliveryTitle" class="form-control" required/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Money Back Status</label>
                                    <select name="moneyBack" class="form-control select2" required>
                                        <option value="0">Inactive</option>
                                        <option value="1">Active</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-8 col-lg-9">
                                <div class="form-group">
                                    <label>Money Back Title</label>
                                    <input type="text" name="moneyBackTitle" class="form-control" required/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Support Status</label>
                                    <select name="support" class="form-control select2" required>
                                        <option value="0">Inactive</option>
                                        <option value="1">Active</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-8 col-lg-9">
                                <div class="form-group">
                                    <label>Support Title</label>
                                    <input type="text" name="supportTitle" class="form-control" required/>
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