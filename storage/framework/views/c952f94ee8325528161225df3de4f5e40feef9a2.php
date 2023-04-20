<html>
	<head>
		<meta charset='utf-8'>
		<meta http-equiv='x-ua-compatible' content='ie=edge'>
		<title><?php echo e($account['title']); ?></title>
		<link rel='shortcut icon' href="https://<?php echo e($account->domain.'/'.$account['logo']); ?>">
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
					<img src="https://<?php echo e($account->domain.'/'.$account['logo']); ?>" style='height: 120px;'>
				</td>
				<td style='text-align: right;'>
					<h2><?php echo e($account['title']); ?></h2>
					Email  : <?php echo e($account['email']); ?>

					<br>
					Mobile : <?php echo e($account['phone']); ?>

					<br>
					Address : <?php echo e($account['landmark']); ?>, <?php echo e($account['address']); ?><br>
					<strong>PAN No : </strong><?php echo e($account['kyc_pan']); ?><br>
					<strong>GST Registration No : </strong><?php echo e($account['kyc_gstin']); ?><br>
				</td>
			</tr>

			<tr style='background: #FFFF;'>
				<td colspan='2' style='padding: 2% !important;'>
					
					<?php
						$todayDate = date('Y-m-d');
						$grandTotal = 0;
					?>
					
                    <table width='100%'>

                        <thead>
                            <tr>
                                <th style="width:65%;text-align: left;">
                                    <span style="display:block"><?php echo e($orderList->name); ?></span>
                                    <span style="display:block"><?php echo e($orderList->phone); ?></span>
                                    <span style="display:block"><?php echo e($orderList->email); ?></span>
                                    <span style="display:block">
                                        <?php echo e($orderList->landmark); ?>,
                                        <?php echo e($orderList->address); ?>,
                                        <?php echo e($orderList->zipCode); ?>

                                    </span>
                                </th>
								<th style="vertical-align: top;text-align: right;">
                                    <strong>Order Number : </strong><?php echo e($orderList->order_id); ?><br>
									<?php if($orderList->transaction_id): ?>
                                    <strong>Transaction Id : </strong><?php echo e($orderList->transaction_id); ?><br>
								    <?php endif; ?>
                                    <strong>Order Date : </strong><?php echo e($orderList->created_at); ?>

                                    
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
							 
							   <?php $__currentLoopData = $orderList->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$orderDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							   <tr>
							     <td><?php echo e($key+1); ?></td> 
							     <td><?php echo e($orderDetail->title); ?></td> 
							     <td><?php echo e($orderDetail->selling_price); ?></td>
								 <td><?php echo e($orderDetail->qty); ?></td>
								 <td><?php echo e($orderDetail->qty*$orderDetail->selling_price); ?></td>
								 <td>18%</td>
								 <td><?php echo e($orderDetail->product_tax); ?> INC.</td>
								 <td><?php echo e($orderDetail->total); ?></td>
							   </tr>
							   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							 </tbody>
							 <tfoot>
							   <?php if($orderList->discount_coupon_amount>0): ?>
								<tr>
									<th colspan='7'>Discount against coupon <?php echo e($orderList->coupon); ?></th>
									<th>
									Rs. <?php echo e($orderList->discount_coupon_amount); ?>

									</th>
								</tr>
							<?php endif; ?>
							   <tr>
							     <th colspan='7'>Total</th>
							     <th>₹ <?php echo e($orderList->grand_total); ?></th>
							   </tr>
							   <tr>
							     <td colspan='8' style='text-align: right;'>
								  <br>
							      <strong>For <?php echo e($account['title']); ?>:</strong><br>
								  <img style='width:110px' src="<?php echo e(url('kyc/'.$account['kyc_authorized_signatory'])); ?>"><br>
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
						© <?php echo e(now()->year); ?> <a href='<?php echo e($account['domain']); ?>' target='_blank'><?php echo e($account['domain']); ?></a>
					</h4>
				</td>
			</tr>

		</table>
	</body>
</html><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/income/productOrder/orderPrint.blade.php ENDPATH**/ ?>