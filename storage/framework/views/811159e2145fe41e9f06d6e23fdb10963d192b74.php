<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('backend.templates.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Admin Login</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo e(Form::open(['method' => 'post', 'url' => route('adminLogin')])); ?>

                        <fieldset>
                            <?php /*hanldes auth->failed msg*/ ?>
                            <?php if(session()->has('failed')): ?>
                                <div class="text-danger text-center">
                                    <?php echo e(session()->get('failed')); ?>

                                </div>
                            <?php endif; ?>
                            <?php /*/handles auth->failed msg*/ ?>
                            <div class="form-group <?php echo e($errors->has('email') ? 'has-error' : ""); ?>">
                                <?php echo $errors->first('email', '<span class="text-danger">:message</span>'); ?>

                                <?php echo e(Form::input('email', 'email',null, ['class' => 'form-control', 'placeholder' => 'Email'])); ?>

                            </div>
                            <div class="form-group <?php echo e($errors->has('password') ? 'has-error' : ""); ?>">
                                <?php echo $errors->first('password', '<span class="text-danger">:message</span>'); ?>

                                <?php echo e(Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password'])); ?>

                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <?php echo e(Form::submit('Login',  ['class' => 'btn btn-lg btn-success btn-block'])); ?>

                        </fieldset>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>