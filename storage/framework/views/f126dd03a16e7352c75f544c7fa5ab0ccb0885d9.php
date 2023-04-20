

<?php $__env->startSection('pageTitle'); ?>

<div class="float-right">
    <a href="<?php echo e(route('offers.index')); ?>" class="btn btn-outline-light">
        Back
    </a>
</div>

<h4 class="page-title"> <i class="dripicons-calendar"></i>Add Offer</h4>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>

<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">
                <?php echo Form::open(['route' => 'offers.store','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']); ?>

                <?php echo e(csrf_field()); ?>

                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <?php if($errors->any()): ?>
                        <div class="alert bg-danger text-white msgPopup" role="alert">
                            <?php echo e($errors->first()); ?>

                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label>Select Scheme</label>

                            <select name="scheme" class="form-control" required>
                                <option value="">Choose Scheme</option>
                                <?php if(isset($schemeList)): ?>
                                <?php $__currentLoopData = $schemeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$scheme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($scheme->id); ?>" <?php if(isset($offerList)&&$offerList->scheme==$scheme->id): ?> selected   <?php endif; ?>><?php echo e($scheme->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <p class="col-lg-12"></p>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label>Purchase Product SKU</label>
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <input type="text" placeholder="Enter Product SKU" name="product_sku" id="product_sku" class="form-control" required value='<?php if(isset($offerList)): ?><?php echo e($offerList->product_sku); ?><?php endif; ?>' data-toggle="modal" data-target="#offeringProductModal"  readonly  onclick="$('#tmp_id').val('product_sku');$('.result_product').html('');$('#search_advance_input').val('');" />
                                </div>
                                <div class="col-sm-3 col-md-3 col-lg-3">
                                    <input type="text" placeholder="Enter QTY" value='<?php if(isset($offerList)): ?><?php echo e($offerList->qty); ?><?php endif; ?>' name="product_qty" class="form-control " required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label>GET Product SKU</label>
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <input type="text" placeholder="Enter get Product SKU" name="get_product_sku" id='get_product_sku' class="form-control" value='<?php if(isset($offerList)): ?><?php echo e($offerList->get_prod_sku); ?><?php endif; ?>' data-toggle="modal" data-target="#offeringProductModal"  readonly onclick="$('#tmp_id').val('get_product_sku');$('.result_product').html('');$('#search_advance_input').val('');" />
                                </div>
                                <div class="col-sm-3 col-md-3 col-lg-3">
                                    <input type="text" placeholder="Get QTY" value='<?php if(isset($offerList)): ?><?php echo e($offerList->get_qty); ?><?php endif; ?>' name="get_qty" class="form-control" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="col-lg-12"></p>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="datetime-local" id='startDate' name="startDate" class="form-control" required  <?php if(isset($offerList)): ?> value='<?php echo e($offerList->startDate); ?>' <?php endif; ?>  />
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="form-group">
                            <label>End Date</label>
                            <input type="datetime-local" name="endDate" class="form-control" required <?php if(isset($offerList)): ?> value='<?php echo e($offerList->endDate); ?>' <?php endif; ?>  id='endDate' />
                        </div>
                    </div>
					<div class="col-sm-12">
                        <div class="form-group">
                            <label>Terms and Conditions</label>
                            <textarea  name="terms_and_conditions" class="summernote form-control" required ><?php if(isset($offerList)): ?><?php echo e($offerList->terms_and_conditions); ?><?php endif; ?></textarea>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
					<?php if(isset($offerList)): ?> 
						<input type='hidden' name='id' value='<?php echo e($offerList->id); ?>'>
					<?php endif; ?>
                        <button type="submit" class="btn btn-outline-primary">
                            <?php if(isset($offerList)): ?> Update <?php else: ?> Submit <?php endif; ?>
							</button>
                    </div>
                </div>
                <?php echo Form::close(); ?>

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
        <input type='text' class='form-control' placeholder='type sku or title' onkeyup='advanceProductSearch(this.value)' id='search_advance_input'>
		<div class='result_product'></div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<input type='hidden' id='tmp_id'>
<!--------------------------------------------->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
function advanceProductSearch(value){
	$('.result_product').html('');
	var tmp_id = $('#tmp_id').val();
	$.ajax({
			  url: "<?php echo e(url('admin/advance_product_search')); ?>",
			  data : { searchTerm:value },
			  cache: false,
			  success: function(data){
				console.log(data);
				var html = '';
				for(var i=0;i<data.length;i++){
					html += "<div class='row' style='margin-top:50px;cursor: pointer;'  data-dismiss='modal' onclick='$("+'"#'+tmp_id+'"'+").val("+'"'+data[i].sku+'"'+");' ><div class='col-md-2'><img src='"+data[i].thumbnail+"' style='width: 100%'></div><div class='col-md-10'><h5 style='margin:0px'>"+data[i].title+"</h5><strong> Template - </strong>"+data[i].name+"<br><strong>SKU - </strong>"+data[i].sku+" <strong> HSN - </strong>"+data[i].hsn_code+"<br><strong>Price - </strong>"+data[i].product_price+" <strong> "+data[i].selling_price_label+" - </strong>"+data[i].selling_price+"<br><strong> Description - </strong>"+data[i].description+"</div></div><hr>";
				}
				$('.result_product').html(html);
			  }
	});
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/offers/purchase/add.blade.php ENDPATH**/ ?>