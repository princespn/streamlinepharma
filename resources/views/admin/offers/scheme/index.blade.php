@extends('layouts.app')

@section('pageTitle')

<div class="float-right">
    <a href="{{route('offers.index')}}" class="btn btn-outline-light">
        Offer List
    </a>
    <a href="{{route('schemes.create')}}" class="btn btn-outline-light">
        Add Scheme
    </a>
</div>

<h4 class="page-title"> <i class="dripicons-calendar"></i> Scheme listing</h4>

@endsection

@section('contentData')

<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        @if($errors->any())
                        <div class="alert bg-danger text-white msgPopup" role="alert">
                            {{$errors->first()}}
                        </div>
                        @endif
                    </div>
                </div>
                <table id="datatable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Image</th>
                            <!-- <th>Status</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($offerList as $key=>$offer)
                        <tr>
                            <td>
                                <i class="mdi mdi-delete btn btn-outline-danger" data-toggle="modal" data-target=".deletePopup{{$offer->id}}" title="Delete this data"></i>
                                <div class="modal fade deletePopup{{$offer->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title mt-0">{{$offer->product_sku}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure want to delete this?</p>
                                            </div>
                                            <div class="modal-footer">
                                                {{ Form::open(array('url' => 'admin/schemes/' . $offer->id)) }}

                                                {{ Form::hidden('_method', 'DELETE') }}

                                                <button type="submit" class="btn btn-outline-danger">Yes</button>

                                                {{ Form::close() }}

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </td>
                            <td>{{$offer->title}}</td>
                            <td>
                                <img src=" {{URL::asset($offer->image_file)}}" width="100" />
                            </td>
                            <!-- <td>{{$offer->status}}</td> -->

                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

@endsection