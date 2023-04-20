<?php $__env->startSection('pageTitle'); ?>
    <h4 class="page-title"> <i class="dripicons-list"></i> Slider listing</h4>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Domain</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $sliderList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><img src="<?php echo e(URL::asset($slider->imageURL)); ?>" class="d-flex align-self-end" height="30" width="50"></td>
                                    <td><?php echo e($slider->account->domain); ?></td>
                                    <td>
                                        <a href="<?php echo e(url("admin/sliderApprovalConfirm/".$slider->id)); ?>">
                                            <i class="mdi mdi-pencil btn btn-outline-primary" title="Regect Slider"></i>
                                        </a>                                        
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>@extends('layouts.app')
<?php $__env->startSection('pageTitle'); ?>
    <h4 class="page-title"> <i class="dripicons-list"></i> Slider listing</h4>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered">
                        <thead>
                            <tr>
                                <?php if(Session::get('userType')==1): ?>
                                    <?php if(Session::get('user')->id == 1): ?>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Domain</th>
                                    <?php endif; ?>
                                <?php elseif(Session::get('userType')==3): ?>
                                    <?php
                                        $restrictionArray = Session::get('restrictions');
                                        $rejectSlider = 0; 
                                        foreach($restrictionArray as $key => $value)
                                        {
                                            $action_id = $value["action_id"];
                                            
                                            if($action_id == 7){
                                                $rejectSlider = 1;
                                            }                                    
                                        }                                      
                                    ?>
                                    <?php if($rejectSlider == 1): ?>
                                        <th>#</th>
                                    <?php endif; ?>
                                    <th>Image</th>
                                    <th>Domain</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(Session::get('userType')==1): ?>
                                <?php if(Session::get('user')->id == 1): ?>  
                                    <?php $__currentLoopData = $sliderList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <a href="<?php echo e(url("admin/sliderApprovalConfirm/".$slider->id)); ?>">
                                                    <i class="mdi mdi-pencil btn btn-outline-primary" title="Regect Slider"></i>
                                                </a>                              
                                            </td>
                                            <td><img src="<?php echo e(URL::asset($slider->imageURL)); ?>" class="d-flex align-self-end" height="30" width="50"></td>
                                            <td><?php echo e($slider->account->domain); ?></td>                                            
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>                                  
                            <?php elseif(Session::get('userType')==3): ?>
                                
                                <?php $__currentLoopData = $sliderList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php if($rejectSlider == 1): ?>
                                            <td>
                                                <?php if($rejectSlider == 1): ?>
                                                    <a href="<?php echo e(url("admin/sliderApprovalConfirm/".$slider->id)); ?>">
                                                        <i class="mdi mdi-pencil btn btn-outline-primary" title="Regect Slider"></i>
                                                    </a>
                                                <?php endif; ?>                         
                                            </td>
                                        <?php endif; ?>
                                        <td><img src="<?php echo e(URL::asset($slider->imageURL)); ?>" class="d-flex align-self-end" height="30" width="50"></td>
                                        <td><?php echo e($slider->account->domain); ?></td>                                        
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>           
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/supperAdmin/sliderApproval/index.blade.php ENDPATH**/ ?>