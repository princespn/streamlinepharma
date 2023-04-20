
<?php $__env->startSection('title', 'About'); ?>
<?php $__env->startSection('page-content'); ?>
<main class="main">
        
        <div class="container mb-80 mt-50">
            <?php $__currentLoopData = $m_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div style='position:relative'>
							<img src="<?php echo e($row->image); ?>"  style="width:100%;">
							<div style='width: 100%;position: absolute;top:0px;'>
							  <div style=''>
								<h2><?php echo $row->title; ?>asdasd</h2>
								<h4><?php echo $row->sub_title; ?></h4>
							  </div>
							</div>
						</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('FrontEndTheme.Nest.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/FrontEndTheme/Nest/u_referral_scheme.blade.php ENDPATH**/ ?>