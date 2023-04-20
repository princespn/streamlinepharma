@extends('layouts.app')
@section('pageTitle')
<div class="float-right">
   <a href="{{url('admin/offer/banner')}}" class="btn btn-outline-light">
   Back
   </a>
</div>
<h4 class="page-title"> <i class="dripicons-calendar"></i> Offer Banner</h4>
@endsection
@section('contentData')
<div class="row">
   <div class="col-12">
      <div class="card m-b-20">
         <div class="card-body">
            @if(isset($edit))
            {!! Form::open(['url' => 'admin/updateofferbanner/'.$edit->id,'method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
            @else
            {!! Form::open(['url' => 'admin/offerbanner','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}
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
                     <input type="file" name="offer_banner" class="form-control" required/>
                     @if(isset($edit)) 
                     <img src="{{url('storage/offerbanner/'.$edit->icon)}}" style="height:60px;width:100px;"/>
                     <input type="hidden" value="{{$edit->icon}}" name="icon"/>
                     @endif
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-6">
                  <div class="form-group">
                     <label>Test</label>
                     <input type="text" name="test" class="form-control" value="@if(isset($edit)) {{$edit->test}} @endif" required/>
                  </div>
               </div>
               <div class="col-sm-6 col-md-4 col-lg-6">
                  <div class="form-group">
                     <label>Sub Test</label>
                     <input type="text" name="sub_test" class="form-control" value="@if(isset($edit)) {{$edit->sub_test}} @endif" required/>
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