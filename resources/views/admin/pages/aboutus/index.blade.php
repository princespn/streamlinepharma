@extends('layouts.app')

@section('pageTitle')

    @if (count($aboutList) == 0)
        <div class="float-right">
            <a href="{{route('about.create')}}" class="btn btn-outline-light">
                Add aboutus
            </a>
        </div>
    @endif

    <h4 class="page-title"> <i class="dripicons-list"></i> Aboutus listing</h4>

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
                                {{-- <th>Description</th> --}}
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($aboutList as $key=>$aboutus)
                                <tr>
                                    <td>                                    
                                        <!--Edit Icon-->
                                        <a href="{{ URL::to('admin/about/'. $aboutus->id.'/edit') }}">
                                            <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>
                                        </a>
                                    </td>
                                    <td>{{$aboutus->heading}}</td>
                                    {{-- <td>{!!html_entity_decode($aboutus->description) !!}</td> --}}
                                    <td>
                                        @switch($aboutus->status)

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