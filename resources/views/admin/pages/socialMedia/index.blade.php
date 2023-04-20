@extends('layouts.app')

@section('pageTitle')

    @if (count($socialMediaList) == 0)
        <div class="float-right">
            <a href="{{route('socialMedia.create')}}" class="btn btn-outline-light">
                Add social media
            </a>
        </div>
    @endif
    <h4 class="page-title"> <i class="dripicons-network-2"></i> Social Media listing</h4>

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
                                <th>Facebook</th>
                                <th>Twitter</th>
                                <th>Google Plus</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($socialMediaList as $key=>$socialMedia)
                                <tr>
                                    <td>
                                        <!--Edit Icon-->
                                        <a href="{{ URL::to('admin/socialMedia/' . $socialMedia->id . '/edit') }}">
                                            <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>
                                        </a>
                                    </td>
                                    <td>{{$socialMedia->facebook}}</td>
                                    <td>{{$socialMedia->twitter}}</td>
                                    <td>{{$socialMedia->googleplus}}</td>
                                    <td>
                                        @switch($socialMedia->status)

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