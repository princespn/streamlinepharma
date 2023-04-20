@extends('layouts.app')

@section('pageTitle')
<div class="float-right">
    <a href="{{route('currency.create')}}" class="btn btn-outline-light">
        Add currency
    </a>
</div>
<h4 class="page-title"> <i class="dripicons-wallet"></i> Currency listing</h4>

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
                                <th>Title</th>
                                <th>Code</th>
                                <th>Symbol Side</th>
                                <th>Symbol</th>
                                <th>Value</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($currencyList as $key=>$currency)
                                <tr>
                                    <td>
                                        
                                        <!--Delete Popup-->
                                        @if($currency->id != 1)

                                            <i class="mdi mdi-delete btn btn-outline-danger" data-toggle="modal" data-target=".deletePopup{{$currency->id}}" title="Delete this data"></i>

                                            <div class="modal fade deletePopup{{$currency->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title mt-0">{{$currency->title}}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure want to delete this?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            {{ Form::open(array('url' => 'admin/currency/' . $currency->id)) }}
                                                            {{ Form::hidden('_method', 'DELETE') }}
                                                                <button type="submit" class="btn btn-outline-danger">Yes</button>
                                                            {{ Form::close() }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endif

                                        <!--Edit Icon-->
                                        <a href="{{ URL::to('admin/currency/' . $currency->id . '/edit') }}">
                                            <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>
                                        </a>
                                    </td>
                                    <td>{{$key+1}}</td>
                                    <td>{{$currency->title}}</td>
                                    <td>{{$currency->code}}</td>
                                    <td>
                                        @switch($currency->symbolSide)
                                            @case(1)
                                                Left
                                                @break
                                                
                                            @default
                                                Right
                                        @endswitch
                                    </td>
                                    <td>{{$currency->symbol}}</td>
                                    <td>{{ number_format($currency->value, 2)}}</td>
                                    <td>
                                        @switch($currency->status)

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