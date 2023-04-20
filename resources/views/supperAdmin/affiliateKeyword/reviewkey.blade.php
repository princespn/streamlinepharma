@extends('layouts.app')

@section('pageTitle')

<h4 class="page-title"> <i class="dripicons-checklist"></i>Review Affiliate Keyword listing</h4>
@endsection

@section('contentData')

@if(session('message'))
<div class="">
    <div class="alert alert-success">
        {{session('message')}}
    </div>
</div>
@endif
<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">
                <table id="datatable" class="table table-bordered">
                    <thead>
                        <tr>

                            <th>#</th>
                            <th>Keyword</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($affiliateKeywordList as $key=>$affiliateKeyword)
                        <tr>
                            <td>
                                <!--Delete Popup-->
                                <i class="mdi mdi-delete btn btn-outline-danger" data-toggle="modal" data-target=".deletePopup{{$affiliateKeyword->id}}" title="Delete this data"></i>

                                <div class="modal fade deletePopup{{$affiliateKeyword->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title mt-0">{{$affiliateKeyword->keyword}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure want to delete this?</p>
                                            </div>
                                            <div class="modal-footer">
                                                {{ Form::open(array('url' => 'admin/affiliateKeyword/' . $affiliateKeyword->id)) }}
                                                {{ Form::hidden('_method', 'DELETE') }}
                                                <button type="submit" class="btn btn-outline-danger">Yes</button>
                                                {{ Form::close() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <i class="mdi mdi-check btn btn-outline-primary" data-toggle="modal" data-target=".approvePopup{{$affiliateKeyword->id}}" title="Approve this data"></i>

                                <div class="modal fade approvePopup{{$affiliateKeyword->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title mt-0">{{$affiliateKeyword->keyword}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure want to Approve this?</p>
                                            </div>
                                            <div class="modal-footer">
                                                {{ Form::open(array('url' => 'admin/affiliateKeyword/approve/' . $affiliateKeyword->id)) }}
                                                {{ Form::hidden('_method', 'POST') }}
                                                <button type="submit" class="btn btn-outline-danger">Yes</button>
                                                {{ Form::close() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>{{$affiliateKeyword->keyword}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

@endsection