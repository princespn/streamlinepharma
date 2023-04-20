@extends('layouts.app')

@section('pageTitle')

    <div class="float-right">
        <a href="{{route('affiliationCreditAmt.index')}}" class="btn btn-outline-light">
            Back
        </a>
    </div>
    <h4 class="page-title"> <i class="dripicons-user-group"></i> Credit Domain Affiliation Amt.</h4>

@endsection

@section('contentData')

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">

                    {!! Form::open(['route' => 'affiliationCreditAmt.store','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
                    {{ csrf_field() }}
                
                        <div class="row">

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                @if($errors->any())
                                    <div class="alert bg-danger text-white msgPopup" role="alert">
                                    {{$errors->first()}}
                                    </div>
                                @endif
                            </div>

                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Select Domain</label>
                                    <select name="account_id" class="form-control select2" required>
                                        <option value="">Select Domain</option>
                                            @foreach ($accountList as $key=>$account)
                                                <option value="{{$account->id}}">{{$account->domain}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" name="amount" class="form-control" max="50000" required/>
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