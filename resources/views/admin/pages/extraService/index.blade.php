@extends('layouts.app')

@section('pageTitle')

    @if (count($extraServiceList) == 0)
        <div class="float-right">
            <a href="{{route('extraService.create')}}" class="btn btn-outline-light">
                Add extra service
            </a>
        </div>
    @endif

    <h4 class="page-title"> <i class="dripicons-list"></i> Extra service listing</h4>

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
                                <th>Delivery</th>
                                <th>Delivery Title</th>
                                <th>Money Back</th>
                                <th>Money Back Title</th>
                                <th>Support</th>
                                <th>Support Title</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($extraServiceList as $key=>$extraService)
                                <tr>
                                    <td>                                    
                                        <!--Edit Icon-->
                                        <a href="{{ URL::to('admin/extraService/'. $extraService->id.'/edit') }}">
                                            <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>
                                        </a>
                                    </td>
                                    <td>
                                        @switch($extraService->delivery)

                                            @case(1)
                                                
                                                <i class="mdi mdi-checkbox-blank-circle text-success"></i> On
                                            @break

                                            @default
                                            
                                                <i class="mdi mdi-checkbox-blank-circle text-warning"></i> Off
                                        @endswitch
                                    </td>
                                    <td>{{$extraService->deliveryTitle}}</td>
                                    <td>
                                        @switch($extraService->moneyBack)

                                            @case(1)
                                                
                                                <i class="mdi mdi-checkbox-blank-circle text-success"></i> On
                                            @break

                                            @default
                                            
                                                <i class="mdi mdi-checkbox-blank-circle text-warning"></i> Off
                                        @endswitch
                                    </td>
                                    <td>{{$extraService->moneyBackTitle}}</td>
                                    <td>
                                        @switch($extraService->support)

                                            @case(1)
                                                
                                                <i class="mdi mdi-checkbox-blank-circle text-success"></i> On
                                            @break

                                            @default
                                            
                                                <i class="mdi mdi-checkbox-blank-circle text-warning"></i> Off
                                        @endswitch
                                    </td>
                                    <td>{{$extraService->supportTitle}}</td>
                                    <td>
                                        @switch($extraService->status)

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