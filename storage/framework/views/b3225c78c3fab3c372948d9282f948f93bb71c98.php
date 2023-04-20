
<?php $__env->startSection('title', 'Shop'); ?>
<?php $__env->startSection('page-content'); ?>
<main class="main">
    <?php if($advance_product_banner&&$advance_product_banner->banner): ?>
        <div class="container mb-30">
            <div class="row flex-row-reverse">
			  <img src='<?php echo e(url($advance_product_banner->banner)); ?>' style='width:100%'>
			</div>
		</div>
	<?php endif; ?>
        <div class="container mb-30">
            <div class="row flex-row-reverse">
                <div class="col-lg-4-5">
                    <div class="row product-grid">
                    </div>
                    
                </div>
                <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
				<?php echo Form::open(['url' => 'filterInventory','method'=>'POST','id'=>'form','enctype'=>'multipart/form-data']); ?>

                <?php echo e(csrf_field()); ?>

                    
                    <!-- Fillter By Price -->
                    <div class="sidebar-widget price_range range mb-30">
                        <h5 class="section-title style-1 mb-30">Fill by price</h5>
                        <div class="price-filter">
                            <div class="price-filter-inner">
                                <div id="slider-range" class="mb-20"></div>
                                <div class="d-flex justify-content-between">
                                    <div class="caption">From: <strong id="slider-range-value1" class="text-brand"></strong></div>
                                    <div class="caption">To: <strong id="slider-range-value2" class="text-brand"></strong></div>
                                </div>
                            </div>
                        </div>
                        <div class="list-group">
                            <div class="list-group-item mb-10 mt-10">
                                <label class="fw-900">Color</label>
                                <div class="custome-checkbox">
								<?php $__currentLoopData = $all_color; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								    
                                    <input class="form-check-input" type="checkbox" id='color<?php echo e($key); ?>' value='<?php echo e($color); ?>' name='color[]' />
									<label class="form-check-label" for="color<?php echo e($key); ?>">
                                    <span><?php echo e($color); ?></span></label>
                                    <br />
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                </div>
                                <label class="fw-900 mt-15">Brand</label>
                                <div class="custome-checkbox">
								<?php $__currentLoopData = $brand; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <input class="form-check-input" type="checkbox" value="<?php echo e($row->id); ?>" id='brand<?php echo e($key); ?>' name="brand[]" />
                                    <label class="form-check-label" for="brand<?php echo e($key); ?>"><span><?php echo e($row->name); ?></span></label>
                                    <br />
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
								<!------------------>
								<?php if(isset($setting)&&$setting->additional_attribute!=Null): ?>
					<?php $__currentLoopData = json_decode($setting->additional_attribute)[0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<label class="fw-900 mt-15"><?php echo e($row); ?></label>
                                <div class="custome-checkbox">
								<?php if(json_decode($setting->additional_attribute)[1][$key]=='Checkboxes'): ?>
									<?php $__currentLoopData = explode(',',json_decode($setting->additional_attribute)[2][$key]); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $okey=>$opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <input class="form-check-input" type="checkbox" id='additional_attribute<?php echo e($key.$okey); ?>' name="multi_add_filter[<?php echo e($row); ?>][]" value='<?php echo e($opt); ?>' />
                                    <label class="form-check-label" for="exampleCheckbox11"><span><?php echo e($opt); ?></span></label>
                                    <br />
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php else: ?>
									<select class='form-control' name="single_add_filter[<?php echo e($row); ?>]">
                  <option value=''></option>
                  <?php $__currentLoopData = explode(',',json_decode($setting->additional_attribute)[2][$key]); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option><?php echo e($opt); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               </select>
               <br>
								<?php endif; ?>
                                </div>
				   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   <?php endif; ?>
								<!------------------>
                            </div>
                        </div>
						<?php if(isset($_GET['search'])): ?>
					    <input type="hidden" value="<?php echo e($_GET['search']); ?>" name='search_key' >
					    <?php endif; ?>
						<input type="hidden" value="<?php echo e(($pricing->min_price?$pricing->min_price:0)); ?>" name="minmumAmt" id="minmumAmt">
                        <input type="hidden" value="<?php echo e(($pricing->max_price? $pricing->max_price : 0 )); ?>" name="maximumAmt" id="maximumAmt">
						<input type="hidden" value="<?php echo e($id); ?>" name="id" >
                        <input type="hidden" value="<?php echo e($sub_id); ?>" name="sub_id" >
                        <input type="hidden" value="<?php echo e($template_id); ?>" name="template_id" >
						<!--button type="submit" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i> Fillter</button-->
                        
                    </div>
                    <!-- Product sidebar Widget -->
                    <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
                        <h5 class="section-title style-1 mb-30">New products</h5>
						<?php $__currentLoopData = $new_product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="single-post clearfix">
                            <div class="image">
                                <img src="<?php echo e($item->thumbnail); ?>" alt="#" />
                            </div>
                            <div class="content pt-10">
                                <h5><a href="<?php echo e(url('product-detail/'.$item->sku)); ?>"><?php echo e($item->title); ?></a></h5>
                                <p class="price mb-0 mt-5"><?php echo e($item->selling_price); ?></p>
                                <div class="product-rate">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                            </div>
                        </div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </div>
                    
				<?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-css'); ?>
<link rel="stylesheet" href="<?php echo e(url('Nest/assets/css/plugins/slider-range.css')); ?>" />
<?php $__env->stopPush(); ?>
<?php $__env->startPush('custom-scripts'); ?>
<script>
if ($("#slider-range").length) {
        $(".noUi-handle").on("click", function () {
            $(this).width(50);
        });
        var rangeSlider = document.getElementById("slider-range");
        var moneyFormat = wNumb({
            decimals: 0,
            thousand: "",
            prefix: ""
        });
        noUiSlider.create(rangeSlider, {
            //start: [<?php echo e(($pricing->min_price?$pricing->min_price:0)); ?>, <?php echo e(($pricing->max_price? $pricing->max_price : 0 )); ?>],
            start: [0, <?php echo e(($pricing->max_price? $pricing->max_price : 0 )); ?>],
            step: 1,
            range: {
                min: [0],
                max: [<?php echo e(($pricing->max_price? $pricing->max_price : 0 )); ?>]
            },
            format: moneyFormat,
            connect: true
        });

        // Set visual min and max values and also update value hidden form inputs
        rangeSlider.noUiSlider.on("update", function (values, handle) {
			$('#minmumAmt').val(values[0]);
			$('#maximumAmt').val(values[1]);
            document.getElementById("slider-range-value1").innerHTML = values[0];
            document.getElementById("slider-range-value2").innerHTML = values[1];
            document.getElementsByName("min-value").value = moneyFormat.from(values[0]);
            document.getElementsByName("max-value").value = moneyFormat.from(values[1]);
			if($('#minmumAmt').val()!=values[0]||$('#maximumAmt').val()!=values[1]){
				filterProduct();
			} 
			filterProduct();
        });
    } 
	
	$("form input,form,select[name=sortby]").change(function() {
   		  filterProduct();
   });
	function filterProduct() {
	$(".product-grid").html('');
	$(".product-div").remove();
	jQuery.ajax({
		url: "<?php echo e(url('filterProduct')); ?>",
		type: "GET",
		data: $('form').serialize(),
		success: function(data) {
			console.log(data);
			if (data.length) {
				var html = '';
				for (var i = 0; i < data.length; i++) {
					html += '<div class="col-lg-3 col-md-4 col-12 col-sm-6 product-div"><div class="product-cart-wrap mb-30"><div class="product-img-action-wrap"><div class="product-img product-img-zoom"><a href="<?php echo e(url('product-detail')); ?>/'+data[i].sku+'"><img class="default-img" src="'+data[i].thumbnail+'" alt="" /><img class="hover-img" src="'+data[i].thumbnail+'" alt="" /></a></div><div class="product-badges product-badges-position product-badges-mrg"></div></div><div class="product-content-wrap"><div class="product-category"></div><h2><a href="<?php echo e(url('product-detail')); ?>/'+data[i].sku+'">'+data[i].title+'</a></h2><div class="product-rate-cover"><div class="product-rate d-inline-block"><div class="product-rating" style="width: 90%"></div></div><span class="font-small ml-5 text-muted"> (4.0)</span></div><div class="product-card-bottom"><div class="product-price"><span>'+data[i].selling_price+'</span><span class="old-price">'+data[i].product_price+'</span></div></div></div></div></div>';
				}
				$(".product-grid").html(html); 
			} else {
				$(".product-grid").html('No Product Found');
			}
		}
	});
}
filterProduct();
</script> 
<?php $__env->stopPush(); ?>
<?php echo $__env->make('FrontEndTheme.Nest.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/FrontEndTheme/Nest/shop.blade.php ENDPATH**/ ?>