@extends('layouts.app')

@section('pageTitle')
<div class="float-right">
    <a href="{{route('category.create')}}" class="btn btn-outline-light">
        Add category
    </a>
</div>
<h4 class="page-title"> <i class="dripicons-wallet"></i> Category listing</h4>

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
                                <th>Website</th>
                                <th>Mobile</th>
                                <th>Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categoryList as $key=>$category)
                                <tr>
                                    <td>

                                        <i class="mdi mdi-delete btn btn-outline-danger" data-toggle="modal" data-target=".deletePopup{{$category->id}}" title="Delete this data"></i>

                                        <div class="modal fade deletePopup{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title mt-0">{{$category->name}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure want to delete this?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        {{ Form::open(array('url' => 'admin/category/' . $category->id)) }}
                                                        {{ Form::hidden('_method', 'DELETE') }}
                                                            <button type="submit" class="btn btn-outline-danger">Yes</button>
                                                        {{ Form::close() }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--Edit Icon-->
                                        <a href="{{ URL::to('admin/category/' . $category->id . '/edit') }}">
                                            <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>
                                        </a>
                                    </td>
                                    <td>{{$key+1}}</td>
                                    <td><img src="{{URL::asset($category->website_url_image)}}" class="d-flex align-self-end" height="20"></td>
                                    <td><img src="{{URL::asset($category->mobile_url_image)}}" class="d-flex align-self-end" height="20"></td>
                                    @if($category->parentCategory && $category->parentCategory->parentCategory)
                                        <td>{{ $category->parentCategory->parentCategory->name }} -> {{ $category->parentCategory->name }}  -> {{ $category->name }} </td>
                                    @elseif($category->parentCategory)
                                        <td>{{ $category->parentCategory->name  }} -> {{ $category->name  }}</td>
                                    @else
                                         <td>{{$category->name }}</td>
                                    @endif
                                    <td>
                                        @switch($category->status)

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