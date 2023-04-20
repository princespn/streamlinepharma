<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('page-content'); ?>
<?php $order_menu = 'my-schemes'; ?>
<main class="main pages">
   <div class="page-header breadcrumb-wrap">
      <div class="container">
         <div class="breadcrumb">
            <a href="<?php echo e(url('/')); ?>" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Pages <span></span> My Scheme
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
                              <h3 class="mb-0">My Scheme</h3>
                           </div>
                           <div class="card-body">
                              
							  
                              <table class="table table-bordered table-striped">
                                 <thead>
								            <tr>
                                       <th>#</th>
                                       <th>Scheme Name</th>
                                       <th>Coupon</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <tr>
                                       <td><?php echo e($key+1); ?></td>
                                       <td><?php echo e($row->scheme_name); ?></td>
                                       <td class='coupon_td'>
                                         <?php 
                                            $coupon       = json_decode($row->template_array,true)[0]; 
                                            $coupon_array = explode(',',$coupon['coupon_code'][($row->set_no-1)]);
                                            $cdata=$otherdata->findCuopan($coupon_array);
                                         ?>
                                         <div class='row'>
                                         <?php $__currentLoopData = $cdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=> $coupon_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <div class='col-md-4'>
                                                <div class="card coupon_card">
                                                   <div class='card-body'>
                                                   <?php if($otherdata->usettime($coupon_data->coupon) > 0): ?>
                                                         <del><?php echo e($coupon_data->coupon); ?> </del>
                                                   <?php else: ?>
                                                         <?php echo e($coupon_data->coupon); ?>

                                                   <?php endif; ?> 
                                                   </div>
                                                   
                                                </div>
                                             </div>
                                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
               </div>
            </div>
         </div>
      </div>
   </div>
</main>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-css'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.coupon_td span{
    border: 1px solid grey;
    margin-right: 5px;
    color: blue;
    padding: 8px 5px;
    cursor: pointer;
    border-radius: 5px;
}
.coupon_td span:hover{
   background:grey;
   border:1px solid blue;
}
.coupon_card{
   background: linear-gradient(90deg,#c471f5,#fa71cd);
   ox-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%), 0 6px 20px 0 rgb(0 0 0 / 19%);
    border-radius: 8px;
   color:#fff;
   text-align:center;
}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('FrontEndTheme.Nest.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/FrontEndTheme/Nest/account/my-schemes.blade.php ENDPATH**/ ?>