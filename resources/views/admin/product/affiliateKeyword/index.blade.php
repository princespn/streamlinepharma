@extends('layouts.app')

@section('pageTitle')

<div class="float-right">
    <a href="#!" class="btn btn-outline-light" data-toggle="modal" data-target=".searchPopup">
        Add my keyword
    </a>
    <a href="{{route('keysample')}}" class="btn btn-outline-light">Download Sample</a>
</div>
<h4 class="page-title"> <i class="dripicons-checklist"></i> My Keyword listing</h4>

@endsection


@section('contentData')
@if(session('message'))
<div class="">
    <div class="alert alert-success">
        {{session('message')}}
    </div>
</div>
@endif
@if(session('duplicateKey'))
<div class="">
    <div class="alert alert-danger">
    <p>These are duplicate key. Please try to avoid these key.</p>
        {!!session('duplicateKey')!!}
    </div>
</div>
<?php session()->forget('duplicateKey');?>
@endif
<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">

                <div class="modal fade searchPopup" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title mt-0">Search/Bulk Add Keyword</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                {!! Form::open(['route' => 'accountAffiliateKeyword.create','method'=>'get','id'=>'form','enctype'=>'multipart/form-data']) !!}
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="text" name="search" class="form-control" placeholder="search keyword" required />
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-outline-danger">Search</button>
                                </div>
                                {!! Form::close() !!}
                                <hr />
                                {!! Form::open(['route' => 'bulkeyword','method'=>'post','id'=>'bulkform','enctype'=>'multipart/form-data']) !!}
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="file" name="keyword" class="form-control" pattern="^.+\.(xlsx|xls)$" placeholder="upload keyword file" required />
                                    <label>Note:-Download Sample File, add keyword then submit.</label>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-outline-danger">Submit</button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                            <div class="modal-footer">

                            </div>

                        </div>
                    </div>
                </div>

                <table id="datatable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Keyword</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($affiliateKeywordList as $key=>$affiliateKeyword)
						@if($affiliateKeyword->keyword)
                        <tr>
                            <td>{{$affiliateKeyword->keyword?$affiliateKeyword->keyword->keyword:''}}</td>
                            <td>
                                @if($affiliateKeyword->keyword && $affiliateKeyword->status==2)
                                Pending
                                @else
                                Approved
                                @endif
                            </td>
                        </tr>
						@else
						@endif
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

@endsection