<?php $__env->startSection('pageTitle'); ?>
<div class="float-right">
   <a href="<?php echo e(url('admin/banner/offer_banner')); ?>" class="btn btn-outline-light">
   Add  offer Banner
   </a>
</div>
<h4 class="page-title"> <i class="dripicons-calendar"></i> Offer Banner Show</h4>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentData'); ?>
<div class="row">

   <div class="col-12">
      <div class="card m-b-20">
         <div class="card-body">
            <table id="datatable" class="table table-bordered">
               <thead>
                  <tr>
                     <th>#</th>
                     <th>Images</th>
                     <th>Title</th>
                     <th>Button Test</th>
                    
                   
                     <th>Status</th>
                  </tr>
               </thead>
               <tbody>
                 <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                     <td>
                        <i class="mdi mdi-delete btn btn-outline-danger" data-toggle="modal" data-target=".deletePopup" title="Delete this data"></i>
                        <div class="modal fade deletePopup" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title mt-0"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                 </div>
                                 <div class="modal-body">
                                    <p>Are you sure want to delete this?</p>
                                 </div>
                                 <div class="modal-footer">
                                   
                                 <?php echo e(Form::open(array('url' => 'admin/delofferbanner/' . $value->id))); ?>


                                <?php echo e(Form::hidden('_method', 'DELETE')); ?>


                                    <button type="submit" class="btn btn-outline-danger">Yes</button>

                                <?php echo e(Form::close()); ?>

                                  
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!--Edit Icon-->
                        <a href="<?php echo e(url('admin/offer_banner_edit/'.$value->id)); ?>">
                        <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>
                        </a>
                     </td>
                    <td><img src="<?php echo e(url('storage/offerbanner/'.$value->icon)); ?>" style="height:50px;width:50px"/></td>
                    <td><?php echo e($value->test); ?></td>
                    <td><?php echo e($value->sub_test); ?></td>
                    <td><?php echo e($value->status); ?></td>
                   
                     
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/banner/showOfferBanner.blade.php ENDPATH**/ ?>