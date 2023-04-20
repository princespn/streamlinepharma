@extends('layouts.app')

@section('pageTitle')
<style>
    button { padding:5px;}
</style>

<div class="float-right">
  
    <a href="{{url('admin/view_fore_sale_x')}}" class="btn btn-outline-light">
        << Back
    </a>
   
    &emsp;
    <i class="dripicons-download pull-right" onclick="downloadfile()"></i>
</div>

<h4 class="page-title"> <i class="dripicons-calendar"></i>Sale X: <small style="color:#fff;">Assign Coupons</small></h4>

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
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>


                @php $json = json_decode($data->template_array,true); @endphp
                <table id="data" class="table table-bordered table-striped">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>Scheme Name</th>
                    <th>Set Number </th>

                    @foreach($json as $key=>$json_view)
                    <th>{{$otherdata->template($json_view['template'])}}  </th>
                    <th> Referral Benefits  </th>
                    <th> Referee Benefits  </th>
                    
                    
                    @endforeach
                    <th> Validity  </th>
                   
                   
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">1</th>
                    <td>{{$data->scheme_name}}</td>
                    <td>{{$data->number_of_set}}</td>
                  
                    @foreach($json as $key=>$json_view)
                        @php
                            $coupon=explode(',',$json_view['coupon_code'][$no]);
                            $cdata=$otherdata->findCuopan($coupon);
                        @endphp

                        <td>
                        @foreach($cdata as $k=> $coupon_data)
                        <input type="text" name="coupon[]" form="cuopan_set_shared_with" readonly value="{{$coupon_data->coupon}}" class="form-control" style="width:auto;" />
                      
                        @endforeach
                        </td>
                        
                        <td>{{$json_view['refferal_benifit']}}</td>
                        <td>{{$json_view['refree_benifit']}}</td>
                        
                      
                    @endforeach
                    <td>{{$data->validity_date}}</td>
                    </tr>
                 
                </tbody>
                </table>


                <!---------------Show User List----------------->
                <table class="table table-bordered table-striped">
               
                <thead>
                    <tr>
                    
                    {!! Form::open(['url' => url('admin/cuopan_set_shared_with'), 'id' => 'cuopan_set_shared_with']) !!}
                        <th>
                            <select class="form-control" name="userName" required > 
                                <option value="">Select Users</option>
                                @foreach($userList as $userList)
                                <?php //@if($otherdata->assignUser($userList->id) <= 0)  ?>
                                <option value="{{$userList->id}}">{{$userList->name}} {{$userList->phone}} {{$userList->email}}</option>
                                <?php //@endif ?>
                                @endforeach
                            </select>
                        </th>
                        <th>

                            <input type="hidden" name="set" value="{{$no+1}}"/>
                            <input type="hidden" name="sale_x_id" value="{{$sale_x_id}}"/>
                            <button class="btn btn-info">Send Coupon Set ....</button>
                          

                        </th>
                    {!! Form::close() !!}
                    </tr>
                  
                </thead>
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
