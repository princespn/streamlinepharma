<?php $__env->startSection('pageTitle'); ?>



<?php if(Session::get('user')->id != 1): ?>

    <div class="float-right">

        <a href="<?php echo e(route('product.create')); ?>" class="btn btn-outline-light">

            Add product

        </a>

    </div>

<?php endif; ?>



    <h4 class="page-title"> <i class="dripicons-toggles"></i> Product listing</h4>



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
                                <th>Product Name</th>
                                <th>Inventory</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php $__currentLoopData = $productList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>

                                    <td>

                                        <?php if(Session::get('user')->id == 1): ?>

                                            <!--Edit Icon-->

                                            <a href="product/create?productId=<?php echo e($product->id); ?>">

                                                <i class="mdi mdi-eye btn btn-outline-primary" title="Edit this data"></i>

                                            </a>

                                        <?php else: ?>

                                            <!--Delete Popup-->

                                            <i class="mdi mdi-delete btn btn-outline-danger" data-toggle="modal" data-target=".deletePopup<?php echo e($product->id); ?>" title="Delete this data"></i>

                                            <div class="modal fade deletePopup<?php echo e($product->id); ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

                                                <div class="modal-dialog modal-dialog-centered">

                                                    <div class="modal-content">

                                                        <div class="modal-header">

                                                            <h5 class="modal-title mt-0"><?php echo e($product->name); ?></h5>

                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                                        </div>

                                                        <div class="modal-body">

                                                            <p>Are you sure want to delete this?</p>

                                                        </div>

                                                        <div class="modal-footer">

                                                            <?php echo e(Form::open(array('url' => 'admin/product/' . $product->id))); ?>


                                                            <?php echo e(Form::hidden('_method', 'DELETE')); ?>


                                                                <button type="submit" class="btn btn-outline-danger">Yes</button>

                                                            <?php echo e(Form::close()); ?>


                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                            <!--Edit Icon-->
                                            <a href="product/create?productId=<?php echo e($product->id); ?>">
                                                <i class="mdi mdi-pencil btn btn-outline-primary" title="Edit this data"></i>
                                            </a>
                                        <?php endif; ?>
                                    </td>

                                    <td><?php echo e($product->name); ?></td>
									<td>
									<a href="#" onclick='checkInventory(<?php echo e($product->id); ?>)' data-toggle="modal" data-target="#inventory_modal">

                                                <i class="mdi mdi-eye btn btn-outline-primary" title="Edit this data"></i>

                                            </a>
									</td>
                                    <td>
                                        <?php switch($product->status):
                                            case (1): ?>
                                                <i class="mdi mdi-checkbox-blank-circle text-success"></i> Active
                                            <?php break; ?>
                                            <?php default: ?>
                                                <i class="mdi mdi-checkbox-blank-circle text-warning"></i> Inactive
                                        <?php endswitch; ?>
                                    </td>
									
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>

    </div>
    <!-- The Modal -->
  <div class="modal" id="inventory_modal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Inventory</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
		<?php echo Form::open(['url' => 'admin/inventory_update', 'id' => 'inventory_form']); ?>

		
		<?php echo Form::close(); ?>

          <table class='table table-bordered table-striped'>
		     <thead>
			     <tr>
				    <th>SKU</th>
				    <th>Quantity</th>
				 </tr>
			 </thead>
			 <tbody id='inventory_tbody'>
			    
			 </tbody>
		  </table>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" form='inventory_form' class="btn btn-primary">Update</button>
          <button type="button"  class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  <!--------------------------------------------->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/product/product/index.blade.php ENDPATH**/ ?>