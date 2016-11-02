<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('frontend.templates.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <br>
    <br>
    <div class="container">
        <div class="page-wrapper">
            <div class="wrapper">
                <div class="row">
                    <div class="col-md-4">
                        <div class="well well-lg">
                            <h4>Register...</h4>
                            <?php echo $__env->make('frontend.templates.reg-form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                    </div>
                    <div class="col-md-8" style="padding-top: 150px;" >
                        <img src="<?php echo e(asset('images/banner2.png')); ?>" alt="banner" width="550" class="img-responsive pull-right">
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>