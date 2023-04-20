@extends('layouts.app')



@section('pageTitle')



<div class="float-right">

    <a href="{{route('offerNormal.index')}}" class="btn btn-outline-light">

        Back

    </a>

</div>

<h4 class="page-title"> <i class="dripicons-calendar"></i> Edit normal offer</h4>



@endsection



@section('contentData')



<div class="row">

    <div class="col-12">

        <div class="card m-b-20">

            <div class="card-body">

                {{ Form::model($offerNormal, array('route' => array('offerNormal.update', $offerNormal->id), 'method' => 'PUT','enctype'=>'multipart/form-data')) }}

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

                            <label>Image url for website</label>

                            <input type="text" name="website_url_image" class="form-control" value="{{$offerNormal->website_url_image}}" required />

                        </div>

                    </div>



                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>Image url for mobile</label>

                            <input type="text" name="mobile_url_image" class="form-control" value="{{$offerNormal->mobile_url_image}}" required />

                        </div>

                    </div>



                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>Coupon Code</label>

                            <input type="text" name="couponCode" class="form-control" value="{{$offerNormal->couponCode}}" required/>

                        </div>

                    </div>



                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>Start Date</label>

                            <input type="datetime-local" name="startDate" class="form-control" value="{{$offerNormal->startDate}}" required />

                        </div>

                    </div>



                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>End Date</label>

                            <input type="datetime-local" name="endDate" class="form-control" value="{{$offerNormal->endDate}}" required />

                        </div>

                    </div>



                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>SKU Min Value</label>

                            <input type="number" name="cartMinValue" class="form-control" value="{{$offerNormal->cartMinValue}}" min="10" required/>

                        </div>

                    </div>



                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>Discount (%)</label>

                            <input type="number" name="discount" class="form-control" value="{{$offerNormal->discount}}" min="1" required/>

                        </div>

                    </div>



                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>No Of Users</label>

                            <input type="number" name="noOfUsers" class="form-control" value="{{$offerNormal->noOfUsers}}" min="5" required/>

                        </div>

                    </div>



                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>Link</label>

                            <input type="text" name="link" class="form-control" value="{{$offerNormal->link}}" required />

                        </div>

                    </div>



                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>Select Status</label>

                            <select name="status" class="form-control select2" value="{{$offerNormal->status}}" required>

                                <option value="0" {{$offerNormal->status == 0 ? 'selected' : ''}}>Inactive</option>

                                <option value="1" {{$offerNormal->status == 1 ? 'selected' : ''}}>Active</option>

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

