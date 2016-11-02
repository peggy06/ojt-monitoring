<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('backend.templates.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="well well-lg">
                    <div class="panel-heading">
                        <h4>Register Successful!</h4>
                    </div>
                    <div class="panel-body">
                        <p>
                            Admin account has been successfully setup! <a href="<?php echo e(route('adminIndex')); ?>">Login</a> your account to continue
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>