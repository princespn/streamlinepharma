@extends('layouts.app')

@section('pageTitle')

    <div class="float-right">
        <a href="{{route('myKeyword.create')}}" class="btn btn-outline-light">
            Add my keyword
        </a>
    </div>

    <h4 class="page-title"> <i class="dripicons-checklist"></i> My Keyword listing</h4>

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
                                <th>Keyword</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($myKeywordList as $key=>$myKeyword)
                                <tr>
                                    <td>
                                        
                                       
                                      <a href='#' class='btn btn-danger btn-sm'>Delete</a>
                                        
                                    </td>
                                    <td>{{$myKeyword->name}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

@endsection