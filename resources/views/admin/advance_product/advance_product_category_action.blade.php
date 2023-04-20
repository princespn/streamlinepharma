@extends('layouts.app')
@section('pageTitle')
<style>
.hide{
	display:none;
}
</style>
<h4 class="page-title"> <i class="dripicons-calendar"></i>Return , Replacement & Cancel Management</h4>
@endsection
@section('contentData')
<div class="row">
   <div class="col-12">
      <div class="card m-b-20">
         <div class="card-header">Return , Replacement & Cancel Management</div>
         <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success">
               {{ session('status') }}
            </div>
            @endif
            {!! Form::open(['url' => 'admin/advance_product_category_action']) !!}
            <div class="form-group">
               <label for="email">Return :</label>
               <select type="text" class="form-control" name="is_return" id="is_return" onchange="if(this.value=='Yes'){$('.return_div').removeClass('hide');}else{$('.return_div').addClass('hide');}">
                  <option @if($data->is_return=='No') selected  @endif>No</option>
                  <option @if($data->is_return=='Yes') selected  @endif>Yes</option>
               </select>
            </div>
            <div class="control-group return_div @if($data->is_return=='No') selected hide @endif">
               <label class="control-label">Return Days</label>
               <div class="controls">
                  <input type="number" class="form-control" name="return_days" id="return_days" value='{{ $data->return_days }}'>
               </div>
            </div>
            <div class="control-group">
               <label class="control-label">Return T&amp;C</label>
               <div class="controls">
                  <textarea class="form-control" name="return_terms" id="return_terms">{{ $data->return_terms }}</textarea>
               </div>
            </div>
            <div class="control-group">
               <label class="control-label">Replace</label>
               <div class="controls">
                  <select type="text" class="form-control" name="is_replace" id="is_replace" onchange="if(this.value=='Yes'){$('.replace_div').removeClass('hide');}else{$('.replace_div').addClass('hide');}">
                     <option @if($data->is_replace=='No') selected  @endif>No</option>
                     <option @if($data->is_replace=='Yes') selected  @endif>Yes</option>
                  </select>
               </div>
            </div>
            <div class="control-group replace_div @if($data->is_replace=='No') selected hide @endif   ">
               <label class="control-label">Replace Days</label>
               <div class="controls">
                  <input type="number" class="form-control" name="replace_days" id="replace_days" value='{{ $data->replace_days }}'>
               </div>
            </div>
            <div class="control-group">
               <label class="control-label">Replace T&amp;C</label>
               <div class="controls">
                  <textarea class="form-control" name="replace_terms" id="replace_terms">{{ $data->replace_terms }}</textarea>
               </div>
            </div>
			<div class="form-group">
               <label for="email">Cancel Reason :</label>
               <textarea name='cancel_reason' class='form-control' placeholder='comma seprated'>{{ $data->cancel_reason }}</textarea>
            </div>
            <div class="form-actions" style="text-align:center;margin-top:40px">
               <input type="hidden" class="id" name="id" value="{{ $data->cat_id }}">
               <input type="submit" class="btn btn-outline-success" value="Update">
            </div>
            {!! Form::close() !!}
         </div>
      </div>
   </div>
</div>
@endsection