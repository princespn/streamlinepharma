<html>
	<head>
		<meta charset='utf-8'>
		<meta http-equiv='x-ua-compatible' content='ie=edge'>
		<title><?php echo e($data['account']->title); ?></title>
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
					Address : <?php echo e($data['account']['landmark']); ?>, <?php echo e($data['account']['address']); ?>

				</td>
			</tr>

			<tr style='background: #FFFF;'>
				<td colspan='2' style='padding: 2% !important;border-top: 10px solid grey;'>
					
					<?php
						$todayDate = date('Y-m-d');
						$grandTotal = 0;
					?>
					
                    <table width='100%'>

                        <thead>
                            <tr>
                                <th style="width:65%;text-align: left;">
                                    <span style="display:block"><?php echo e($data['orderData']['name']); ?></span>
                                    <span style="display:block"><?php echo e($data['orderData']['phone']); ?></span>
                                    <span style="display:block"><?php echo e($data['orderData']['email']); ?></span>
                                    <span style="display:block">
                                        <?php echo e($data['orderData']['landmark']); ?>,
                                        <?php echo e($data['orderData']['address']); ?>,
                                        <?php echo e($data['orderData']['zipCode']); ?>

                                    </span>
                                </th>
								<th style="vertical-align: top;text-align: right;">
                                    <span style="display:block"><?php echo e($data['orderData']['orderNo']); ?></span>
                                    <span style="display:block"><?php echo e($data['orderData']['transactionId']); ?></span>
                                    <span style="display:block"><?php echo e(date('d-m-Y h:m a', strtotime($todayDate))); ?></span>
                                </th>
                            </tr>
                        </thead>
                        
						<tbody>
                            <?php $__currentLoopData = $data['orderData']['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                

                                <tr>
                                    <td colspan="2">
                                        <table width='100%' style="padding: 10px;border-style: dashed;">
                                            <tr>
                                                <td colspan="3">
                                                    <h2><?php echo e($orderDetail['title']); ?></h2>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="vertical-align: top;">
                                                    <img src="<?php echo e($orderDetail['thumbnail']); ?>" style="height: 100px;">
                                                </td>
                                                <td style="vertical-align: top;">
                                                    <?php echo e($orderDetail['sku']); ?>

                                                </td>
                                                <td style="vertical-align: top;text-align: right;">
                                                    Price : Rs. <?php echo e(number_format($orderDetail['selling_price'],2)); ?><br>
                                                    Qty : <?php echo e(number_format($orderDetail['qty'],2)); ?><br>
                                                    
                                                    Tax : Rs. <?php echo e(number_format($orderDetail['product_tax'],2)); ?> INC<br>
                                                    Shipping : Rs. <?php echo e(number_format($orderDetail['shipping_charges'],2)); ?>

                                                    <h3>
                                                    Total: Rs. <?php echo e(number_format($orderDetail['total'],2)); ?>

                                                    </h3>
                                                </td>
                                            </tr>
                                        </table>

                                    </td>
                                </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="2" style="text-align: right;">
                                    <h1>Grand Total : Rs. <?php echo e(number_format($data['orderData']['grand_total'],2)); ?></h1>
                                </td>
                            </tr>
						</tfoot>
						
                    </table>
					
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
</html><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/emails/confirmOrder.blade.php ENDPATH**/ ?>