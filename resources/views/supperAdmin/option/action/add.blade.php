@extends('layouts.app')



@section('pageTitle')



    <div class="float-right">

        <a href="{{route('action.index')}}" class="btn btn-outline-light">

            Back

        </a>

    </div>

    <h4 class="page-title"> <i class="dripicons-user-group"></i> Create Action</h4>



@endsection



@section('contentData')



    <div class="row">

        <div class="col-12">

            <div class="card m-b-20">

                <div class="card-body">



                    {!! Form::open(['route' => 'action.store','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}

                    {{ csrf_field() }}

                

                        <div class="row">



                            <div class="col-sm-12 col-md-12 col-lg-12">

                                @if($errors->any())

                                    <div class="alert bg-danger text-white msgPopup" role="alert">

                                    {{$errors->first()}}

                                    </div>

                                @endif

                            </div>


                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-group">

                                    <label>Name</label>

                                    <input type="text" name="name" class="form-control" required/>

                                </div>

                            </div>

                            
                            <div class="col-sm-12 col-md-12 col-lg-12">


                                <input type="hidden" value="{{ csrf_token() }}" id="csrfToken">
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