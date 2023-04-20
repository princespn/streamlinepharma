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

					<h1>Hello {{$data['input']['name']}},</h1>

					<span style='font-size:20px;'>
						Welcome to {{$data['account']['title']}} and thanks for signing up! You're one step closer to purchasing the finest products that we have to offer.
					</span>

					<br><br><br>
					
					<span style='font-size:20px;'>
						<a href='{{$data['account']['domain']}}' target='_blank' style='padding: 10px; color: #fff; text-decoration: none;background:black;'> 
							Cleck here to visit website
						</a>
					</span>

					<br><br>
					<span style='font-size:15px;'>
						Thank you.!
					</span>
					<br>
					
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