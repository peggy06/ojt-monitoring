<?php $__env->startSection('content'); ?>
    <div class="container">
        Hi <?php echo e($firstname); ?>,
        <p>
            Thank you for registering with <a href="ojt-monitoring.herokuapp.com/public">ojt-monitoring.herokuapp.com</a> and allowing us to monitor your path to success.
            <br>
            <a href="<?php echo e(route('userConfirmation', $code)); ?>">Please use this link to complete your registration</a>
            <br>
        </p>
        Thanks,<br>
        OJT Monitoring BOTS
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>