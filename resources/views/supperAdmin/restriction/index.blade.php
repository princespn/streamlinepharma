@extends('layouts.app')



@section('pageTitle')

<div class="float-right">

    <a href="{{route('employee.create')}}" class="btn btn-outline-light">

        Create employee

    </a>

</div>

<h4 class="page-title"> <i class="dripicons-user-group"></i> Employee listing</h4>



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

                                <th>Name</th>

                                <th>Phone</th>

                                <th>Email</th>

                                <th>Address</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($employeeList as $key=>$employee)

                                <tr>

                                    <td> 
                                        <!--Edit Icon-->
                                        <a href="{{ URL::to('admin/employee/'. $employee->id.'/edit') }}">
                                            <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>
                                        </a>
                                         <!--Delete Popup-->

                                         <i class="mdi mdi-delete btn btn-outline-danger" data-toggle="modal" data-target=".deletePopup{{$employee->id}}" title="Delete this data"></i>

                                         <div class="modal fade deletePopup{{$employee->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

                                             <div class="modal-dialog modal-dialog-centered">

                                                 <div class="modal-content">

                                                     <div class="modal-header">

                                                         <h5 class="modal-title mt-0">{{$employee->name}}</h5>

                                                         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                                     </div>

                                                     <div class="modal-body">

                                                         <p>Are you sure want to delete this?</p>

                                                     </div>

                                                     <div class="modal-footer">

                                                         {{ Form::open(array('url' => 'admin/employee/' . $employee->id)) }}

                                                         {{ Form::hidden('_method', 'DELETE') }}

                                                             <button type="submit" class="btn btn-outline-danger">Yes</button>

                                                         {{ Form::close() }}

                                                     </div>

                                                 </div>

                                             </div>

                                         </div>   
                                    </td>
                                    <td>{{$key+1}}</td>
                                    <td>{{$employee->name}}</td>
                                    <td>{{$employee->phone}}</td>
                                    <td>{{$employee->email}}</td>

                                    <td>

                                        @switch($employee->status)



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