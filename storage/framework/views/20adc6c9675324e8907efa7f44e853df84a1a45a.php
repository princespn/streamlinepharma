<?php $__env->startSection('pageTitle'); ?>
    <?php if(Session::get('userType')==1): ?>
        <?php if(Session::get('user')->id == 1): ?>  
            <div class="float-right">            
                <a href="<?php echo e(route('affiliate.create')); ?>" class="btn btn-outline-light">
                    Add affiliate
                </a>            
            </div>
        <?php endif; ?>
    <?php elseif(Session::get('userType')==3): ?>
        <?php
            $restrictionArray = Session::get('restrictions');
            $add = 0;   
            $edit = 0;          
            foreach($restrictionArray as $key => $value)
            {
                $action_id = $value["action_id"];
                if($action_id == 2){
                    $add = 1;
                }  
                if($action_id == 3){
                    $edit = 1;
                }                                          
            } 
        ?>
        <?php if($add == 1): ?>
            <div class="float-right">                        
                <a href="<?php echo e(route('affiliate.create')); ?>" class="btn btn-outline-light">
                    Add affiliate
                </a>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <h4 class="page-title"> <i class="dripicons-user-group"></i> Affiliate listing</h4>

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
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Commission</th>
                                        <th>Status</th>
                                    <?php endif; ?>
                                <?php elseif(Session::get('userType')==3): ?>
                                   
                                    <?php if($edit == 1): ?>
                                        <th>#</th>
                                    <?php endif; ?>                                                                          
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Commission</th>
                                    <th>Status</th>
                                <?php endif; ?>           
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(Session::get('userType')==1): ?>
                                <?php if(Session::get('user')->id == 1): ?>  
                                    <?php $__currentLoopData = $affiliateList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$affiliate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>                                    
                                                <!--Edit Icon-->
                                                <a href="<?php echo e(URL::to('admin/affiliate/'. $affiliate->id.'/edit')); ?>">
                                                    <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>
                                                </a>
                                            </td>
                                            <td><?php echo e($affiliate->code); ?></td>
                                            <td><?php echo e($affiliate->name); ?></td>
                                            <td><?php echo e($affiliate->phone); ?></td>
                                            <td><?php echo e($affiliate->email); ?></td>
                                            <td><?php echo e($affiliate->address); ?></td>
                                            <td><?php echo e($affiliate->commission); ?></td>
                                            <td>
                                                <?php switch($affiliate->status):
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
                                <?php $__currentLoopData = $affiliateList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$affiliate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php if($edit == 1): ?>
                                            <td>                                    
                                                <!--Edit Icon-->
                                                <?php if($edit == 1): ?>
                                                    <a href="<?php echo e(URL::to('admin/affiliate/'. $affiliate->id.'/edit')); ?>">
                                                        <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </td> 
                                        <?php endif; ?>                                      
                                        <td><?php echo e($affiliate->code); ?></td>
                                        <td><?php echo e($affiliate->name); ?></td>
                                        <td><?php echo e($affiliate->phone); ?></td>
                                        <td><?php echo e($affiliate->email); ?></td>
                                        <td><?php echo e($affiliate->address); ?></td>
                                        <td><?php echo e($affiliate->commission); ?></td>
                                        <td>
                                            <?php switch($affiliate->status):
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/supperAdmin/affiliate/index.blade.php ENDPATH**/ ?>