<?php $__env->startSection('pageTitle'); ?>



    <?php if(count($vendorKycList) == 0): ?>

        <div class="float-right">

            <a href="<?php echo e(route('vendorKyc.create')); ?>" class="btn btn-outline-light">

                Add vendor KYC

            </a>

        </div>

    <?php endif; ?>



    <h4 class="page-title"> <i class="dripicons-tags"></i> Vendor KYC listing</h4>



<?php $__env->stopSection(); ?>



<?php $__env->startSection('contentData'); ?>



    <div class="row">

        <div class="col-12">

            <div class="card m-b-20">

                <div class="card-body">

                    <?php echo Form::open(['url' =>  url('admin/update-kyc') ,'method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']); ?>


                <?php echo e(csrf_field()); ?>

				<div class="row">



                    <div class="col-sm-12 col-md-12 col-lg-12">

                        <?php if($errors->any()): ?>

                        <div class="alert bg-danger text-white msgPopup" role="alert">

                            <?php echo e($errors->first()); ?>


                        </div>

                        <?php endif; ?>

                    </div>



                    


                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>GSTIN</label>

                            <input type='text'   class="form-control" placeholder="" id="kyc_gstin" name="kyc_gstin"  required  <?php if(isset($data)): ?> value="<?php echo e($data->kyc_gstin); ?>" <?php endif; ?> >

                        </div>

                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>GST Certificate</label>

                            <input type="file" name="kyc_gstin_certificate" class="form-control"   />

                        </div>

                    </div>



                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>PAN</label>

                            <input type="text" name="kyc_pan" class="form-control" required  <?php if(isset($data)): ?> value="<?php echo e($data->kyc_pan); ?>" <?php endif; ?>   />

                        </div>

                    </div>

                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>PAN Certificate</label>

                            <input type="file" name="kyc_pan_certificate" class="form-control"   />

                        </div>

                    </div>

                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>Authorized Signatory</label>

                            <input type="file" name="kyc_authorized_signatory" class="form-control"   />

                        </div>

                    </div>



                    



                    
					



                    



                    <div class="col-sm-12 col-md-12 col-lg-12">

                        
                        <button type="submit" class="btn btn-outline-primary">

                            Update

                        </button>



                    </div>

                </div>



                <?php echo Form::close(); ?>


                <table class='table table-bordered table-striped' style='margin-top:30px'>
				  <tbody>
				    <tr>
					  <td>GST Certificate</td>
					  <td>
					    <?php if($data->kyc_gstin_certificate): ?>   
					     <a href="<?php echo e(url('kyc/'.$data->kyc_gstin_certificate)); ?>" target='_blank'>view</a>
					    <?php else: ?>
							NA
					    <?php endif; ?>
					  </td>
					</tr>
					<tr>
					  <td>Pan Certificate</td>
					  <td>
					    <?php if($data->kyc_pan_certificate): ?>   
					     <a href="<?php echo e(url('kyc/'.$data->kyc_pan_certificate)); ?>" target='_blank'>view</a>
					    <?php else: ?>
							NA
					    <?php endif; ?>
					  </td>
					</tr>
					<tr>
					  <td>Authorized Signatory</td>
					  <td>
					    <?php if($data->kyc_authorized_signatory): ?>   
					     <a href="<?php echo e(url('kyc/'.$data->kyc_authorized_signatory)); ?>" target='_blank'>view</a>
					    <?php else: ?>
							NA
					    <?php endif; ?>
					  </td>
					</tr>
				  </tbody>
				</table>

                </div>

            </div>

        </div>

    </div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/income/vendorKyc/index.blade.php ENDPATH**/ ?>