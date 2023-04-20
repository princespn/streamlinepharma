
<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('page-content'); ?>
<?php $order_menu = 'account'; ?>
<main class="main pages">
   <div class="page-header breadcrumb-wrap">
      <div class="container">
         <div class="breadcrumb">
            <a href="<?php echo e(url('/')); ?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Pages <span></span> My Account
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
                                 <h3 class="mb-0">My Account</h3>
                              </div>
                              <div class="card-body">
							    <div class='row'>
                                  <strong>Name : </strong><span><?php echo e(Session::get('register')->name); ?></span><br>
                                  <strong>Mobile : </strong><span><?php echo e(Session::get('register')->mobile); ?></span><br>
                                  <strong>Email : </strong><span><?php echo e(Session::get('register')->email); ?></span><br>
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
<?php echo $__env->make('FrontEndTheme.Nest.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/FrontEndTheme/Nest/account/account.blade.php ENDPATH**/ ?>