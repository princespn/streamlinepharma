<html>
	<head>
		<meta charset='utf-8'>
		<meta http-equiv='x-ua-compatible' content='ie=edge'>
		<title><?php echo e($data['account']['title']); ?></title>
		<link rel='shortcut icon' href='<?php echo e($data['logo']); ?>'>
		<meta name='viewport' content='width=device-width, initial-scale=1'>
	</head>
	<body style='background-color: #e9ecef;padding: 0% 5%;'>
		<table width='100%'>
			<tr>
				<td>
					<img src="<?php echo e($data['logo']); ?>" style='height: 120px;'>
				</td>
				<td style='text-align: right;'>
					<h2><?php echo e($data['account']['title']); ?></h2>
					Email  : <?php echo e($data['account']['email']); ?>

					<br>
					Mobile : <?php echo e($data['account']['phone']); ?>

					<br>				
				</td>
			</tr>

			<tr style='background: #FFFF;'>
				<td colspan='2' style='padding: 2% !important;border-top: 10px solid grey;'>

					<h1>Hello <?php echo e($data['register']['name']); ?>,</h1>

					<span style='font-size:20px;'>
						Welcome to <?php echo e($data['account']['title']); ?> and thanks for Login!
					</span>

					<br><br><br>
					
					<span style='font-size:20px;'>
						<a href='<?php echo e($data['account']['domain']); ?>' target='_blank' style='padding: 10px; color: #fff; text-decoration: none;background:black;'> 
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
						© <?php echo e(now()->year); ?> <a href='<?php echo e($data['account']['domain']); ?>' target='_blank'><?php echo e($data['account']['domain']); ?></a>
					</h4>
				</td>
			</tr>

		</table>
	</body>
</html><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/backup/resources/views/emails/login.blade.php ENDPATH**/ ?>