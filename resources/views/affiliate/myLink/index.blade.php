@extends('layouts.app')



@section('pageTitle')



    <h4 class="page-title"> <i class="dripicons-checklist"></i> My affiliation listing</h4>



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
                                <th>Domain</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Selling Budget</th>
                                <th>Link</th>
                                <th>QR</th>
                            </tr>

                        </thead>

                        <tbody>
                            @foreach ($myLinkList as $key=>$myLink)
                               <tr>
							     <td>{{ $key+1 }}</td>
							     <td>{{ $myLink->account->domain }}</td>
							     <td>{{ $myLink->title }}</td>
							     <td>{{ $myLink->selling_price }}</td>
							     <td>{{ $myLink->affiliation_price }}</td>
								 <td><a href="https://{{ $myLink->account->domain }}/product-detail/{{ $myLink->sku }}?aff={{ $code }}" rel="noopener noreferrer" target="_blank">
                                                            <i class="mdi mdi-eye btn btn-outline-primary" title="View Link"></i>
                                                        </a><br><br>
                                      <a href="{{ url('admin/download_qr_aff/'.$myLink->sku.'/'.$code) }}" rel="noopener noreferrer" target="_blank">
                                                            <i class="mdi mdi-download btn btn-outline-primary" title="View Link"></i>
                                                        </a>
                                </td>
                                 <td>
                                     {!! QrCode::size(150)->generate('https://'.$myLink->account->domain.'/product-detail/'.$myLink->sku.'?aff='.$code) !!}
                                </td>
							   </tr>
                            @endforeach
                        </tbody>

                    </table>



                </div>

            </div>

        </div>

    </div>



@endsection