<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('backend.templates.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel well well-lg">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Set OJT Hours</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo e(Form::open(['method' => 'post', 'url' => route('adminSetHours')])); ?>

                        <fieldset>
                            <?php /*hanldes auth->failed msg*/ ?>
                            <?php if(session()->has('failed')): ?>
                                <div class="text-danger text-center">
                                    <?php echo e(session()->get('failed')); ?>

                                </div>
                            <?php endif; ?>
                            <?php /*/handles auth->failed msg*/ ?>
                            <div class="form-group <?php echo e($errors->has('hours') ? 'has-error' : ""); ?>">
                                <?php echo $errors->first('hours', '<span class="text-danger">:message</span>'); ?>

                                <?php echo e(Form::number('hours',null, ['class' => 'form-control', 'placeholder' => 'OJT Hours'])); ?>

                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <?php echo e(Form::submit('Set',  ['class' => 'btn btn-lg btn-success pull-right'])); ?>

                        </fieldset>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>