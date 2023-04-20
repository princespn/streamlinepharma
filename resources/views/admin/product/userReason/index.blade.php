@extends('layouts.app')

@section('pageTitle')

    <div class="float-right">
        <a href="{{route('userReason.create')}}" class="btn btn-outline-light">
            Add User Reasons
        </a>
    </div>

    <h4 class="page-title"> <i class="dripicons-toggles"></i> User Reason listing</h4>

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
                                <th>Type</th>
                                <th>Title</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userReasonList as $key=>$userReason)
                                <tr>
                                    <td>
                                        
                                        <!--Delete Popup-->
                                        <i class="mdi mdi-delete btn btn-outline-danger" data-toggle="modal" data-target=".deletePopup{{$userReason->id}}" title="Delete this data"></i>

                                        <div class="modal fade deletePopup{{$userReason->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title mt-0">{{$userReason->title}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure want to delete this?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        {{ Form::open(array('url' => 'admin/userReason/' . $userReason->id)) }}
                                                        {{ Form::hidden('_method', 'DELETE') }}
                                                            <button type="submit" class="btn btn-outline-danger">Yes</button>
                                                        {{ Form::close() }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--Edit Icon-->
                                        <a href="{{ URL::to('admin/userReason/'. $userReason->id.'/edit') }}">
                                            <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>
                                        </a>
                                    </td>
                                    <td>
                                        @switch($userReason->type)

                                            @case(1)
                                                
                                                <i class="mdi mdi-checkbox-blank-circle text-danger"></i> Cancel
                                            @break

                                            @case(2)
                                                
                                                <i class="mdi mdi-checkbox-blank-circle text-warning"></i> Return
                                            @break

                                            @default
                                            
                                                <i class="mdi mdi-checkbox-blank-circle text-success"></i> Replacement

                                        @endswitch
                                    </td>
                                    <td>{{$userReason->title}}</td>
                                    <td>
                                        @switch($userReason->status)

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