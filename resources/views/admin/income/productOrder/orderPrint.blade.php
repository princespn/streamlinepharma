<html>
	<head>
		<meta charset='utf-8'>
		<meta http-equiv='x-ua-compatible' content='ie=edge'>
		<title>{{$account['title']}}</title>
		<link rel='shortcut icon' href="https://{{$account->domain.'/'.$account['logo']}}">
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<style>
		  .product_table thead tr,.product_table thead th{
			  background: #cacaca;
		  }
		  .product_table tr,.product_table th,.product_table td{
			  border:1px solid black;
		  }
		  .product_table{
			  width:100%;
		  }
		</style>
	</head> 
	<body style='background-color: #FFFFFF;padding: 0% 5%;' onload="window.print();">
		<table width='100%'>
			<tr>
				<td>
					<img src="https://{{$account->domain.'/'.$account['logo']}}" style='height: 120px;'>
				</td>
				<td style='text-align: right;'>
					<h2>{{$account['title']}}</h2>
					Email  : {{$account['email']}}
					<br>
					Mobile : {{$account['phone']}}
					<br>
					Address : {{$account['landmark']}}, {{$account['address']}}<br>
					<strong>PAN No : </strong>{{$account['kyc_pan']}}<br>
					<strong>GST Registration No : </strong>{{$account['kyc_gstin']}}<br>
				</td>
			</tr>

			<tr style='background: #FFFF;'>
				<td colspan='2' style='padding: 2% !important;'>
					
					@php
						$todayDate = date('Y-m-d');
						$grandTotal = 0;
					@endphp
					
                    <table width='100%'>

                        <thead>
                            <tr>
                                <th style="width:65%;text-align: left;">
                                    <span style="display:block">{{ $orderList->name }}</span>
                                    <span style="display:block">{{ $orderList->phone }}</span>
                                    <span style="display:block">{{ $orderList->email }}</span>
                                    <span style="display:block">
                                        {{ $orderList->landmark }},
                                        {{ $orderList->address }},
                                        {{ $orderList->zipCode }}
                                    </span>
                                </th>
								<th style="vertical-align: top;text-align: right;">
                                    <strong>Order Number : </strong>{{ $orderList->order_id }}<br>
									@if($orderList->transaction_id)
                                    <strong>Transaction Id : </strong>{{ $orderList->transaction_id }}<br>
								    @endif
                                    <strong>Order Date : </strong>{{ $orderList->created_at }}
                                    
                                </th>
                            </tr>
                        </thead>
                        
						<tbody>
						  <tr>
						   <td colspan='2'>
						   <table style='width:100%;border-collapse: collapse;' class='product_table'>
						     <thead>
							  <tr>
							    <th>S No</th>
							    <th>Description</th>
							    <th>Unit  Price</th>
							    <th>Quantity</th>
							    <th>Net Amount </th>
							    <th>Tax Rate</th>
							    <th>Tax Amount</th>
							    <th>Total amount</th>
							  <tr>
							 </thead>
							 <tbody>
							 
							   @foreach ( $orderList->products as $key=>$orderDetail)
							   <tr>
							     <td>{{ $key+1 }}</td> 
							     <td>{{ $orderDetail->title }}</td> 
							     <td>{{ $orderDetail->selling_price }}</td>
								 <td>{{ $orderDetail->qty }}</td>
								 <td>{{ $orderDetail->qty*$orderDetail->selling_price }}</td>
								 <td>18%</td>
								 <td>{{ $orderDetail->product_tax }} INC.</td>
								 <td>{{ $orderDetail->total }}</td>
							   </tr>
							   @endforeach
							 </tbody>
							 <tfoot>
							   @if($orderList->discount_coupon_amount>0)
								<tr>
									<th colspan='7'>Discount against coupon {{ $orderList->coupon }}</th>
									<th>
									Rs. {{ $orderList->discount_coupon_amount }}
									</th>
								</tr>
							@endif
							   <tr>
							     <th colspan='7'>Total</th>
							     <th>₹ {{ $orderList->grand_total }}</th>
							   </tr>
							   <tr>
							     <td colspan='8' style='text-align: right;'>
								  <br>
							      <strong>For {{$account['title']}}:</strong><br>
								  <img style='width:110px' src="{{ url('kyc/'.$account['kyc_authorized_signatory']) }}"><br>
								  <strong>Authorized Signatory</strong>
								 </td>
							   </tr>
							 </tfoot>
						   </table>
                            </td>
							</tr>
                        </tbody>

                        
						
                    </table>
					
				</td>
			</tr>

			<tr>
				<td colspan='2' style="text-align: center">
					<h4>
						© {{ now()->year }} <a href='{{$account['domain']}}' target='_blank'>{{$account['domain']}}</a>
					</h4>
				</td>
			</tr>

		</table>
	</body>
</html>