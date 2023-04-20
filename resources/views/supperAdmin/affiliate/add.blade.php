@extends('layouts.app')

@section('pageTitle')

    <div class="float-right">
        <a href="{{route('affiliate.index')}}" class="btn btn-outline-light">
            Back
        </a>
    </div>
    <h4 class="page-title"> <i class="dripicons-user-group"></i> Add affiliate</h4>

@endsection

@section('contentData')

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">

                    {!! Form::open(['route' => 'affiliate.store','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
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
                                    <input type="text" name="name" class="form-control" required/>
                                </div>
                            </div>

                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="number" name="phone" class="form-control" required/>
                                </div>
                            </div>

                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" required/>
                                </div>
                            </div>

                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control" required/>
                                </div>
                            </div>

                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Commission in %</label>
                                    <input type="text" name="commission" class="form-control" required/>
                                </div>
                            </div>

                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" required/>
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