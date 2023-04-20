@extends('layouts.app')

@section('pageTitle')

   
        <div class="float-right">
            <a href="{{route('faq.create')}}" class="btn btn-outline-light">
                Add Special Page
            </a>
        </div>
    

    <h4 class="page-title"> <i class="dripicons-list"></i> Special Page listing</h4>

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
                                <th>Description</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
						@foreach($faqList as $key=>$row)
						  <tr>
						       <td><?= $key+1 ?></td>
						       <td>{{ $row->title }}</td>
						       <td><?= $row->description ?></td>
						       <td>
							     <a href="{{ url('admin/faq/create/'.$row->id) }}" class='btn btn-xs btn-primary'>Edit</a>
							     <a href='#' class='btn btn-xs btn-danger' onclick="return confirm('Are you sure to delete ?')">Delete</a>
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