



<?php $__env->startSection('pageTitle'); ?>





<h4 class="page-title"> <i class="dripicons-calendar"></i>  Product Discount Offer</h4>



<?php $__env->stopSection(); ?>



<?php $__env->startSection('contentData'); ?>



<div class="row">

    <div class="col-12">

        <div class="card m-b-20">

            <div class="card-body">



                <?php echo Form::open(['url' =>  url('admin/product-discount-offer') ,'method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']); ?>


                <?php echo e(csrf_field()); ?>




                <div class="row">



                    <div class="col-sm-12 col-md-12 col-lg-12">

                        <?php if($errors->any()): ?>

                        <div class="alert bg-danger text-white msgPopup" role="alert">

                            <?php echo e($errors->first()); ?>


                        </div>

                        <?php endif; ?>

                    </div>



                    


                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>SKU</label>

                            <input type='text' readonly  class="form-control" placeholder="Offering Product" id="offering_product" name="sku" data-toggle="modal" data-target="#offeringProductModal" required <?php if(isset($pre_data)): ?> value='<?php echo e($pre_data->sku); ?>' <?php endif; ?> >

                        </div>

                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>Coupon Code</label>

                            <input type="text" name="coupon_code" class="form-control" required <?php if(isset($pre_data)): ?> value='<?php echo e($pre_data->coupon_code); ?>' <?php endif; ?> />

                        </div>

                    </div>



                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>Start Date</label>

                            <input type="datetime-local" name="start_date" class="form-control" required <?php if(isset($pre_data)): ?> value='<?php echo e($pre_data->start_date); ?>' <?php endif; ?> />

                        </div>

                    </div>



                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>End Date</label>

                            <input type="datetime-local" name="end_date" class="form-control" required <?php if(isset($pre_data)): ?> value='<?php echo e($pre_data->end_date); ?>' <?php endif; ?> />

                        </div>

                    </div>



                    



                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>Discount (%)</label>

                            <input type="number" name="discount" class="form-control" min="1" required <?php if(isset($pre_data)): ?> value='<?php echo e($pre_data->discount); ?>' <?php endif; ?> />

                        </div>

                    </div>

                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>Maximum Discount</label>

                            <input type="number" name="maximum_discount" class="form-control" min="1" required <?php if(isset($pre_data)): ?> value='<?php echo e($pre_data->maximum_discount); ?>' <?php endif; ?> />

                        </div>

                    </div>

                    <div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>No Of Users</label>

                            <input type="number" name="no_of_users" class="form-control" min="5" required <?php if(isset($pre_data)): ?> value='<?php echo e($pre_data->no_of_users); ?>' <?php endif; ?> />

                        </div>

                    </div>
					<div class="col-sm-6 col-md-4 col-lg-3">

                        <div class="form-group">

                            <label>Per User </label>

                            <input type="number" name="per_user" class="form-control" min="1" required <?php if(isset($pre_data)): ?> value='<?php echo e($pre_data->per_user); ?>' <?php endif; ?> />

                        </div>

                    </div>



                    



                    <div class="col-sm-12 col-md-12 col-lg-12">

                        <?php if(isset($pre_data)): ?>
							 <input type='hidden' name='id' value='<?php echo e($pre_data->id); ?>'>
						<?php endif; ?>

                        <button type="submit" class="btn btn-outline-primary">

                            <?php if(isset($pre_data)): ?> Update <?php else: ?> Add <?php endif; ?> Coupon

                        </button>



                    </div>

                </div>



                <?php echo Form::close(); ?>




            </div>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-12">

        <div class="card m-b-20">

            <div class="card-body">



                <table class='table table-bordered table-striped'>
				  <thead>
				     <tr>
					    <th>#</th>
					    <th>SKU</th>
					    <th>Coupon</th>
					    <th>Start Date</th>
					    <th>End Date</th>
					    <th>Discount (%)</th>
					    <th>Maximum Discount</th>
					    <th>No Of Users</th>
					    <th>Per User</th>
					    <th>Action</th>
					 </tr>
				  </thead>
				  <tbody>
				  <?php if(count($data)): ?>
				    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					  <tr>
					    <td><?php echo e($key+1); ?></td>
					    <td><?php echo e($row->sku); ?></td>
					    <td><?php echo e($row->coupon_code); ?></td>
					    <td><?php echo e($row->start_date); ?></td>
					    <td><?php echo e($row->end_date); ?></td>
					    <td><?php echo e($row->discount); ?></td>
					    <td><?php echo e($row->maximum_discount); ?></td>
					    <td><?php echo e($row->no_of_users); ?></td>
					    <td><?php echo e($row->per_user); ?></td>
						<td>
						  <a class='btn btn-xs btn-sm btn-primary' href="<?php echo e(url('admin/product-discount-offer/'.$row->id)); ?>">Edit</a>
						  <a class='btn btn-xs btn-sm btn-danger' href="<?php echo e(url('admin/product-discount-offer-delete/'.$row->id)); ?>">Delete</a>
						</td>
					  </tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				  <?php else: ?>
					  <tr>
				        <th colspan='9'>No Data Found.</th>
				      </tr>
				  <?php endif; ?>
				  </tbody>
				</table>



            </div>

        </div>

    </div>

</div>
<!--------------------------------------------->
<div class="modal" id="offeringProductModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Offering Product</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <input type='text' class='form-control' placeholder='type sku or title' onkeyup='advanceProductSearch(this.value)'>
		<div class='result_product'></div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!--------------------------------------------->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
function advanceProductSearch(value){
	$.ajax({
			  url: "<?php echo e(url('admin/advance_product_search')); ?>",
			  data : { searchTerm:value },
			  cache: false,
			  success: function(data){
				console.log(data);
				var html = '';
				for(var i=0;i<data.length;i++){
					html += "<div class='row' style='margin-top:50px;cursor: pointer;'  data-dismiss='modal' onclick=\"$('#offering_product').val('"+data[i].sku+"');\"><div class='col-md-2'><img src='"+data[i].thumbnail+"' style='width: 100%'></div><div class='col-md-10'><h5 style='margin:0px'>"+data[i].title+"</h5><strong> Template - </strong>"+data[i].name+"<br><strong>SKU - </strong>"+data[i].sku+" <strong> HSN - </strong>"+data[i].hsn_code+"<br><strong>Price - </strong>"+data[i].product_price+" <strong> "+data[i].selling_price_label+" - </strong>"+data[i].selling_price+"<br><strong> Description - </strong>"+data[i].description+"</div></div><hr>";
				}
				$('.result_product').html(html);
			  }
	});
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/offers/productDiscount/index.blade.php ENDPATH**/ ?>