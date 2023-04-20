<html>
	<head>
		<meta charset='utf-8'>
		<meta http-equiv='x-ua-compatible' content='ie=edge'>
		<title>{{$data['account']['title']}}</title>
		<link rel='shortcut icon' href='{{$data['logo']}}'>
		<meta name='viewport' content='width=device-width, initial-scale=1'>
	</head>
	<body style='background-color: #e9ecef;padding: 0% 5%;'>
		<table width='100%'>
			<tr>
				<td>
					<img src="{{$data['logo']}}" style='height: 120px;'>
				</td>
				<td style='text-align: right;'>
					<h2>{{$data['account']['title']}}</h2>
					Email  : {{$data['account']['email']}}
					<br>
					Mobile : {{$data['account']['phone']}}
					<br>
					Address : {{$data['account']['landmark']}}, {{$data['account']['address']}}
				</td>
			</tr>

			<tr style='background: #FFFF;'>
				<td colspan='2' style='padding: 2% !important;border-top: 10px solid grey;'>
					
					@php
						$todayDate = date('Y-m-d');
						$grandTotal = 0;
					@endphp
					
                    <table width='100%'>

                        <thead>
                            <tr>
                                <th style="width:65%;text-align: left;">
                                    <span style="display:block">{{$data['orderData']['name']}}</span>
                                    <span style="display:block">{{$data['orderData']['phone']}}</span>
                                    <span style="display:block">{{$data['orderData']['email']}}</span>
                                    <span style="display:block">
                                        {{$data['orderData']['landmark']}},
                                        {{$data['orderData']['address']}},
                                        {{$data['orderData']['zipCode']}}
                                    </span>
                                </th>
								<th style="vertical-align: top;text-align: right;">
                                    <span style="display:block">{{$data['orderData']['orderNo']}}</span>
                                    <span style="display:block">{{$data['orderData']['transactionId']}}</span>
                                    <span style="display:block">{{ date('d-m-Y h:m a', strtotime($todayDate)) }}</span>
                                </th>
                            </tr>
                        </thead>
                        
						<tbody>
                            @foreach ($data['cartConfirm'] as $orderDetail)

                                @php 
                                    $totalAmt = 0; 
                                    $totalTax = 0;
                                    $totalShipping = 0;

                                    $totalAmt += ($orderDetail['qty']) * ($orderDetail['price']);
                                    $totalTax += ($orderDetail['qty']) * ($orderDetail['price'] * $orderDetail['tax'] /100);
                                    $totalShipping += ($orderDetail['qty']) * ($orderDetail['shipping']);

                                    $grandTotal += $totalTax + $totalAmt + $totalShipping;
                                @endphp

                                <tr>
                                    <td colspan="2">
                                        <table width='100%' style="padding: 10px;border-style: dashed;">
                                            <tr>
                                                <td colspan="3">
                                                    <h2>{{ $orderDetail['productName'] }}</h2>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="vertical-align: top;">
                                                    <img src="{{ $orderDetail['imageURL0']}}" style="height: 100px;">
                                                </td>
                                                <td style="vertical-align: top;">
                                                    {{$orderDetail['sku']}}<br>
                                                    {{$orderDetail['variation0']}}<br>
                                                    {{$orderDetail['variation1']}}<br>
                                                    {{$orderDetail['variation2']}}<br>
                                                    {{$orderDetail['variation3']}}<br>
                                                    {{$orderDetail['variation4']}}
                                                </td>
                                                <td style="vertical-align: top;text-align: right;">
                                                    Price : Rs. {{number_format($orderDetail['price'],2)}}<br>
                                                    Qty : {{number_format($orderDetail['qty'],2)}}<br>
                                                    Sub Total : Rs. {{number_format($totalAmt,2)}}<br>
                                                    Tax ({{$orderDetail['tax']}} %) : Rs. {{number_format($totalTax,2)}}<br>
                                                    Shipping : Rs. {{number_format($totalShipping,2)}}
                                                    <h3>
                                                    Total: Rs. {{number_format($totalAmt + $totalTax + $totalShipping,2)}}
                                                    </h3>
                                                </td>
                                            </tr>
                                        </table>

                                    </td>
                                </tr>

                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="2" style="text-align: right;">
                                    <h1>Grand Total : Rs. {{number_format($grandTotal,2)}}</h1>
                                </td>
                            </tr>
						</tfoot>
						
                    </table>
					
				</td>
			</tr>

			<tr>
				<td colspan='2' style="text-align: center">
					<h4>
						© {{ now()->year }} <a href='{{$data['account']['domain']}}' target='_blank'>{{$data['account']['domain']}}</a>
					</h4>
				</td>
			</tr>

		</table>
	</body>
</html>