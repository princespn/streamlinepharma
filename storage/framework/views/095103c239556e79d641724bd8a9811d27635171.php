
<?php $__env->startSection('title', 'Wallet'); ?>
<?php $__env->startSection('page-content'); ?>
<?php $order_menu = 'wallet'; ?>
<main class="main pages">
   <div class="page-header breadcrumb-wrap">
      <div class="container">
         <div class="breadcrumb">
            <a href="<?php echo e(url('/')); ?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Pages <span></span> Wallet
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
                                 <h3 class="mb-0">Balance : <?php echo e($amount); ?> ₹</h3>
                              </div>
                              <div class="card-body">
                                 <table class='table table-bordered table-striped'>
						  <thead>
						      <tr>
							    <th style='text-align: center;background-color: #f2f2f2;' colspan='5'>Transaction History</th>
							  </tr>
							  <tr>
							    <th>Date</th>
							    <th>Transaction Id</th>
							    <th>Credit</th>
							    <th>Debit</th>
							    <th>Amount</th>
							  </tr>
						  </thead>
						  <tbody>
                              <?php $__currentLoopData = $wallet_amount; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$wallet_amount_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <tr>
                                  <td><?php echo e($wallet_amount_value->created_at); ?></td>
                                  <td>SDC<?php echo e((1000000+$wallet_amount_value->id)); ?></td>	
                                  <td><?php echo e($wallet_amount_value->credit); ?></td>
                                  <td><?php echo e($wallet_amount_value->debit); ?></td>
                                  <td><?php echo e($wallet_amount_value->amount); ?></td>
                              </tr>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php if(count($wallet_amount) =='0'): ?>
						      <tr>
							    <td colspan='5'>No History Found!</td>
							  </tr>
                              <?php endif; ?>
						  </tbody>
						</table> 
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
<?php echo $__env->make('FrontEndTheme.Nest.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/FrontEndTheme/Nest/account/wallet.blade.php ENDPATH**/ ?>