@extends('layouts.app')

@section('pageTitle')
<style>
    button { padding:5px;}
    .mdi-eye { }
</style>

<div class="float-right">
  
    <a href="{{url('admin/four_sale_x')}}" class="btn btn-outline-light">
        Add
    </a>
   
    &emsp;
    <i class="dripicons-download pull-right" onclick="downloadfile()"></i>
</div>


<h4 class="page-title"> <i class="dripicons-calendar"></i>Sale X</h4>

@endsection

@section('contentData')

<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        @if($errors->any())
                        <div class="alert bg-danger text-white msgPopup" role="alert">
                            {{$errors->first()}}
                        </div>
                        @endif
                    </div>
                </div>
                {!! Form::open(['url' => url('admin/view_fore_sale_x'), 'class' => '','method'=>'get']) !!}
              
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="scheme_name" placeholder="Search By Scheme Name" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit"><i class="dripicons-search"></i></button>
                        <a class="btn btn-outline-secondary" href="{{url('admin/view_fore_sale_x')}}"><i class="dripicons-retweet"></i></a>
                    </div>
                  
                </div>
                {!! Form::close() !!}
                <table id="" class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="2%">#</th>
                          
                            <th width="10%">Scheme Name</th>
                            
                            <th width="85%">Template / Number of Coupon  / Refferal Benifit /  Refree Benifit</th>
                         
                           
                            <th width="3%"><span style="writing-mode: vertical-rl;text-orientation: mixed;">No Set</span></th>
                          
                            <!-- <th>Status</th> -->
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $key=>$view)
                        <tr>
                            <td>{{ $key+1 }}</td>
               
                            <td style="border: 1px dashed #c0c0c0;"><big style="writing-mode: vertical-rl;text-orientation: mixed;">{{$view->scheme_name}} - {{$view->user_type}}</big>
                            <small style="writing-mode: vertical-rl;text-orientation: mixed;">{{$view->validity_date}}</small>
                            <small style="writing-mode: vertical-rl;text-orientation: mixed;">VALIDITY</samll>
                             
                            </td>
                            
                            <td> 
                                <table class='table table-bordered table-striped' id="data">
                                <thead>
                                <tr>
                                <th>Set</th>
								@php
								$json = json_decode($view->template_array,true);
								@endphp
                                
                                @foreach ($json as $key=>$templateview)
                                <th>
                                    {{$otherdata->template($templateview['template'])}} - {{ $templateview['number_of_coupon'] }}, Refferal Benifit - {{$templateview['refferal_benifit']}}, Refree Benifit - {{$templateview['refree_benifit']}}  
                                </th>
                                @endforeach
                                <th colspan="2"></th>
                              
                                </tr>  </thead>
                                @for($i=0;$i< $view->number_of_set ;$i++)
                                <tr>
                                    <td>Set {{ $i+1 }}</td>  
                                      @foreach ($json as $key=>$json_view) 
                                      @php
                                      $coupon=explode(',',$json_view['coupon_code'][$i]);
                                      $cdata=$otherdata->findCuopan($coupon);
                                      @endphp
                                     
                                    <td>
                                        
                                    @foreach($cdata as $k=> $coupon_data)
                                    <button type="button" class="btn btn-outline-primary btn-sm" style="width:110px;">
                                    @if($otherdata->usettime($coupon_data->coupon) > 0)
                                    <del>{{$coupon_data->coupon}} </del>
                                    @else
                                    {{$coupon_data->coupon}}
                                    @endif 
                                    </button>
                                      @endforeach
                                    </td>
                                      @endforeach   
                                   
                                    
                                    @if($otherdata->couponsAssigned($coupon_data->coupon) > 0)
                                    <td colspan="2">
                                    <a  class="btn btn-default btn-sm" onclick="UsedCoupon({{$view->id}},{{$i}})"  title="{{$otherdata->couponUser($coupon_data->coupon)['name']}} {{$otherdata->couponUser($coupon_data->coupon)['email']}}">
                                        {{$otherdata->couponUser($coupon_data->coupon)['phone']}}
                                    </a>
                                    </td>
                                    @else
                                    @php
                                    date_default_timezone_set("Asia/Kolkata");
                                    $date=date('Y/m/d');
                                    @endphp
                                    @if($view->validity_date >= $data)
                                    <td>
                                    <a href="{{url('admin/testExcel/'.$view->id.'/'.$i)}}"><i class="dripicons-download pull-right"></i></a>
                                    </td> 
                                    <td>
                                    <a href="{{url('admin/single_template/'.$view->id.'/'.$i)}}" title="Assign To Users"><i class="dripicons-export pull-right" style="color:green"></i></a>
                                    </td>
                                    @else
                                    <td colspan="2"><b class="text-danger"><i class="dripicons-warning"></i> Expired</b></td>
                                   
                                    @endif 
                                    @endif
                                   
                                                                        
                                </tr>  
                                @endfor
                                </tbody>
                                </table> 
                            </td>
                            <td>{{ $view->number_of_set }} </td>
                        </tr> 
                        @endforeach 
                        @if(count($data)=='0') <tr><td></td><td colspan="4"><center>No Record Found </center></td></tr>  @endif
                    </tbody>

                </table>
                
                {{ $data->onEachSide(3)->links() }}
            </div>

        </div>
    </div>
</div>
<!---------------Model---------------->
<!-- Modal -->
<div class="modal fade" id="showCouponUsed" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Perched Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="table-container">
            
      </div>
    
    </div>
  </div>
</div>
<!--------------Model------------------>



@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
<script>

function downloadfile(){

	let data=document.getElementById('data');
	var fp=XLSX.utils.table_to_book(data,{sheet:'sheet1'});
	XLSX.write(fp,{
		bookType:'xlsx',
		type:'base64'
	});
	XLSX.writeFile(fp, 'test.xlsx');
}

function UsedCoupon(id,i){
    //alert(`This is the coupon ${id} ${i}`);
    $('#showCouponUsed').modal('show');
    $.ajax({
            url:"{{ URL::to('admin/UsedCoupon') }}/"+id+"/"+i,
            type:'GET',
            success:function(data){
                $("#table-container").html(data); 
               
            }
    });

}

</script>
<script>
function userCheckBox(){
	if($("#all_checkbox").prop("checked")==true){
		$(".all_user_checkbox").prop('checked', true);
	}else{
		$(".all_user_checkbox").prop('checked', false);
	}
}
$('#user_list').on('hidden.bs.modal', function () {
    $(".all_user_checkbox").prop('checked', false);
    $("#all_checkbox").prop('checked', false);
});
</script>
@stop
