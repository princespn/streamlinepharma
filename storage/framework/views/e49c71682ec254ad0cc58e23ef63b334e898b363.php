  

<?php $__env->startSection('pageTitle'); ?>
    <?php if(Session::get('userType')==1): ?>
        <?php if(Session::get('user')->id == 1): ?>  
            <div class="float-right">            
                <a href="<?php echo e(route('account.create')); ?>" class="btn btn-outline-light">
                    Create account
                </a>            
            </div>
        <?php endif; ?>
    <?php elseif(Session::get('userType')==3): ?>
        <?php
            $restrictionArray = Session::get('restrictions');
            $add = 0;            
            foreach($restrictionArray as $key => $value)
            {
                $action_id = $value["action_id"];
                if($action_id == 2){
                    $add = 1;
                }                                            
            } 
        ?>
        <?php if($add == 1): ?>
            <div class="float-right">                        
                <a href="<?php echo e(route('account.create')); ?>" class="btn btn-outline-light">
                    Create account
                </a>
            </div>
        <?php endif; ?>
    <?php endif; ?>  

    <h4 class="page-title"> <i class="dripicons-user-group"></i> Account listing</h4>

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
                                        <th>Logo</th>
                                        <th>Title</th>
                                        <th>Domain</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                    <?php endif; ?>
                                <?php elseif(Session::get('userType')==3): ?>
                                    <?php
                                        $restrictionArray = Session::get('restrictions');
                                        $edit = 0;
                                        $delete = 0;
                                        $view = 0; 
                                        $viewLedger = 0;
                                        foreach($restrictionArray as $key => $value)
                                        {
                                            $action_id = $value["action_id"];
                                            
                                            if($action_id == 4){
                                                $delete = 1;
                                            } 
                                            if($action_id == 3){
                                                $edit = 1;
                                            }                                    
                                            if($action_id == 1){
                                                $view = 1;
                                            } 
                                            if($action_id == 10){
                                                $viewLedger = 1;
                                            }
                                        }          
                                    ?>
                                    <?php if($delete == 1 || $view == 1 || $edit == 1 || $viewLedger == 1 ): ?>
                                        <th>#</th>
                                    <?php endif; ?>                                                                          
                                    <th>No</th>
                                    <th>Logo</th>
                                    <th>Title</th>
                                    <th>Domain</th>
                                    <th>Phone</th>
                                    <th>Status</th> 
                                <?php endif; ?>                                                    
                            </tr>
                        </thead>

                        <tbody>
                            <?php if(Session::get('userType')==1): ?>
                                <?php if(Session::get('user')->id == 1): ?>  
                                    <?php $__currentLoopData = $accountList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <!--Delete Popup-->

                                                    <?php if($account->id != 1): ?>

                                                        <i class="mdi mdi-delete btn btn-outline-danger" data-toggle="modal" data-target=".deletePopup<?php echo e($account->id); ?>" title="Delete this data"></i>

                                                        <div class="modal fade deletePopup<?php echo e($account->id); ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

                                                            <div class="modal-dialog modal-dialog-centered">

                                                                <div class="modal-content">

                                                                    <div class="modal-header">

                                                                        <h5 class="modal-title mt-0"><?php echo e($account->title); ?></h5>

                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                                                    </div>

                                                                    <div class="modal-body">

                                                                        <p>Are you sure want to delete this?</p>

                                                                    </div>

                                                                    <div class="modal-footer">

                                                                        <?php echo e(Form::open(array('url' => 'admin/account/' . $account->id))); ?>


                                                                        <?php echo e(Form::hidden('_method', 'DELETE')); ?>


                                                                            <button type="submit" class="btn btn-outline-danger">Yes</button>

                                                                        <?php echo e(Form::close()); ?>


                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    <?php endif; ?>

                                                <!--Edit Icon-->
                                            
                                                    <!--a href="<?php echo e(URL::to('admin/account/' . $account->id . '/edit')); ?>">
                                                        <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>
                                                    </a-->

                                                <!--Detals Popup-->

                                                <i class="mdi mdi-account-card-details btn btn-outline-dark" data-toggle="modal" data-target=".detailsPopup<?php echo e($account->id); ?>" title="View more data"></i>

                                                <div class="modal fade detailsPopup<?php echo e($account->id); ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

                                                    <div class="modal-dialog modal-dialog-centered">

                                                        <div class="modal-content">

                                                            <div class="modal-header">

                                                                <h5 class="modal-title mt-0"><?php echo e($account->title); ?></h5>

                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                                            </div>

                                                            <div class="modal-body">

                                                                <table id="datatable" class="table table-bordered">

                                                                    <thead>
                                                                        <tr>
                                                                            <th>Email</th>
                                                                            <td><?php echo e($account->email); ?></td>
                                                                        </tr>
                                                                        <tr>

                                                                            <th>Domain Name</th>

                                                                            <td><?php echo e($account->domain); ?></td>

                                                                        </tr>

                                                                        <tr>

                                                                            <th>WhatsApp Number</th>

                                                                            <td><?php echo e($account->whatsApp); ?></td>

                                                                        </tr>

                                                                        <tr>

                                                                            <th>Address</th>

                                                                            <td><?php echo e($account->address); ?></td>

                                                                        </tr>

                                                                        <tr>

                                                                            <th>Default Currency</th>

                                                                            <td>

                                                                                <?php echo e(@$account->currency->title); ?>


                                                                            </td>

                                                                        </tr>

                                                                        <tr>

                                                                            <th>Website Type</th>

                                                                            <td>

                                                                                <?php switch($account->type):

                                                                                    case (1): ?>

                                                                                        E-Commerce

                                                                                        <?php break; ?>



                                                                                    <?php case (2): ?>

                                                                                        Hybrid

                                                                                        <?php break; ?>



                                                                                    <?php default: ?>

                                                                                        Inquiry

                                                                                <?php endswitch; ?>

                                                                            </td>

                                                                        </tr>

                                                                        <tr>

                                                                            <th>Theme Number</th>

                                                                            <td>

                                                                                <?php switch($account->theme):

                                                                                    case (1): ?>

                                                                                        Theme 1

                                                                                        <?php break; ?>



                                                                                    <?php case (2): ?>

                                                                                        Theme 2

                                                                                        <?php break; ?>



                                                                                    <?php default: ?>

                                                                                        Theme 3

                                                                                <?php endswitch; ?>    

                                                                            </td>

                                                                        </tr>

                                                                        <tr>

                                                                            <th>Theme Color</th>

                                                                            <td><?php echo e($account->color); ?></td>

                                                                        </tr> 

                                                                        <tr>

                                                                            <th>Charge in %</th>

                                                                            <td><?php echo e($account->charge); ?></td>

                                                                        </tr>

                                                                    </thead>

                                                                </table>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                                <?php if($account->id != 1): ?>
                                                    <a href="<?php echo e(url("admin/domainAffiliateLedger/".$account->id)); ?>">
                                                        <i class="mdi mdi-eye btn btn-outline-warning" title="View Ledger"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e($key+1); ?></td>
                                            <td><img src="<?php echo e(URL::asset($account->logo)); ?>" class="d-flex align-self-end" height="20"></td>
                                            <td onclick='newPopup("<?php echo e(url("admin/accountDetail/".$account->id)); ?>")' style='cursor:pointer'><?php echo e($account->title); ?></td>
                                            <td><?php echo e($account->domain); ?></td>
                                            <td><?php echo e($account->phone); ?></td>
                                            <td>
                                                <?php switch($account->status):



                                                    case (1): ?>

                                                        

                                                        <i class="mdi mdi-checkbox-blank-circle text-success"></i> Active
                                                        <a href="<?php echo e(url('admin/user_action/'.$account->id.'/0')); ?>" class='btn btn-danger btn-sm' onclick="return confirm('Are you sure want to Dactivate?')">Dactivate</a>
                                                    <?php break; ?>



                                                    <?php default: ?>

                                                    

                                                        <i class="mdi mdi-checkbox-blank-circle text-warning"></i> Inactive
                                                        <a href="<?php echo e(url('admin/user_action/'.$account->id.'/1')); ?>" class='btn btn-primary btn-sm' onclick="return confirm('Are you sure want to activate?')">Activate</a>
                                                <?php endswitch; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            <?php elseif(Session::get('userType')==3): ?>
                              
                                <?php $__currentLoopData = $accountList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php if($delete == 1 || $view == 1 || $edit == 1 || $viewLedger == 1 ): ?>
                                            <td>
                                                <!--Delete Popup-->
                                                <?php if($delete == 1): ?>
                                                    <?php if($account->id != 1): ?>

                                                            <i class="mdi mdi-delete btn btn-outline-danger" data-toggle="modal" data-target=".deletePopup<?php echo e($account->id); ?>" title="Delete this data"></i>



                                                            <div class="modal fade deletePopup<?php echo e($account->id); ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

                                                                <div class="modal-dialog modal-dialog-centered">

                                                                    <div class="modal-content">

                                                                        <div class="modal-header">

                                                                            <h5 class="modal-title mt-0"><?php echo e($account->title); ?></h5>

                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                                                        </div>

                                                                        <div class="modal-body">

                                                                            <p>Are you sure want to delete this?</p>

                                                                        </div>

                                                                        <div class="modal-footer">

                                                                            <?php echo e(Form::open(array('url' => 'admin/account/' . $account->id))); ?>


                                                                            <?php echo e(Form::hidden('_method', 'DELETE')); ?>


                                                                                <button type="submit" class="btn btn-outline-danger">Yes</button>

                                                                            <?php echo e(Form::close()); ?>


                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>


                                                        <?php endif; ?>
                                                    <?php endif; ?>

                                                <!--Edit Icon-->
                                                <?php if($edit == 1): ?>
                                                    <a href="<?php echo e(URL::to('admin/account/' . $account->id . '/edit')); ?>">

                                                        <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>

                                                    </a>
                                                <?php endif; ?>

                                                <!--Detals Popup-->
                                                <?php if($view == 1): ?>
                                                    <i class="mdi mdi-account-card-details btn btn-outline-dark" data-toggle="modal" data-target=".detailsPopup<?php echo e($account->id); ?>" title="View more data"></i>

                                                    <div class="modal fade detailsPopup<?php echo e($account->id); ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">

                                                            <div class="modal-content">

                                                                <div class="modal-header">

                                                                    <h5 class="modal-title mt-0"><?php echo e($account->title); ?></h5>

                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                                                </div>

                                                                <div class="modal-body">

                                                                    <table id="datatable" class="table table-bordered">

                                                                        <thead>
                                                                            <tr>
                                                                                <th>Email</th>
                                                                                <td><?php echo e($account->email); ?></td>
                                                                            </tr>
                                                                            <tr>

                                                                                <th>Domain Name</th>

                                                                                <td><?php echo e($account->domain); ?></td>

                                                                            </tr>

                                                                            <tr>

                                                                                <th>WhatsApp Number</th>

                                                                                <td><?php echo e($account->whatsApp); ?></td>

                                                                            </tr>

                                                                            <tr>

                                                                                <th>Address</th>

                                                                                <td><?php echo e($account->address); ?></td>

                                                                            </tr>

                                                                            <tr>

                                                                                <th>Default Currency</th>

                                                                                <td>

                                                                                    <?php echo e($account->currency->title); ?>


                                                                                </td>

                                                                            </tr>

                                                                            <tr>

                                                                                <th>Website Type</th>

                                                                                <td>

                                                                                    <?php switch($account->type):

                                                                                        case (1): ?>

                                                                                            E-Commerce

                                                                                            <?php break; ?>



                                                                                        <?php case (2): ?>

                                                                                            Hybrid

                                                                                            <?php break; ?>



                                                                                        <?php default: ?>

                                                                                            Inquiry

                                                                                    <?php endswitch; ?>

                                                                                </td>

                                                                            </tr>

                                                                            <tr>

                                                                                <th>Theme Number</th>

                                                                                <td>

                                                                                    <?php switch($account->theme):

                                                                                        case (1): ?>

                                                                                            Theme 1

                                                                                            <?php break; ?>



                                                                                        <?php case (2): ?>

                                                                                            Theme 2

                                                                                            <?php break; ?>



                                                                                        <?php default: ?>

                                                                                            Theme 3

                                                                                    <?php endswitch; ?>    

                                                                                </td>

                                                                            </tr>

                                                                            <tr>

                                                                                <th>Theme Color</th>

                                                                                <td><?php echo e($account->color); ?></td>

                                                                            </tr> 

                                                                            <tr>

                                                                                <th>Charge in %</th>

                                                                                <td><?php echo e($account->charge); ?></td>

                                                                            </tr>

                                                                        </thead>

                                                                    </table>

                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if($viewLedger == 1): ?>
                                                    <?php if($account->id != 1): ?>
                                                            <a href="<?php echo e(url("admin/domainAffiliateLedger/".$account->id)); ?>">
                                                                <i class="mdi mdi-eye btn btn-outline-warning" title="View Ledger"></i>
                                                            </a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                        <?php endif; ?>
                                        <td><?php echo e($key+1); ?></td>
                                        <td><img src="<?php echo e(URL::asset($account->logo)); ?>" class="d-flex align-self-end" height="20"></td>
                                        <td><?php echo e($account->title); ?></td>
                                        <td><?php echo e($account->domain); ?></td>
                                        <td><?php echo e($account->phone); ?></td>                                        
                                        <td>
                                            <?php switch($account->status):
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
    <script>
    function newPopup(url) {
      var myWindow = window.open(url+"?ph=true", "_top ", "width=880,height=600");
    }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/supperAdmin/account/index.blade.php ENDPATH**/ ?>