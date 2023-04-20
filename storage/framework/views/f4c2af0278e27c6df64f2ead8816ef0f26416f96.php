<?php $__env->startSection('pageTitle'); ?>


<h4 class="page-title"> <i class="dripicons-user-group"></i>Affiliation payment listing</h4>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
				
					<?php if($errors->any()): ?>

						<div class="alert bg-danger text-white">

						<?php echo e($errors->first()); ?>


						</div>

					<?php endif; ?>

					<?php
						$todayDate = date('Y-m-d');
					?>

                    <table id="datatable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Domain</th>
                                <th>Order No</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Selling Budget</th>
                                <th>Affiliate</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $mySellingList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$mySelling): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<td><?php echo e($key+1); ?></td>
									<td><?php echo e($mySelling->order->account->domain); ?></td>
									<td><?php echo e($mySelling->order->orderNo); ?></td>
									<td><?php echo e($mySelling->productName); ?></td>
									<td><?php echo e($mySelling->inventory_price->sprice); ?></td>
									<td><?php echo e($mySelling->inventory_price->sellingAffiliationCharge); ?></td>
									<td>
										<i class="mdi mdi-eye btn btn-outline-primary" data-toggle="modal" data-target=".affiliatePopup<?php echo e($mySelling->id); ?>" title="Affiliate Details"></i>
										<div class="modal fade affiliatePopup<?php echo e($mySelling->id); ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

											<div class="modal-dialog modal-dialog-centered">

												<div class="modal-content">

													<div class="modal-header">

														<h5 class="modal-title mt-0">
															<?php echo e($mySelling->order->account->domain); ?> : Order <?php echo e($mySelling->order->orderNo); ?>

														</h5>

														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

													</div>

													<div class="modal-body">
														<p>Email : <?php echo e($mySelling->affiliate->code); ?></p>
														<p>Name : <?php echo e($mySelling->affiliate->name); ?></p>
														<p>Phone : <?php echo e($mySelling->affiliate->phone); ?></p>
														<p>Email : <?php echo e($mySelling->affiliate->email); ?></p>
														<p>Address : <?php echo e($mySelling->affiliate->address); ?></p>
													</div>
												</div>

											</div>

										</div>
									</td>
									<td>
										<?php if($mySelling->affiliate_transaction_id!= NULL): ?>	

											Paid (<?php echo e($mySelling->affiliate_transaction_id); ?>)
										
										<?php else: ?>

											<?php if(($todayDate <=  date('Y-m-d', strtotime($mySelling->order->created_at->addDays($mySelling->inventoryPackaging->replacementOrderDays) ) ) ) ): ?>
										
												In replcament Period
												
											<?php else: ?> 

												<i class="mdi mdi-eye btn btn-outline-success" data-toggle="modal" data-target=".payPopup<?php echo e($mySelling->id); ?>" title="Pay this order"></i>

											<?php endif; ?>
											
										<?php endif; ?>
										
										<div class="modal fade payPopup<?php echo e($mySelling->id); ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

											<div class="modal-dialog modal-dialog-centered">

												<div class="modal-content">

													
													<?php echo Form::open(['route' => 'AffiliatePaymentSubmit.store','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']); ?>

													<?php echo e(csrf_field()); ?>

													
													
													<div class="modal-header">

														<h5 class="modal-title mt-0">
														<?php echo e($mySelling->order->account->domain); ?> : 
														Order <?php echo e($mySelling->order->orderNo); ?>

														</h5>

														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

													</div>

													<div class="modal-body">

														<div class="form-group">

															<label>Transaction Id</label>

															<input type="hidden" name="orderDetailId" class="form-control" value="<?php echo e($mySelling->id); ?>"/>
															
															<input type="text" name="transactionId" class="form-control" required/>

														</div>

													</div>
													
													<div class="modal-footer">
														<button type="submit" class="btn btn-outline-danger">Submit</button>
													</div>
													
													<?php echo e(Form::close()); ?>

												</div>

											</div>

										</div>
									</td>
								</tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/supperAdmin/affiliatePayment/index.blade.php ENDPATH**/ ?>