<?php $__env->startSection('content'); ?>
    <?php echo e(Form::open(['method' => 'post', 'url' => route('login')])); ?>

        <div class="form-group">
            <?php echo e(Form::input('text', 'email',null, ['class' => 'form-control', 'placeholder' => 'Username'])); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password'])); ?>

        </div>
        <?php echo e(Form::submit('Login',  ['class' => 'btn btn-primary'])); ?>

    <?php echo e(Form::close()); ?>

    <?php if(session()->has('failed')): ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo e(session()->get('failed')); ?>

        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>