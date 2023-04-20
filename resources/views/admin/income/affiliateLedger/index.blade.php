@extends('layouts.app')

@section('pageTitle')

    <h4 class="page-title"> <i class="dripicons-tags"></i> Affiliate Ledger</h4>

@endsection

@section('contentData')

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                
                    <table id="datatable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Term</th>
                                <th>Status</th>
                                <th>Credit</th>
                                <th>Debit</th>
                                <th>Balance</th>
                            </tr>
                        </thead>

                        
                        <tbody>
                          @foreach($rechargeList as $row)
						    <tr>
							  <td>{{ $row->created_at }}</td>
							  <td>
							    @if($row->type=='Order')
							      Payment to Affiliate <strong> {{ $row->affiliate->code }}</strong>  - Order - {{ $row->reference_id }} <strong>{!! ($row->sub_reference_id ? '-'. $row->product->title : '') !!}
							    @else
								 {{ $row->type }}
								@endif
							  </td>
                              <td>{{ $row->term }}</td>
							  <td>@if($row->type=='Order') {{ $aff_amount_status[$row->status] }} @endif</td>
							  <td>@if($row->type=='Wallet Reload') {{ $row->amount }}  @endif</td>
							  <td>@if($row->type=='Order') {{ $row->amount }}  @endif</td>
							  <td>{{ $row->remaining_amount }}</td>
							</tr>
						  @endforeach
						</tbody>

                    
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection