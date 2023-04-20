@extends('layouts.app')



@section('pageTitle')



    <div class="float-right">

        <a href="{{route('slider.create')}}" class="btn btn-outline-light">

            Add slider

        </a>

    </div>



    <h4 class="page-title"> <i class="dripicons-toggles"></i> Slider listing</h4>



@endsection



@section('contentData')



    <div class="row">

        <div class="col-12">

            <div class="card m-b-20">

                <div class="card-body">
                    <div class="alert alert-danger" role="alert">
                        <strong>Oh snap!</strong> A slider will be disabled if slider size and dimensions are not valid.
                    </div>

                    <table id="datatable" class="table table-bordered">

                        <thead>

                            <tr>

                                <th>#</th>

                                <th>Image</th>

                                <th>Title</th>

                                <th>Status</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($sliderList as $key=>$slider)

                                <tr>

                                    <td>

                                        

                                        <!--Delete Popup-->

                                        <i class="mdi mdi-delete btn btn-outline-danger" data-toggle="modal" data-target=".deletePopup{{$slider->id}}" title="Delete this data"></i>



                                        <div class="modal fade deletePopup{{$slider->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

                                            <div class="modal-dialog modal-dialog-centered">

                                                <div class="modal-content">

                                                    <div class="modal-header">

                                                        <h5 class="modal-title mt-0">{{$slider->title}}</h5>

                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                                    </div>

                                                    <div class="modal-body">

                                                        <p>Are you sure want to delete this?</p>

                                                    </div>

                                                    <div class="modal-footer">

                                                        {{ Form::open(array('url' => 'admin/slider/' . $slider->id)) }}

                                                        {{ Form::hidden('_method', 'DELETE') }}

                                                            <button type="submit" class="btn btn-outline-danger">Yes</button>

                                                        {{ Form::close() }}

                                                    </div>

                                                </div>

                                            </div>

                                        </div>



                                        <!--Edit Icon-->

                                        <a href="{{ URL::to('admin/slider/'. $slider->id.'/edit') }}">

                                            <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>

                                        </a>

                                    </td>

                                    <td><img src="{{URL::asset($slider->imageURL)}}" class="d-flex align-self-end" height="20"></td>

                                    <td>{{$slider->title}}</td>

                                    <td>

                                        @switch($slider->status)



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