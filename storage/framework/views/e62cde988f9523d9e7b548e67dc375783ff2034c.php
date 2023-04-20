<?php $__env->startSection('pageTitle'); ?>

<div class="float-right">
    <a href="#!" class="btn btn-outline-light" data-toggle="modal" data-target=".searchPopup">
        Add my keyword
    </a>
    <a href="<?php echo e(route('keysample')); ?>" class="btn btn-outline-light">Download Sample</a>
</div>
<h4 class="page-title"> <i class="dripicons-checklist"></i> My Keyword listing</h4>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('contentData'); ?>
<?php if(session('message')): ?>
<div class="">
    <div class="alert alert-success">
        <?php echo e(session('message')); ?>

    </div>
</div>
<?php endif; ?>
<?php if(session('duplicateKey')): ?>
<div class="">
    <div class="alert alert-danger">
    <p>These are duplicate key. Please try to avoid these key.</p>
        <?php echo session('duplicateKey'); ?>

    </div>
</div>
<?php session()->forget('duplicateKey');?>
<?php endif; ?>
<div class="row">
    <div class="col-12">
        <div class="card m-b-20">
            <div class="card-body">

                <div class="modal fade searchPopup" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title mt-0">Search/Bulk Add Keyword</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <?php echo Form::open(['route' => 'accountAffiliateKeyword.create','method'=>'get','id'=>'form','enctype'=>'multipart/form-data']); ?>

                                <?php echo e(csrf_field()); ?>

                                <div class="form-group">
                                    <input type="text" name="search" class="form-control" placeholder="search keyword" required />
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-outline-danger">Search</button>
                                </div>
                                <?php echo Form::close(); ?>

                                <hr />
                                <?php echo Form::open(['route' => 'bulkeyword','method'=>'post','id'=>'bulkform','enctype'=>'multipart/form-data']); ?>

                                <?php echo e(csrf_field()); ?>

                                <div class="form-group">
                                    <input type="file" name="keyword" class="form-control" pattern="^.+\.(xlsx|xls)$" placeholder="upload keyword file" required />
                                    <label>Note:-Download Sample File, add keyword then submit.</label>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-outline-danger">Submit</button>
                                </div>
                                <?php echo Form::close(); ?>

                            </div>
                            <div class="modal-footer">

                            </div>

                        </div>
                    </div>
                </div>

                <table id="datatable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Keyword</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $affiliateKeywordList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$affiliateKeyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php if($affiliateKeyword->keyword): ?>
                        <tr>
                            <td><?php echo e($affiliateKeyword->keyword?$affiliateKeyword->keyword->keyword:''); ?></td>
                            <td>
                                <?php if($affiliateKeyword->keyword && $affiliateKeyword->status==2): ?>
                                Pending
                                <?php else: ?>
                                Approved
                                <?php endif; ?>
                            </td>
                        </tr>
						<?php else: ?>
						<?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/product/affiliateKeyword/index.blade.php ENDPATH**/ ?>