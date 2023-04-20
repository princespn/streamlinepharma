

<?php $__env->startSection('pageTitle'); ?>

<div class="float-right">
    <a href="<?php echo e(route('offers.index')); ?>" class="btn btn-outline-light">
        Back
    </a>
</div>

<h4 class="page-title"> <i class="dripicons-calendar"></i>Dynamic Name</h4>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>

<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">
                <?php echo Form::open(['url' => 'admin/page_detail','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']); ?>

                <?php echo e(csrf_field()); ?>

				<div class="col-sm-12 col-md-12 col-lg-12">
                        <?php if($errors->any()): ?>
                        <div class="alert bg-danger text-white msgPopup" role="alert">
                            <?php echo e($errors->first()); ?>

                        </div>
                        <?php endif; ?>
                    </div>
				<h2>Membership</h2><br>
				<div class="row">
					<div class="col-sm-6 col-md-6 col-lg-6">
							<div class="form-check-inline">
							  <label class="form-check-label">
								<input type="checkbox" class="form-check-input" value="1" <?php if($data->isMembership==1): ?> checked <?php endif; ?> name='isMembership'>Enable Membership for Frontend
							  </label>
							</div>
					</div>
				</div><br>
                <div class="row">
                    

                    
                    
                    
                    
					<div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label>Membership Background Image</label>
                            <input type="text" id='membership_background_image' name="membership_background_image" class="form-control"   value="<?php echo e($data->membership_background_image); ?>"   />
                        </div>
                    </div>
					<div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label>Membership Product Page Text</label>
                            <input type="text" id='membership_product_page_text' name="membership_product_page_text" class="form-control"   value="<?php echo e($data->membership_product_page_text); ?>"   />
                        </div>
                    </div>

                    
					<div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="form-group">
                            <label>Memebership Title</label>
                            <input type="text" id='memebership_title' name="memebership_title" class="form-control"   value="<?php echo e($data->memebership_title); ?>"   />
                        </div>
                    </div>
				</div>
				<hr>
				<h2>Purchase Offers</h2><br>
				<div class='row'>
				    
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="form-group">
                            <label>Page Title</label>
                            <input type="text" id='offer_page_title' name="offer_page_title" class="form-control" required  value="<?php echo e($data->offer_page_title); ?>"   />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
					
                        <button type="submit" class="btn btn-outline-primary">
                            Update
							</button>
                    </div>
                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/offers/purchase/page_detail.blade.php ENDPATH**/ ?>