<?php $__env->startSection('pageTitle'); ?>
<style>
    button { padding:5px;}
    .mdi-eye { }
</style>

<div class="float-right">
  
    <a href="<?php echo e(url('admin/four_sale_x')); ?>" class="btn btn-outline-light">
        Add
    </a>
   
    &emsp;
    <i class="dripicons-download pull-right" onclick="downloadfile()"></i>
</div>


<h4 class="page-title"> <i class="dripicons-calendar"></i>Sale X</h4>

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
                    </div>
                </div>
                <?php echo Form::open(['url' => url('admin/view_fore_sale_x'), 'class' => '','method'=>'get']); ?>

              
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="scheme_name" placeholder="Search By Scheme Name" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit"><i class="dripicons-search"></i></button>
                        <a class="btn btn-outline-secondary" href="<?php echo e(url('admin/view_fore_sale_x')); ?>"><i class="dripicons-retweet"></i></a>
                    </div>
                  
                </div>
                <?php echo Form::close(); ?>

                <table id="" class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="2%">#</th>
                          
                            <th width="10%">Scheme Name</th>
                            
                            <th width="85%">Template / Number of Coupon  / Refferal Benifit /  Refree Benifit</th>
                         
                           
                            <th width="3%"><span style="writing-mode: vertical-rl;text-orientation: mixed;">No Set</span></th>
                          
                            <!-- <th>Status</th> -->
                        </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($key+1); ?></td>
               
                            <td style="border: 1px dashed #c0c0c0;"><big style="writing-mode: vertical-rl;text-orientation: mixed;"><?php echo e($view->scheme_name); ?> - <?php echo e($view->user_type); ?></big>
                            <small style="writing-mode: vertical-rl;text-orientation: mixed;"><?php echo e($view->validity_date); ?></small>
                            <small style="writing-mode: vertical-rl;text-orientation: mixed;">VALIDITY</samll>
                             
                            </td>
                            
                            <td> 
                                <table class='table table-bordered table-striped' id="data">
                                <thead>
                                <tr>
                                <th>Set</th>
								<?php
								$json = json_decode($view->template_array,true);
								?>
                                
                                <?php $__currentLoopData = $json; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$templateview): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th>
                                    <?php echo e($otherdata->template($templateview['template'])); ?> - <?php echo e($templateview['number_of_coupon']); ?>, Refferal Benifit - <?php echo e($templateview['refferal_benifit']); ?>, Refree Benifit - <?php echo e($templateview['refree_benifit']); ?>  
                                </th>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <th colspan="2"></th>
                              
                                </tr>  </thead>
                                <?php for($i=0;$i< $view->number_of_set ;$i++): ?>
                                <tr>
                                    <td>Set <?php echo e($i+1); ?></td>  
                                      <?php $__currentLoopData = $json; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$json_view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                      <?php
                                      $coupon=explode(',',$json_view['coupon_code'][$i]);
                                      $cdata=$otherdata->findCuopan($coupon);
                                      ?>
                                     
                                    <td>
                                        
                                    <?php $__currentLoopData = $cdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=> $coupon_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <button type="button" class="btn btn-outline-primary btn-sm" style="width:110px;">
                                    <?php if($otherdata->usettime($coupon_data->coupon) > 0): ?>
                                    <del><?php echo e($coupon_data->coupon); ?> </del>
                                    <?php else: ?>
                                    <?php echo e($coupon_data->coupon); ?>

                                    <?php endif; ?> 
                                    </button>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                                   
                                    
                                    <?php if($otherdata->couponsAssigned($coupon_data->coupon) > 0): ?>
                                    <td colspan="2">
                                    <a  class="btn btn-default btn-sm" onclick="UsedCoupon(<?php echo e($view->id); ?>,<?php echo e($i); ?>)"  title="<?php echo e($otherdata->couponUser($coupon_data->coupon)['name']); ?> <?php echo e($otherdata->couponUser($coupon_data->coupon)['email']); ?>">
                                        <?php echo e($otherdata->couponUser($coupon_data->coupon)['phone']); ?>

                                    </a>
                                    </td>
                                    <?php else: ?>
                                    <?php
                                    date_default_timezone_set("Asia/Kolkata");
                                    $date=date('Y/m/d');
                                    ?>
                                    <?php if($view->validity_date >= $data): ?>
                                    <td>
                                    <a href="<?php echo e(url('admin/testExcel/'.$view->id.'/'.$i)); ?>"><i class="dripicons-download pull-right"></i></a>
                                    </td> 
                                    <td>
                                    <a href="<?php echo e(url('admin/single_template/'.$view->id.'/'.$i)); ?>" title="Assign To Users"><i class="dripicons-export pull-right" style="color:green"></i></a>
                                    </td>
                                    <?php else: ?>
                                    <td colspan="2"><b class="text-danger"><i class="dripicons-warning"></i> Expired</b></td>
                                   
                                    <?php endif; ?> 
                                    <?php endif; ?>
                                   
                                                                        
                                </tr>  
                                <?php endfor; ?>
                                </tbody>
                                </table> 
                            </td>
                            <td><?php echo e($view->number_of_set); ?> </td>
                        </tr> 
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                        <?php if(count($data)=='0'): ?> <tr><td></td><td colspan="4"><center>No Record Found </center></td></tr>  <?php endif; ?>
                    </tbody>

                </table>
                
                <?php echo e($data->onEachSide(3)->links()); ?>

            </div>

        </div>
    </div>
</div>
<!---------------Model---------------->
<!-- Modal -->
<div class="modal fade" id="showCouponUsed" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Perched Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="table-container">
            
      </div>
    
    </div>
  </div>
</div>
<!--------------Model------------------>



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

function UsedCoupon(id,i){
    //alert(`This is the coupon ${id} ${i}`);
    $('#showCouponUsed').modal('show');
    $.ajax({
            url:"<?php echo e(URL::to('admin/UsedCoupon')); ?>/"+id+"/"+i,
            type:'GET',
            success:function(data){
                $("#table-container").html(data); 
               
            }
    });

}

</script>
<script>
function userCheckBox(){
	if($("#all_checkbox").prop("checked")==true){
		$(".all_user_checkbox").prop('checked', true);
	}else{
		$(".all_user_checkbox").prop('checked', false);
	}
}
$('#user_list').on('hidden.bs.modal', function () {
    $(".all_user_checkbox").prop('checked', false);
    $("#all_checkbox").prop('checked', false);
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/offers/foresalex/viewSaleX.blade.php ENDPATH**/ ?>