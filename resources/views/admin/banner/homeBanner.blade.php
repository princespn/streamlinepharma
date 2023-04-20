@extends('layouts.app')
@section('pageTitle')
<div class="float-right">
   <a href="{{url('admin/banner')}}" class="btn btn-outline-light">
   Back
   </a>
</div>
<h4 class="page-title"> <i class="dripicons-calendar"></i> Add Home Page Lower Slide</h4>
@endsection
@section('contentData')
<div class="row">
   <div class="col-12">
      <div class="card m-b-20">
         <div class="card-body">
             @if(isset($edit))
             {!! Form::open(['url' => 'admin/update_banner/'.$edit->id,'method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
             @else
            {!! Form::open(['url' => 'admin/store_banner','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
             @endif
            {{ csrf_field() }}
            <div class="row">
               <div class="col-sm-12 col-md-12 col-lg-12">
                  @if($errors->any())
                  <div class="alert bg-danger text-white msgPopup" role="alert">
                     {{$errors->first()}}
                  </div>
                  @endif
               </div>
               <div class="col-sm-6 col-md-4 col-lg-6">
                  <div class="form-group">
                     <label>Image Banner</label>
                     <input type="file" name="home_banner" class="form-control"/>
                     @if(isset($edit)) 
                     <img src="{{url('storage/banner/'.$edit->lmage_banner)}}" style="height:60px;width:100px;"/>
                     <input type="hidden" value="{{$edit->lmage_banner}}" name="lmage_banner"/>
                     @endif
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-6">
                  <div class="form-group">
                     <label>Title</label>
                     <input type="text" name="title" class="form-control" value="@if(isset($edit)) {{$edit->title}} @endif" required/>
                  </div>
               </div>
               <div class="col-sm-6 col-md-4 col-lg-6">
                  <div class="form-group">
                     <label>Sub title Test</label>
                     <input type="text" name="button_test" value="@if(isset($edit)) {{$edit->button_test}} @endif" class="form-control" required/>
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