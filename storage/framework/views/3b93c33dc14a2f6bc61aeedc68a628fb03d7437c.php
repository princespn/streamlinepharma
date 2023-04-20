
<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('page-content'); ?>
<?php $order_menu = 'address'; ?>
<main class="main pages">
   <div class="page-header breadcrumb-wrap">
      <div class="container">
         <div class="breadcrumb">
            <a href="<?php echo e(url('/')); ?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Pages <span></span> Address
         </div>
      </div>
   </div>
   <div class="page-content pt-150 pb-150">
      <div class="container">
         <div class="row">
            <div class="col-lg-10 m-auto">
               <div class="row">
                  <div class="col-md-3">
                     <div class="dashboard-menu">
                        <?php echo $__env->make('FrontEndTheme.Nest.layout.dashboard_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
                     </div>
                  </div>
                  <div class="col-md-9">
                     <div class="account dashboard-content pl-50">
                           <div class="card">
                              <div class="card-header">
                                 <h3 class="mb-0">My Address</h3>
                              </div>
                              <div class="card-body">
							    <div class='row'>
                                 <?php $__currentLoopData = $address; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								   <div class='col-md-4'>
								    <div class="card">
									  <div class="card-body">
								      <strong><?php echo e($row->name); ?></strong><br>
								      <span>Mobile : <?php echo e($row->phone); ?></span><br>
								      <span>Email : <?php echo e($row->email); ?></span><br>
								      <span><?php echo e($row->address); ?>, <?php echo e($row->landmark); ?></span><br>
								      <span><?php echo e($row->cityId); ?>, <?php echo e($row->stateId); ?></span><br>
								      <span><?php echo e($row->countryId); ?>, <?php echo e($row->zipCode); ?></span><br>
								      </div>
									  <div class='card-footer address_footer'>
										    
										    <div class='row'>
											    <div class='col-6'>
												  <label class='btn btn-xs btn-sm btn-success' onclick="openAddressModal('edit','<?php echo e(md5($row->id)); ?>')">Edit</label>
												</div>
												<div class='col-6'>
												   <a href="<?php echo e(url('deleted_address/'.md5($row->id))); ?>" class='btn btn-xs btn-sm btn-primary' onclick="if(confirm('Are you sure?')){return true;}else{return false;}">Delete</a>
												</div>
											</div>
										 </div>
								    </div>
								   </div>
								 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
                              </div>
                           </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('FrontEndTheme.Nest.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/FrontEndTheme/Nest/account/address.blade.php ENDPATH**/ ?>