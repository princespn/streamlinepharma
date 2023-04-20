@extends('layouts.app')



@section('pageTitle')

<div class="float-right">

    <a href="{{route('offerNormal.create')}}" class="btn btn-outline-light">

        Add normal offer

    </a>

</div>

<h4 class="page-title"> <i class="dripicons-calendar"></i> Normal Offer listing</h4>



@endsection



@section('contentData')



    <div class="row">

        <div class="col-12">

            <div class="card m-b-20">

                <div class="card-body">



                    <table id="datatable" class="table table-bordered">

                        <thead>

                            <tr>

                                <th>#</th>

                                <th>No</th>

                                <th>Website</th>

                                <th>Mobile</th>

                                <th>Start Date</th>

                                <th>End Date</th>

                                <th>Coupon Code</th>

                                <th>SKU Min. Value</th>

                                <th>Discount</th>

                                <th>No Of Users</th>

                                <th>Status</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($offerNormalList as $key=>$offerNormal)

                                <tr>

                                    <td>



                                        <i class="mdi mdi-delete btn btn-outline-danger" data-toggle="modal" data-target=".deletePopup{{$offerNormal->id}}" title="Delete this data"></i>



                                        <div class="modal fade deletePopup{{$offerNormal->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

                                            <div class="modal-dialog modal-dialog-centered">

                                                <div class="modal-content">

                                                    <div class="modal-header">

                                                        <h5 class="modal-title mt-0">{{$offerNormal->couponCode}}</h5>

                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                                    </div>

                                                    <div class="modal-body">

                                                        <p>Are you sure want to delete this?</p>

                                                    </div>

                                                    <div class="modal-footer">

                                                        {{ Form::open(array('url' => 'admin/offerNormal/' . $offerNormal->id)) }}

                                                        {{ Form::hidden('_method', 'DELETE') }}

                                                            <button type="submit" class="btn btn-outline-danger">Yes</button>

                                                        {{ Form::close() }}

                                                    </div>

                                                </div>

                                            </div>

                                        </div>



                                        <!--Edit Icon-->

                                        <a href="{{ URL::to('admin/offerNormal/' . $offerNormal->id . '/edit') }}">

                                            <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>

                                        </a>

                                    </td>

                                    <td>{{$key+1}}</td>

                                    <td><img src="{{URL::asset($offerNormal->website_url_image)}}" class="d-flex align-self-end" height="20"></td>

                                    <td><img src="{{URL::asset($offerNormal->mobile_url_image)}}" class="d-flex align-self-end" height="20"></td>

                                    <td>{{$offerNormal->startDate}}</td>

                                    <td>{{$offerNormal->endDate}}</td>

                                    <td>{{$offerNormal->couponCode}}</td>

                                    <td>{{$offerNormal->cartMinValue}}</td>

                                    <td>{{$offerNormal->discount}} %</td>

                                    <td>{{$offerNormal->noOfUsers}}</td>

                                    <td>

                                        @switch($offerNormal->status)



                                            @case(1)

                                                

                                                <i class="mdi mdi-checkbox-blank-circle text-success"></i> Active

                                            @break



                                            @default

                                            

                                                <i class="mdi mdi-checkbox-blank-circle text-warning"></i> Inactive

                                        @endswitch

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>



                </div>

            </div>

        </div>

    </div>



@endsection