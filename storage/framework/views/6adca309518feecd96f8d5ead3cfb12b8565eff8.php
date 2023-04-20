

<?php $__env->startSection('pageTitle'); ?>

   
        <div class="float-right">
            <a href="<?php echo e(route('faq.create')); ?>" class="btn btn-outline-light">
                Add Special Page
            </a>
        </div>
    

    <h4 class="page-title"> <i class="dripicons-list"></i> Special Page listing</h4>

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
                                <th>Heading</th>
                                
                                <th>Description</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
						<?php $__currentLoopData = $faqList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						  <tr>
						       <td><?= $key+1 ?></td>
						       <td><?php echo e($row->title); ?></td>
						       <td><?= $row->description ?></td>
						       <td>
							     <a href="<?php echo e(url('admin/faq/create/'.$row->id)); ?>" class='btn btn-xs btn-primary'>Edit</a>
							     <a href='#' class='btn btn-xs btn-danger' onclick="return confirm('Are you sure to delete ?')">Delete</a>
							   </td>
							   </tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/pages/faq/index.blade.php ENDPATH**/ ?>