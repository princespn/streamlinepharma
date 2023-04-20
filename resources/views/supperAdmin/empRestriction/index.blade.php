@extends('layouts.app')



@section('pageTitle')

<div class="float-right">

    <a href="{{route('empRestriction.create')}}" class="btn btn-outline-light">

        Create employee restriction

    </a>

</div>

<h4 class="page-title"> <i class="dripicons-user-group"></i> Employee restriction listing</h4>

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

                                <th>Employee</th>
                               
                                <th>Page URL</th>

                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($empRestrictionList as $key=>$empRestriction)

                                <tr>
                                    <td> 
                                        <!--Edit Icon-->
                                        <a href="{{ URL::to('admin/empRestriction/'. $empRestriction->id.'/edit') }}">
                                            <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>
                                        </a>
                                         <!--Delete Popup-->

                                         <i class="mdi mdi-delete btn btn-outline-danger" data-toggle="modal" data-target=".deletePopup{{$empRestriction->id}}" title="Delete this data"></i>

                                         <div class="modal fade deletePopup{{$empRestriction->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

                                             <div class="modal-dialog modal-dialog-centered">

                                                 <div class="modal-content">

                                                     <div class="modal-header">

                                                         <h5 class="modal-title mt-0">{{$empRestriction->employee->name}}</h5>

                                                         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                                     </div>

                                                     <div class="modal-body">

                                                         <p>Are you sure want to delete this?</p>

                                                     </div>

                                                     <div class="modal-footer">

                                                         {{ Form::open(array('url' => 'admin/empRestriction/' . $empRestriction->id)) }}

                                                         {{ Form::hidden('_method', 'DELETE') }}

                                                             <button type="submit" class="btn btn-outline-danger">Yes</button>

                                                         {{ Form::close() }}

                                                     </div>

                                                 </div>

                                             </div>

                                         </div>   
                                    </td>
                                   
                                    <td>{{$empRestriction->employee->name ?? ''}}</td>
                                    <td>{{$empRestriction->page->url ?? ''}}</td>
                                    <td>{{$empRestriction->action->name ?? ''}}</td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>



                </div>

            </div>

        </div>

    </div>



@endsection