<?php $__env->startSection('pageTitle'); ?>
<div class="float-right">
   <a href="<?php echo e(url('admin/subs/banner')); ?>" class="btn btn-outline-light">
   Back
   </a>
</div>

<h4 class="page-title"> <i class="dripicons-calendar"></i>  Banner</h4>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentData'); ?>
<div class="row">
   <div class="col-12">
      <div class="card m-b-20">
         <div class="card-body">
            <?php if(isset($edit)): ?>
            <?php echo Form::open(['url' => 'admin/updatesubsbanner/'.$edit->id,'method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']); ?>

            <?php else: ?>
            <?php echo Form::open(['url' => 'admin/subsbanner','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']); ?>

            <?php endif; ?>

            <?php echo e(csrf_field()); ?>

            <div class="row">
               <div class="col-sm-12 col-md-12 col-lg-12">
                  <?php if($errors->any()): ?>
                  <div class="alert bg-danger text-white msgPopup" role="alert">
                     <?php echo e($errors->first()); ?>

                  </div>
                  <?php endif; ?>

                
                  <?php if(session('status')): ?> 
                  <div class="alert bg-success text-white msgPopup" role="alert">
                     <?php echo e(session('status')); ?>

                  </div>
                  <?php endif; ?>
               </div>
               <div class="col-sm-6 col-md-4 col-lg-6">
                  <div class="form-group">
                     <label>Icon</label>
                     <input type="file" name="images" class="form-control"/>
                     <?php if(isset($edit)): ?> 
                     <img src="<?php echo e(url('storage/subscribebanner/'.$edit->images)); ?>" style="height:60px;width:100px;"/>
                     <input type="hidden" value="<?php echo e($edit->images); ?>" name="icon"/>
                     <?php endif; ?>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-6">
                  <div class="form-group">
                     <label>Test</label>
                     <textarea type="text" name="test" class="form-control"  required/><?php if(isset($edit)): ?> <?php echo e($edit->test); ?> <?php endif; ?></textarea>
                  </div>
               </div>
               <div class="col-sm-6 col-md-4 col-lg-6">
                  <div class="form-group">
                     <label>url</label>
                     <input type="url" name="url" class="form-control" value="<?php if(isset($edit)): ?> <?php echo e($edit->description); ?> <?php endif; ?>" required/>
                  </div>
               </div>
               <div class="col-sm-12 col-md-12 col-lg-12">
                  <button type="submit" class="btn btn-outline-primary">
                  Submit
                  </button>
               </div>
            </div>
            <?php echo Form::close(); ?>

         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/banner/subsBanner.blade.php ENDPATH**/ ?>