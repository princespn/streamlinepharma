@extends('layouts.app')
@section('pageTitle')
<div class="float-right">
   <a href="{{url('admin/Productlistingpagebanner/show')}}" class="btn btn-outline-light">
   Product Page Banner show
   </a>
</div>
<h4 class="page-title"> <i class="dripicons-calendar"></i> Product listing Page banner Show</h4>
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
                     <th>Images</th>
                     <th>Title</th>
                     <th>Status</th>
                  </tr>
               </thead>
               <tbody>
                 @foreach($data as $k=>$value)
                  <tr>
                     <td>
                        <i class="mdi mdi-delete btn btn-outline-danger" data-toggle="modal" data-target=".deletePopup" title="Delete this data"></i>
                        <div class="modal fade deletePopup" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title mt-0"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                 </div>
                                 <div class="modal-body">
                                    <p>Are you sure want to delete this?</p>
                                 </div>
                                 <div class="modal-footer">
                                   
                                 {{ Form::open(array('url' => 'admin/ProductlistingpagebannerDelete/' . $value->id)) }}

                                {{ Form::hidden('_method', 'DELETE') }}

                                    <button type="submit" class="btn btn-outline-danger">Yes</button>

                                {{ Form::close() }}
                                
                                  
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!--Edit Icon-->
                        <a href="{{url('admin/Productlistingpagebanner/edit/'.$value->id)}}">
                        <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>
                        </a>
                     </td>
                    <td><img src="{{url('storage/Productlistingpagebanner/'.$value->images)}}" style="height:50px;width:80px"/></td>
                    <td>{{$value->test}}</td>
                  
                    <td>{{$value->status}}</td>
                   
                     
                  </tr>
                @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
@endsection