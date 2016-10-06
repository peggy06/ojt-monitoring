<?php $__env->startSection('content'); ?>
    <div class="container">
        <?php echo $__env->make('frontend.users.templates.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title" style="color: #31708f">Sign Up
                            <span class="pull-right">
                                <a href="<?php echo e(route('showLogin')); ?>"><i class="fa fa-sign-in fa-fw"></i></a>
                            </span>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <?php echo e(Form::open(['method' => 'post', 'url' => route('userRegister')])); ?>

                        <fieldset>
                            <?php /*hanldes auth->failed msg*/ ?>
                            <?php if(session()->has('failed')): ?>
                                <div class="text-danger text-center">
                                    <?php echo e(session()->get('failed')); ?>

                                </div>
                            <?php endif; ?>
                            <?php /*/handles auth->failed msg*/ ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group <?php echo e($errors->has('email') ? 'has-error' : ""); ?>">
                                        <?php echo $errors->first('email', '<span class="text-danger">:message</span>'); ?>

                                        <?php echo e(Form::input('text', 'firstname' ,null, ['class' => 'form-control', 'placeholder' => 'Firstname'])); ?>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group <?php echo e($errors->has('email') ? 'has-error' : ""); ?>">
                                        <?php echo $errors->first('email', '<span class="text-danger">:message</span>'); ?>

                                        <?php echo e(Form::input('text', 'lastname' ,null, ['class' => 'form-control', 'placeholder' => 'Lastname'])); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group <?php echo e($errors->has('email') ? 'has-error' : ""); ?>">
                                <?php echo $errors->first('email', '<span class="text-danger">:message</span>'); ?>

                                <?php echo e(Form::input('email', 'email' ,null, ['class' => 'form-control', 'placeholder' => 'Email'])); ?>

                            </div>
                            <div class="form-group <?php echo e($errors->has('password') ? 'has-error' : ""); ?>">
                                <?php echo $errors->first('password', '<span class="text-danger">:message</span>'); ?>

                                <?php echo e(Form::password('signature', ['class' => 'form-control', 'placeholder' => 'Digital Signature'])); ?>

                            </div>
                            <?php echo e(Form::submit('Sign Up',  ['class' => 'btn btn-lg btn-success'])); ?>

                            <span class="pull-right">
                                <a href="">Lost your password?</a>
                            </span>
                        </fieldset>
                        <?php echo e(Form::close()); ?>

                        <br>
                        <div class="text-center">
                            Already a member ? <a href="<?php echo e(route('showLogin')); ?>">Log in</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>