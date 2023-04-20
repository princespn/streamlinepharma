<?php $__env->startSection('pageTitle'); ?>
    <?php if(Session::get('userType')==1): ?>
        <?php if(Session::get('user')->id == 1): ?>  
            <div class="float-right">
                <a href="<?php echo e(route('affiliateKeyword.create')); ?>" class="btn btn-outline-light">
                    Add affiliate keyword
                </a>
				 <a href="<?php echo e(route('reviewkey')); ?>" class="btn btn-outline-light">
                    Review affiliate keyword
                </a>
            </div>
        <?php endif; ?>
    <?php elseif(Session::get('userType')==3): ?>
        <?php
            $restrictionArray = Session::get('restrictions');
            $add = 0;
            $edit = 0;                                        
            $delete = 0;             
            foreach($restrictionArray as $key => $value)
            {
                $action_id = $value["action_id"];
                if($action_id == 2){
                    $add = 1;
                } 
                if($action_id == 3){
                    $edit = 1;
                }                                           
                if($action_id == 4){
                    $delete = 1;
                }                                           
            } 
        ?>
        <?php if($add == 1): ?>
            <div class="float-right">
                <a href="<?php echo e(route('affiliateKeyword.create')); ?>" class="btn btn-outline-light">
                    Add affiliate keyword
                </a>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <h4 class="page-title"> <i class="dripicons-checklist"></i> Affiliate Keyword listing</h4>
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
                                        <th>Keyword</th>
                                        <th>Status</th>
                                    <?php endif; ?>
                                <?php elseif(Session::get('userType')==3): ?>
                                    
                                    <?php if($edit == 1  || $delete == 1 ): ?>
                                        <th>#</th>
                                    <?php endif; ?>
                                    <th>Keyword</th>
                                    <th>Status</th>
                                <?php endif; ?>  
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(Session::get('userType')==1): ?>
                                <?php if(Session::get('user')->id == 1): ?>  
                                    <?php $__currentLoopData = $affiliateKeywordList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$affiliateKeyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>                                                
                                                <!--Delete Popup-->
                                                <i class="mdi mdi-delete btn btn-outline-danger" data-toggle="modal" data-target=".deletePopup<?php echo e($affiliateKeyword->id); ?>" title="Delete this data"></i>

                                                <div class="modal fade deletePopup<?php echo e($affiliateKeyword->id); ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title mt-0"><?php echo e($affiliateKeyword->keyword); ?></h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure want to delete this?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <?php echo e(Form::open(array('url' => 'admin/affiliateKeyword/' . $affiliateKeyword->id))); ?>

                                                                <?php echo e(Form::hidden('_method', 'DELETE')); ?>

                                                                    <button type="submit" class="btn btn-outline-danger">Yes</button>
                                                                <?php echo e(Form::close()); ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--Edit Icon-->
                                                <a href="<?php echo e(URL::to('admin/affiliateKeyword/'. $affiliateKeyword->id.'/edit')); ?>">
                                                    <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>
                                                </a>
                                            </td>
                                            <td><?php echo e($affiliateKeyword->keyword); ?></td>
                                            <td>
                                                <?php switch($affiliateKeyword->status):
                                                    case (1): ?>                                                        
                                                        <i class="mdi mdi-checkbox-blank-circle text-success"></i> Active
                                                    <?php break; ?>
                                                    <?php default: ?>                                                    
                                                        <i class="mdi mdi-checkbox-blank-circle text-warning"></i> Inactive
                                                <?php endswitch; ?>
                                            </td>
                                            
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            <?php elseif(Session::get('userType')==3): ?>                             
                                <?php $__currentLoopData = $affiliateKeywordList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$affiliateKeyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php if($edit == 1  || $delete == 1 ): ?>
                                            <td>
                                            
                                                <!--Delete Popup-->
                                                <?php if($delete == 1): ?>
                                                    <i class="mdi mdi-delete btn btn-outline-danger" data-toggle="modal" data-target=".deletePopup<?php echo e($affiliateKeyword->id); ?>" title="Delete this data"></i>

                                                    <div class="modal fade deletePopup<?php echo e($affiliateKeyword->id); ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title mt-0"><?php echo e($affiliateKeyword->keyword); ?></h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure want to delete this?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <?php echo e(Form::open(array('url' => 'admin/affiliateKeyword/' . $affiliateKeyword->id))); ?>

                                                                    <?php echo e(Form::hidden('_method', 'DELETE')); ?>

                                                                        <button type="submit" class="btn btn-outline-danger">Yes</button>
                                                                    <?php echo e(Form::close()); ?>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>

                                                <!--Edit Icon-->
                                                <?php if($edit == 1): ?>
                                                    <a href="<?php echo e(URL::to('admin/affiliateKeyword/'. $affiliateKeyword->id.'/edit')); ?>">
                                                        <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        <?php endif; ?>
                                        <td><?php echo e($affiliateKeyword->keyword); ?></td>
                                        <td>
                                            <?php switch($affiliateKeyword->status):

                                                case (1): ?>
                                                    
                                                    <i class="mdi mdi-checkbox-blank-circle text-success"></i> Active
                                                <?php break; ?>

                                                <?php default: ?>
                                                
                                                    <i class="mdi mdi-checkbox-blank-circle text-warning"></i> Inactive
                                            <?php endswitch; ?>
                                        </td>                                        
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/supperAdmin/affiliateKeyword/index.blade.php ENDPATH**/ ?>