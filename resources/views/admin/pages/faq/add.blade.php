@extends('layouts.app')

@section('pageTitle')

    <div class="float-right">
        <a href="{{route('faq.index')}}" class="btn btn-outline-light">
            Back
        </a>
    </div>
    <h4 class="page-title"> <i class="dripicons-list"></i> Add Special Page</h4>

@endsection

@section('contentData')

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">

                    {!! Form::open(['route' => 'faq.store','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
                    {{ csrf_field() }} 
                
                        <div class="row">

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                @if($errors->any())
                                    <div class="alert bg-danger text-white msgPopup" role="alert">
                                    {{$errors->first()}}
                                    </div>
                                @endif
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Heading</label>
                                    <input type="text" name="title" class="form-control" required @if(isset($faqList)) value='{{ $faqList->title }}' @endif />
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="summernote" required>@if(isset($faqList)) {{ $faqList->description }} @endif</textarea>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                @if(isset($faqList))
									<input type='hidden' name='id' value='{{ $faqList->id }}'>
								@endif
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