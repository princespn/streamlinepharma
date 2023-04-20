@extends('layouts.app')

@section('pageTitle')

    @if (count($shippingList) == 0)
        <div class="float-right">
            <a href="{{route('shipping.create')}}" class="btn btn-outline-light">
                Add shipping policy
            </a>
        </div>
    @endif

    <h4 class="page-title"> <i class="dripicons-list"></i> Shipping Policy listing</h4>

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
                                <th>Heading</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shippingList as $key=>$shipping)
                                <tr>
                                    <td>                                    
                                        <!--Edit Icon-->
                                        <a href="{{ URL::to('admin/shipping/'. $shipping->id.'/edit') }}">
                                            <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>
                                        </a>
                                    </td>
                                    <td>{{$shipping->heading}}</td>
                                    <td>
                                        @switch($shipping->status)

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