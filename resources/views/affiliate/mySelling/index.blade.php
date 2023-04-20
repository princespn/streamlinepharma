@extends('layouts.app')



@section('pageTitle')



    <h4 class="page-title"> <i class="dripicons-checklist"></i> My selling income</h4>



@endsection



@section('contentData')



    <div class="row">

        <div class="col-12">

            <div class="card m-b-20">

                <div class="card-body">

				@php
					$todayDate = date('Y-m-d');
				@endphp

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
							@foreach($data as $row)
							  <tr>
							    <td>{{ $row->created_at }}</td>
							    <td>{{ $row->order->account->domain }} - Order - {{ $row->reference_id }} <strong>{!! ($row->sub_reference_id ? '-'. $row->product->title : '') !!}</strong></td>
								<td>{{ $row->term }}</td>
							    <td>{{ $aff_amount_status[$row->status] }}</td>
							    <td>{{ $row->amount }}</td>
							    <td></td>
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