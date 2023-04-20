@extends('layouts.app')
@section('pageTitle')
<div class="float-right">
   <a href="{{url('admin/ProductPageBanner')}}" class="btn btn-outline-light">
   Back
   </a>
</div>
<h4 class="page-title"> <i class="dripicons-calendar"></i> Product Page Banner</h4>
@endsection
@section('contentData')
<div class="row">
   <div class="col-12">
      <div class="card m-b-20">

         <div class="card-body">
            @if(isset($edit))
            {!! Form::open(['url' => 'admin/ProductPageBanner/update/'.$edit->id,'method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
            @else
            {!! Form::open(['url' => 'admin/ProductPageBanner/SetProuctPageBanner','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
            @endif

            {{ csrf_field() }}
            <div class="row">
               <div class="col-sm-12 col-md-12 col-lg-12">
                  @if($errors->any())
                  <div class="alert bg-danger text-white msgPopup" role="alert">
                     {{$errors->first()}}
                  </div>
                  @endif

                
                  @if(session('status')) 
                  <div class="alert bg-success text-white msgPopup" role="alert">
                     {{session('status')}}
                  </div>
                  @endif
               </div>
               <div class="col-sm-6 col-md-4 col-lg-6">
                  <div class="form-group">
                     <label>Icon</label>
                     <input type="file" name="images" class="form-control" @if(!isset($edit))  required @endif/>
                     @if(isset($edit)) 
                     <img src="{{url('storage/productPageBanner/'.$edit->images)}}" style="height:60px;width:100px;"/>
                     <input type="hidden" value="{{$edit->images}}" name="icon"/>
                     @endif
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-6">
                  <div class="form-group">
                     <label>Test</label>
                     <textarea type="text" name="test" class="form-control" required/>@if(isset($edit)) {{$edit->test}} @endif</textarea>
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