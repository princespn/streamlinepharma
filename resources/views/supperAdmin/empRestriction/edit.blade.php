@extends('layouts.app')

@section('pageTitle')

    <div class="float-right">
        <a href="{{route('empRestriction.index')}}" class="btn btn-outline-light">
            Back
        </a>
    </div>
    <h4 class="page-title"> <i class="dripicons-list"></i> Edit employee restriction</h4>
    
@endsection

@section('contentData')

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    {{ Form::model($empRestriction, array('route' => array('empRestriction.update', $empRestriction->id), 'method' => 'PUT','enctype'=>'multipart/form-data')) }}
                    {{ csrf_field() }}
                
                        <div class="row">

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                @if($errors->any())
                                    <div class="alert bg-danger text-white msgPopup" role="alert">
                                    {{$errors->first()}}
                                    </div>
                                @endif
                            </div>

                            
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                                                
                                <div class="form-group">

                                    <label>Employee name</label>

                                    <select name="employee_id" class="form-control select2"  id="employee_id" value="{{$empRestriction->employee_id}}"  required>

                                        <option value="">Select Employee</option>

                                        @foreach($employeeList as $emp)
                                            <option value="{!! $emp->id !!}" {{$emp->id == $empRestriction->employee_id ? 'selected' : ''}}>{!! $emp->name !!}</option>
                                        @endforeach

                                    </select>

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-4">

                                <div class="form-group">

                                    <label>Page URL name</label>

                                    <select name="page_id" class="form-control select2" id="page_id" value="{{$empRestriction->page_id}}" required >

                                        <option value="">Select Page URL</option>

                                        @foreach($pageList as  $page)                                          
                                            <option value="{!! $page->id !!}" {{$page->id == $empRestriction->page_id ? 'selected' : ''}}>{!! $page->url !!}</option>
                                        @endforeach 

                                    </select>

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label>Action</label>
                                    <select name="action_id" class="form-control select2" id="action_id" value="{{$empRestriction->action_id}}" required >
                                        <option value="">Select Action</option>
                                        @foreach($actionList as  $action)                                          
                                            <option value="{!! $action->id !!}" {{$action->id == $empRestriction->action_id ? 'selected' : ''}}>{!! $action->name !!}</option>
                                        @endforeach  
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">

                                <button type="submit" class="btn btn-outline-primary">
                                    Submit
                                </button>

                            </div>
                        </div>

                    {!! Form::close() !!} 

                </div>
            </div>
        </div>
    </div>

@endsection