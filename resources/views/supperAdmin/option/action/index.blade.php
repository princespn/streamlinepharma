@extends('layouts.app')



@section('pageTitle')

<div class="float-right">

    <a href="{{route('action.create')}}" class="btn btn-outline-light">

        Create action

    </a>

</div>

<h4 class="page-title"> <i class="dripicons-user-group"></i> Action listing</h4>



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
                                {{-- <th>No</th> --}}
                                <th>Name</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($actionList as $key=>$action)

                                <tr>
                                    <td>  
                                         <!--Delete Popup-->

                                         {{-- <i class="mdi mdi-delete btn btn-outline-danger" data-toggle="modal" data-target=".deletePopup{{$action->id}}" title="Delete this data"></i>

                                         <div class="modal fade deletePopup{{$action->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

                                             <div class="modal-dialog modal-dialog-centered">

                                                 <div class="modal-content">

                                                     <div class="modal-header">

                                                         <h5 class="modal-title mt-0">{{$action->name}}</h5>

                                                         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                                     </div>

                                                     <div class="modal-body">

                                                         <p>Are you sure want to delete this?</p>

                                                     </div>

                                                     <div class="modal-footer">

                                                         {{ Form::open(array('url' => 'admin/action/' . $action->id)) }}

                                                         {{ Form::hidden('_method', 'DELETE') }}

                                                             <button type="submit" class="btn btn-outline-danger">Yes</button>

                                                         {{ Form::close() }}

                                                     </div>

                                                 </div>

                                             </div>

                                         </div>                                   --}}
                                        <!--Edit Icon-->
                                        <a href="{{ URL::to('admin/action/'. $action->id.'/edit') }}">
                                            <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>
                                        </a>
                                    </td>
                                    {{-- <td>{{$key+1}}</td> --}}
                                    <td>{{$action->name}}</td>
                                </tr>

                            @endforeach

                        </tbody>

                    </table>



                </div>

            </div>

        </div>

    </div>



@endsection