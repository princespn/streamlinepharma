@extends('layouts.app')



@section('pageTitle')



    <h4 class="page-title"> <i class="dripicons-list"></i> Product Inquiry listing</h4>



@endsection



@section('contentData')



    <div class="row">

        <div class="col-12">

            <div class="card m-b-20">

                <div class="card-body">

                    <table id="datatable" class="table table-bordered">

                        <thead>

                            <tr>

                                <th>Product</th>

                                <th>Title</th>

                                <th>Description</th>

                                <th>Name</th>

                                <th>Phone</th>

                                <th>Email</th>

                                <th>Inquiry Type</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($inquiryList as $key=>$inquiry)

                                <tr>

                                    <td>{{$inquiry->productvariations[0]->productName}} - {{$inquiry->productvariations[0]->sku}}</td>

                                    <td>{{$inquiry->title}}</td>

                                    <td>{{$inquiry->description}}</td>

                                    <td>{{$inquiry->name}}</td>

                                    <td>{{$inquiry->phone}}</td>

                                    <td>{{$inquiry->email}}</td>

                                    <td>{{$inquiry->affiliate_id == null ? 'General' : 'Affiliate'}}</td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>



                </div>

            </div>

        </div>

    </div>



@endsection