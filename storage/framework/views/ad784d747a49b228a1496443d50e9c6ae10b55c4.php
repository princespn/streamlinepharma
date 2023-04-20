

<?php $__env->startSection('pageTitle'); ?>

    <div class="float-right">
        <a href="<?php echo e(route('vendorKyc.index')); ?>" class="btn btn-outline-light">
            Back
        </a>
    </div>
    <h4 class="page-title"> <i class="dripicons-tags"></i> Edit Vendor KYC</h4>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contentData'); ?>

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <?php echo e(Form::model($vendorKyc, array('route' => array('vendorKyc.update', $vendorKyc->id), 'method' => 'PUT','enctype'=>'multipart/form-data'))); ?>

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
                                    <label>Co. Name</label>
                                    <input type="text" name="companyName" class="form-control" value="<?php echo e($vendorKyc->companyName); ?>" required/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Co.Type</label>
                                    <select name="companyType" class="form-control select2" required>
                                        <option value="1"  <?php echo e($vendorKyc->companyType == 1 ? 'selected' : ''); ?>>Limited Company</option>
                                        <option value="2"  <?php echo e($vendorKyc->companyType == 2 ? 'selected' : ''); ?>>Private Limited Company</option>
                                        <option value="3"  <?php echo e($vendorKyc->companyType == 3 ? 'selected' : ''); ?>>Partnership Firm</option>
                                        <option value="4"  <?php echo e($vendorKyc->companyType == 4 ? 'selected' : ''); ?>>Proprietorship</option>
                                        <option value="5"  <?php echo e($vendorKyc->companyType == 5 ? 'selected' : ''); ?>>LLP</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>KYC Address</label>
                                    <input type="text" name="kycAddress" class="form-control" value="<?php echo e($vendorKyc->kycAddress); ?>" required/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>KYC Address Proof Image URL</label>
                                    <input type="text" name="kycAddressProof" class="form-control" value="<?php echo e($vendorKyc->kycAddressProof); ?>" required/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>TAN No</label>
                                    <input type="text" name="tanNumber" class="form-control" value="<?php echo e($vendorKyc->tanNumber); ?>" required/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>TAN Image URL</label>
                                    <input type="text" name="tanImage" class="form-control" value="<?php echo e($vendorKyc->tanImage); ?>" required/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Account Holder Name</label>
                                    <input type="text" name="accountHolderName" class="form-control" value="<?php echo e($vendorKyc->accountHolderName); ?>" required/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Account Number</label>
                                    <input type="text" name="accountNumber" class="form-control" value="<?php echo e($vendorKyc->accountNumber); ?>" required/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>IFSC Code</label>
                                    <input type="text" name="ifscCode" class="form-control" value="<?php echo e($vendorKyc->ifscCode); ?>" required/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Bank Name</label>
                                    <input type="text" name="bankName" class="form-control" value="<?php echo e($vendorKyc->bankName); ?>" required/>
                                </div>
                            </div>

                             <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Bank Address</label>
                                    <input type="text" name="bankAddress" class="form-control" value="<?php echo e($vendorKyc->bankAddress); ?>" required/>
                                </div>
                            </div>

                             <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Bank Proof Name</label>
                                    <input type="text" name="bankProofName" class="form-control" value="<?php echo e($vendorKyc->bankProofName); ?>" required/>
                                </div>
                            </div>

                             <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Bank Proof Image URL</label>
                                    <input type="text" name="bankProofImage" class="form-control" value="<?php echo e($vendorKyc->bankProofImage); ?>" required/>
                                </div>
                            </div>

                             <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Blank Check</label>
                                    <input type="text" name="blankCheck" class="form-control" value="<?php echo e($vendorKyc->blankCheck); ?>" required/>
                                </div>
                            </div>

                             <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Blank Check Image URL</label>
                                    <input type="text" name="blankCheckImage" class="form-control" value="<?php echo e($vendorKyc->blankCheckImage); ?>" required/>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Select Status</label>
                                    <select name="status" class="form-control select2" value="<?php echo e($vendorKyc->status); ?>" required>
                                        <option value="0" <?php echo e($vendorKyc->status == 0 ? 'selected' : ''); ?>>Inactive</option>
                                        <option value="1" <?php echo e($vendorKyc->status == 1 ? 'selected' : ''); ?>>Active</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">

                                <button type="submit" class="btn btn-outline-primary">
                                    Submit
                                </button>

                            </div>
                        </div>

                    <?php echo Form::close(); ?> 

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/uniqueandcommon.com/public_html/globle_panel/public/new/resources/views/admin/income/vendorKyc/edit.blade.php ENDPATH**/ ?>