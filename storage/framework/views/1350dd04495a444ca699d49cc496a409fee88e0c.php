<?php $__env->startSection('pageTitle'); ?>
<style>
    button { padding:5px;}
</style>

<div class="float-right">
  
    <a href="<?php echo e(url('admin/view_fore_sale_x')); ?>" class="btn btn-outline-light">
        << Back
    </a>
   
    &emsp;
    <i class="dripicons-download pull-right" onclick="downloadfile()"></i>
</div>

<h4 class="page-title"> <i class="dripicons-calendar"></i>Sale X: <small style="color:#fff;">Assign Coupons</small></h4>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>

<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <?php if($errors->any()): ?>
                        <div class="alert bg-danger text-white msgPopup" role="alert">
                            <?php echo e($errors->first()); ?>

                        </div>
                        <?php endif; ?>
                        <?php if(session('status')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session('status')); ?>

                            </div>
                        <?php endif; ?>
                        <?php if(session('error')): ?>
                            <div class="alert alert-danger">
                                <?php echo e(session('error')); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                </div>


                <?php $json = json_decode($data->template_array,true); ?>
                <table id="data" class="table table-bordered table-striped">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>Scheme Name</th>
                    <th>Set Number </th>

                    <?php $__currentLoopData = $json; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$json_view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <th><?php echo e($otherdata->template($json_view['template'])); ?>  </th>
                    <th> Referral Benefits  </th>
                    <th> Referee Benefits  </th>
                    
                    
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <th> Validity  </th>
                   
                   
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">1</th>
                    <td><?php echo e($data->scheme_name); ?></td>
                    <td><?php echo e($data->number_of_set); ?></td>
                  
                    <?php $__currentLoopData = $json; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$json_view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $coupon=explode(',',$json_view['coupon_code'][$no]);
                            $cdata=$otherdata->findCuopan($coupon);
                        ?>

                        <td>
                        <?php $__currentLoopData = $cdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=> $coupon_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <input type="text" name="coupon[]" form="cuopan_set_shared_with" readonly value="<?php echo e($coupon_data->coupon); ?>" class="form-control" style="width:auto;" />
                      
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                        
                        <td><?php echo e($json_view['refferal_benifit']); ?></td>
                        <td><?php echo e($json_view['refree_benifit']); ?></td>
                        
                      
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <td><?php echo e($data->validity_date); ?></td>
                    </tr>
                 
                </tbody>
                </table>


                <!---------------Show User List----------------->
                <table class="table table-bordered table-striped">
               
                <thead>
                    <tr>
                    
                    <?php echo Form::open(['url' => url('admin/cuopan_set_shared_with'), 'id' => 'cuopan_set_shared_with']); ?>

                        <th>
                            <select class="form-control" name="userName" required > 
                                <option value="">Select Users</option>
                                <?php $__currentLoopData = $userList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php //@if($otherdata->assignUser($userList->id) <= 0)  ?>
                                <option value="<?php echo e($userList->id); ?>"><?php echo e($userList->name); ?> <?php echo e($userList->phone); ?> <?php echo e($userList->email); ?></option>
                                <?php //@endif ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </th>
                        <th>

                            <input type="hidden" name="set" value="<?php echo e($no+1); ?>"/>
                            <input type="hidden" name="sale_x_id" value="<?php echo e($sale_x_id); ?>"/>
                            <button class="btn btn-info">Send Coupon Set ....</button>
                          

                        </th>
                    <?php echo Form::close(); ?>

                    </tr>
                  
                </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
<script>
function downloadfile(){
	let data=document.getElementById('data');
	var fp=XLSX.utils.table_to_book(data,{sheet:'sheet1'});
	XLSX.write(fp,{
		bookType:'xlsx',
		type:'base64'
	});
	XLSX.writeFile(fp, 'test.xlsx');
}

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/offers/foresalex/single_template.blade.php ENDPATH**/ ?>