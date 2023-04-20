@extends('layouts.app')

@section('pageTitle')

    <div class="float-right">
        <a href="{{route('myKeyword.index')}}" class="btn btn-outline-light">
            Back
        </a>
    </div>
    <h4 class="page-title"> <i class="dripicons-checklist"></i> Add my keyword</h4>

@endsection

@section('contentData')

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">

                    {!! Form::open(['route' => 'myKeyword.store','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
                    {{ csrf_field() }}
                    
                        <div class="row">

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                @if($errors->any())
                                    <div class="alert bg-danger text-white msgPopup" role="alert">
                                    {{$errors->first()}}
                                    </div>
                                @endif
								@if (session('status'))
									<div class="alert alert-success">
										{{ session('status') }}
									</div>
								@endif
                            </div>

                            @foreach ($affiliateKeywordList as $key=>$affiliateKeyword)
                                <div class="col-sm-4 col-md-3 col-lg-2">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="keyword_id[]" value="{{$affiliateKeyword->id}}" id="affiliation{{$affiliateKeyword->id}}"
											@if(in_array($affiliateKeyword->id,$subscribed))
											checked
										    @endif
											>
                                            <label class="custom-control-label" for="affiliation{{$affiliateKeyword->id}}">{{$affiliateKeyword->name}}</label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

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