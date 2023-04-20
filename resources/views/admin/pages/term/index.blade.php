@extends('layouts.app')

@section('pageTitle')

    @if (count($termList) == 0)
        <div class="float-right">
            <a href="{{route('term.create')}}" class="btn btn-outline-light">
                Add terms & condition
            </a>
        </div>
    @endif

    <h4 class="page-title"> <i class="dripicons-list"></i> Terms & Condition listing</h4>

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
                            @foreach ($termList as $key=>$term)
                                <tr>
                                    <td>                                    
                                        <!--Edit Icon-->
                                        <a href="{{ URL::to('admin/term/'. $term->id.'/edit') }}">
                                            <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>
                                        </a>
                                    </td>
                                    <td>{{$term->heading}}</td>
                                    <td>
                                        @switch($term->status)

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