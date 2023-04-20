@extends('layouts.app')



@section('pageTitle')



    @if (count($vendorKycList) == 0)

        <div class="float-right">

            <a href="{{route('vendorKyc.create')}}" class="btn btn-outline-light">

                Add vendor KYC

            </a>

        </div>

    @endif



    <h4 class="page-title"> <i class="dripicons-tags"></i> Vendor KYC listing</h4>



@endsection



@section('contentData')



    <div class="row">

        <div class="col-12">

            <div class="card m-b-20">

                <div class="card-body">

                    {!! Form::open(['url' =>  url('admin/update-kyc') ,'method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']) !!}

                {{ csrf_field() }}
				<div class="row">



                    <div class="col-sm-12 col-md-12 col-lg-12">

                        @if($errors->any())

                        <div class="alert bg-danger text-white msgPopup" role="alert">

                            {{$errors->first()}}

                        </div>

                        @endif

                    </div>



                    


                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>GSTIN</label>

                            <input type='text'   class="form-control" placeholder="" id="kyc_gstin" name="kyc_gstin"  required  @if(isset($data)) value="{{ $data->kyc_gstin }}" @endif >

                        </div>

                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>GST Certificate</label>

                            <input type="file" name="kyc_gstin_certificate" class="form-control"   />

                        </div>

                    </div>



                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>PAN</label>

                            <input type="text" name="kyc_pan" class="form-control" required  @if(isset($data)) value="{{ $data->kyc_pan }}" @endif   />

                        </div>

                    </div>

                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>PAN Certificate</label>

                            <input type="file" name="kyc_pan_certificate" class="form-control"   />

                        </div>

                    </div>

                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>Authorized Signatory</label>

                            <input type="file" name="kyc_authorized_signatory" class="form-control"   />

                        </div>

                    </div>



                    



                    
					



                    



                    <div class="col-sm-12 col-md-12 col-lg-12">

                        
                        <button type="submit" class="btn btn-outline-primary">

                            Update

                        </button>



                    </div>

                </div>



                {!! Form::close() !!}

                <table class='table table-bordered table-striped' style='margin-top:30px'>
				  <tbody>
				    <tr>
					  <td>GST Certificate</td>
					  <td>
					    @if($data->kyc_gstin_certificate)   
					     <a href="{{ url('kyc/'.$data->kyc_gstin_certificate) }}" target='_blank'>view</a>
					    @else
							NA
					    @endif
					  </td>
					</tr>
					<tr>
					  <td>Pan Certificate</td>
					  <td>
					    @if($data->kyc_pan_certificate)   
					     <a href="{{ url('kyc/'.$data->kyc_pan_certificate) }}" target='_blank'>view</a>
					    @else
							NA
					    @endif
					  </td>
					</tr>
					<tr>
					  <td>Authorized Signatory</td>
					  <td>
					    @if($data->kyc_authorized_signatory)   
					     <a href="{{ url('kyc/'.$data->kyc_authorized_signatory) }}" target='_blank'>view</a>
					    @else
							NA
					    @endif
					  </td>
					</tr>
				  </tbody>
				</table>

                </div>

            </div>

        </div>

    </div>



@endsection