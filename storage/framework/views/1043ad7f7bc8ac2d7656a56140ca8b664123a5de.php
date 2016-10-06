<?php $__env->startSection('content'); ?>
    <div class="container">
        <?php echo $__env->make('frontend.users.templates.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>