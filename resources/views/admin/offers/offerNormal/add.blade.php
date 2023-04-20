@extends('layouts.app')



@section('pageTitle')



<div class="float-right">

    <a href="{{route('offerNormal.index')}}" class="btn btn-outline-light">

        Back

    </a>

</div>

<h4 class="page-title"> <i class="dripicons-calendar"></i> Add normal offer</h4>



@endsection



@section('contentData')



<div class="row">

    <div class="col-12">

        <div class="card m-b-20">

            <div class="card-body">



                {!! Form::open(['route' => 'offerNormal.store','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}

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

                            <input type="text" name="website_url_image" class="form-control" required/>

                        </div>

                    </div>



                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>Image url for mobile</label>

                            <input type="text" name="mobile_url_image" class="form-control" required/>

                        </div>

                    </div>



                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>Coupon Code</label>

                            <input type="text" name="couponCode" class="form-control" required/>

                        </div>

                    </div>



                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>Start Date</label>

                            <input type="datetime-local" name="startDate" class="form-control" required/>

                        </div>

                    </div>



                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>End Date</label>

                            <input type="datetime-local" name="endDate" class="form-control" required/>

                        </div>

                    </div>



                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>SKU Min Value</label>

                            <input type="number" name="cartMinValue" class="form-control" min="10" required/>

                        </div>

                    </div>



                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>Discount (%)</label>

                            <input type="number" name="discount" class="form-control" min="1" required/>

                        </div>

                    </div>



                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>No Of Users</label>

                            <input type="number" name="noOfUsers" class="form-control" min="5" required/>

                        </div>

                    </div>



                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>Link</label>

                            <input type="text" name="link" class="form-control" required/>

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

