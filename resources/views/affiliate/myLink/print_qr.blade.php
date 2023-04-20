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
		<table width='100%' style='text-align: center;'>
			<tr>
                <td>{{ $product->title }}</td>
            </tr>
            <tr>
                <td>
            {!! QrCode::size(150)->generate('https://'.$account['domain'].'/product-detail/'.$product->sku.'?aff='.$code) !!}
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