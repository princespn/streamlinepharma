@extends('layouts.app')

@section('pageTitle')

    <div class="float-right">
        <a href="{{route('vendorKyc.index')}}" class="btn btn-outline-light">
            Back
        </a>
    </div>
    <h4 class="page-title"> <i class="dripicons-tags"></i> Edit Vendor KYC</h4>
    
@endsection

@section('contentData')

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    {{ Form::model($vendorKyc, array('route' => array('vendorKyc.update', $vendorKyc->id), 'method' => 'PUT','enctype'=>'multipart/form-data')) }}
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
                                    <label>Co. Name</label>
                                    <input type="text" name="companyName" class="form-control" value="{{$vendorKyc->companyName}}" required/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Co.Type</label>
                                    <select name="companyType" class="form-control select2" required>
                                        <option value="1"  {{$vendorKyc->companyType == 1 ? 'selected' : ''}}>Limited Company</option>
                                        <option value="2"  {{$vendorKyc->companyType == 2 ? 'selected' : ''}}>Private Limited Company</option>
                                        <option value="3"  {{$vendorKyc->companyType == 3 ? 'selected' : ''}}>Partnership Firm</option>
                                        <option value="4"  {{$vendorKyc->companyType == 4 ? 'selected' : ''}}>Proprietorship</option>
                                        <option value="5"  {{$vendorKyc->companyType == 5 ? 'selected' : ''}}>LLP</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>KYC Address</label>
                                    <input type="text" name="kycAddress" class="form-control" value="{{$vendorKyc->kycAddress}}" required/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>KYC Address Proof Image URL</label>
                                    <input type="text" name="kycAddressProof" class="form-control" value="{{$vendorKyc->kycAddressProof}}" required/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>TAN No</label>
                                    <input type="text" name="tanNumber" class="form-control" value="{{$vendorKyc->tanNumber}}" required/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>TAN Image URL</label>
                                    <input type="text" name="tanImage" class="form-control" value="{{$vendorKyc->tanImage}}" required/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Account Holder Name</label>
                                    <input type="text" name="accountHolderName" class="form-control" value="{{$vendorKyc->accountHolderName}}" required/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Account Number</label>
                                    <input type="text" name="accountNumber" class="form-control" value="{{$vendorKyc->accountNumber}}" required/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>IFSC Code</label>
                                    <input type="text" name="ifscCode" class="form-control" value="{{$vendorKyc->ifscCode}}" required/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Bank Name</label>
                                    <input type="text" name="bankName" class="form-control" value="{{$vendorKyc->bankName}}" required/>
                                </div>
                            </div>

                             <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Bank Address</label>
                                    <input type="text" name="bankAddress" class="form-control" value="{{$vendorKyc->bankAddress}}" required/>
                                </div>
                            </div>

                             <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Bank Proof Name</label>
                                    <input type="text" name="bankProofName" class="form-control" value="{{$vendorKyc->bankProofName}}" required/>
                                </div>
                            </div>

                             <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Bank Proof Image URL</label>
                                    <input type="text" name="bankProofImage" class="form-control" value="{{$vendorKyc->bankProofImage}}" required/>
                                </div>
                            </div>

                             <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Blank Check</label>
                                    <input type="text" name="blankCheck" class="form-control" value="{{$vendorKyc->blankCheck}}" required/>
                                </div>
                            </div>

                             <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Blank Check Image URL</label>
                                    <input type="text" name="blankCheckImage" class="form-control" value="{{$vendorKyc->blankCheckImage}}" required/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Select Status</label>
                                    <select name="status" class="form-control select2" value="{{$vendorKyc->status}}" required>
                                        <option value="0" {{$vendorKyc->status == 0 ? 'selected' : ''}}>Inactive</option>
                                        <option value="1" {{$vendorKyc->status == 1 ? 'selected' : ''}}>Active</option>
                                    </select>
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