<?php $__env->startSection('pageTitle'); ?>
<div class="float-right">
   <a href="<?php echo e(url('admin/banner/home_banner')); ?>" class="btn btn-outline-light">
   Add Home Page Lower Slide
   </a>
</div>
<h4 class="page-title"> <i class="dripicons-calendar"></i> Home Page Lower Slide</h4>
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
                     <th>Sub Title</th>
                  </tr>
               </thead>
               <tbody>
                 <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                   
                                         
                                 <?php echo e(Form::open(array('url' => 'admin/delbanner/' . $value->id))); ?>


                                <?php echo e(Form::hidden('_method', 'DELETE')); ?>


                                    <button type="submit" class="btn btn-outline-danger">Yes</button>

                                <?php echo e(Form::close()); ?>

                                  
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!--Edit Icon-->
                        <a href="<?php echo e(url('admin/banner_edit/'.$value->id)); ?>">
                        <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>
                        </a>
                     </td>
                    <td><img src="<?php echo e(url('storage/banner/'.$value->lmage_banner)); ?>" style="height:50px;width:110px;"></td>
                    <td><?php echo e($value->title); ?></td>
                    <td><?php echo e($value->button_test); ?></td>
                     
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/banner/index.blade.php ENDPATH**/ ?>