<?php $__env->startSection('pageTitle'); ?>

<?php if(Session::get('userType')==1): ?>
    <?php if(Session::get('user')->id == 1): ?>
        <div class="float-right">
            <a href="<?php echo e(route('affiliationCreditAmt.create')); ?>" class="btn btn-outline-light">
                Credit Domain Affiliation Amt.
            </a>
        </div>
    <?php endif; ?>
<?php elseif(Session::get('userType')==3): ?>
    <?php
        $restrictionArray = Session::get('restrictions');
        $creditDomianaffiliation = 0;
        $delete = 0;            
        foreach($restrictionArray as $key => $value)
        {
            $action_id = $value["action_id"];
            if($action_id == 8){
                $creditDomianaffiliation = 1;
            }
            
            if($action_id == 4){
                $delete = 1;
            }
        } 
    ?>
    <?php if($creditDomianaffiliation == 1): ?>
        <div class="float-right">
            <a href="<?php echo e(route('affiliationCreditAmt.create')); ?>" class="btn btn-outline-light">
                Credit Domain Affiliation Amt.
            </a>
        </div>
    <?php endif; ?>
<?php endif; ?>

<h4 class="page-title"> <i class="dripicons-user-group"></i> Domain Affiliation Amt listing</h4>

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
                                        <th>No</th>
                                        <th>Domain</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                    <?php endif; ?>
                                <?php elseif(Session::get('userType')==3): ?>
                                    <?php if($delete == 1 ): ?>
                                        <th>#</th>
                                    <?php endif; ?>
                                    <th>No</th>
                                    <th>Domain</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                <?php endif; ?>  
                            </tr>
                        </thead>

                        <tbody>
                            <?php if(Session::get('userType')==1): ?>
                                <?php $__currentLoopData = $affiliationAmtList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$affiliationAmt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php if(Session::get('user')->id == 1): ?>
                                            <td>
                                                <i class="mdi mdi-delete btn btn-outline-danger" data-toggle="modal" data-target=".deletePopup<?php echo e($affiliationAmt->id); ?>" title="Delete this data"></i>

                                                <div class="modal fade deletePopup<?php echo e($affiliationAmt->id); ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

                                                    <div class="modal-dialog modal-dialog-centered">

                                                        <div class="modal-content">

                                                            <div class="modal-header">

                                                                <h5 class="modal-title mt-0"><?php echo e($affiliationAmt->account->domain ?? ''); ?></h5>

                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                                            </div>

                                                            <div class="modal-body">

                                                                <p>Are you sure want to delete <?php echo e($affiliationAmt->amount); ?> this?</p>

                                                            </div>

                                                            <div class="modal-footer">

                                                                <?php echo e(Form::open(array('url' => 'admin/affiliationCreditAmt/' . $affiliationAmt->id))); ?>


                                                                <?php echo e(Form::hidden('_method', 'DELETE')); ?>


                                                                    <button type="submit" class="btn btn-outline-danger">Yes</button>

                                                                <?php echo e(Form::close()); ?>


                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </td>
                                        <?php endif; ?>

                                        <td><?php echo e($key+1); ?></td>
                                        <td><?php echo e($affiliationAmt->account->domain ?? ''); ?></td>
                                        <td><?php echo e($affiliationAmt->amount); ?></td>
                                        <td><?php echo e($affiliationAmt->created_at); ?></td>                                        
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php elseif(Session::get('userType')==3): ?>
                                <?php $__currentLoopData = $affiliationAmtList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$affiliationAmt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php if($delete == 1): ?>
                                            <td>
                                                <?php if($delete == 1): ?>
                                                    <i class="mdi mdi-delete btn btn-outline-danger" data-toggle="modal" data-target=".deletePopup<?php echo e($affiliationAmt->id); ?>" title="Delete this data"></i>

                                                    <div class="modal fade deletePopup<?php echo e($affiliationAmt->id); ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

                                                        <div class="modal-dialog modal-dialog-centered">

                                                            <div class="modal-content">

                                                                <div class="modal-header">

                                                                    <h5 class="modal-title mt-0"><?php echo e($affiliationAmt->account->domain ?? ''); ?></h5>

                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                                                </div>

                                                                <div class="modal-body">

                                                                    <p>Are you sure want to delete <?php echo e($affiliationAmt->amount); ?> this?</p>

                                                                </div>

                                                                <div class="modal-footer">

                                                                    <?php echo e(Form::open(array('url' => 'admin/affiliationCreditAmt/' . $affiliationAmt->id))); ?>


                                                                    <?php echo e(Form::hidden('_method', 'DELETE')); ?>


                                                                        <button type="submit" class="btn btn-outline-danger">Yes</button>

                                                                    <?php echo e(Form::close()); ?>


                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        <?php endif; ?>
                                        <td><?php echo e($key+1); ?></td>
                                        <td><?php echo e($affiliationAmt->account->domain ?? ''); ?></td>
                                        <td><?php echo e($affiliationAmt->amount); ?></td>
                                        <td><?php echo e($affiliationAmt->created_at); ?></td>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/supperAdmin/affiliationAmt/index.blade.php ENDPATH**/ ?>