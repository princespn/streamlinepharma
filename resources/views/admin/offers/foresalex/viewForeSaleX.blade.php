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

                <table id="datatable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                          
                            <th>Scheme Name </th>
                            
                            <th>Template / Number of Coupon  / Refferal Benifit /  Refree Benifit</th>
                         
                           
                            <th>No Set</th>
                          
                            <!-- <th>Status</th> -->
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $key=>$view)
                        <tr>
                            <td>{{ $key+1 }}</td>
               
                            <td>{{$view->scheme_name}}</td>
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
                                </tr>  </thead>
                              @for($i=0;$i< $view->number_of_set ;$i++)
                              <tr>
                                    <td>Set {{ $i+1 }}</td>  
                                      @foreach ($json as $key=>$json_view) 
                                        <td>
                                        @php  
                                        $coupon = explode(',',$json_view['coupon_code']);
                                        $coupon_array = array_chunk($coupon,$json_view['number_of_coupon'])[$i];
                                        $coupon='';
                                        @endphp

                                        @foreach($coupon_array as $coup_name)
                                        <button type="button" class="btn btn-outline-primary btn-sm" style="width:85px;">
                                        
                                        @if($otherdata->coup_name($coup_name)->send_to !='') <del> @endif
                                        {{ $otherdata->coup_name($coup_name)->coupon }}
                                        @if($otherdata->coup_name($coup_name)->send_to !='') </del> @endif
                                        @php $coupon.=$otherdata->coup_name($coup_name)->coupon; $coupon.=','  @endphp
                                        </button>
                                       
                                        @endforeach 

                                        </td>

                                        @endforeach   
                                        <td>
                                        <a href="{{url('admin/exsal_coupons/'.$view->id.'/'.$coupon.'/'.$templateview['refferal_benifit'].'/'.$templateview['refree_benifit'])}}"><i class="dripicons-download pull-right"></i></a>
                                        </td>
                                                                          
                                </tr>  
                                @endfor
                              
                                
                                </tbody>
                                </table>
                               
                            </td>
                           
                            <td>{{ $view->number_of_set }}</td>
                           
                           
                        </tr>

                       
                        
                    @endforeach 
                        
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

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

</script>
@stop
