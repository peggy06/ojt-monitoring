<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('backend.templates.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <br>
    <br>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="well well-lg">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Admin Account Setup</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo e(Form::open(['method' => 'post', 'url' => route('adminInstall')])); ?>

                        <fieldset>
                            <?php /*hanldes auth->failed msg*/ ?>
                            <?php if(session()->has('setup-failed')): ?>
                                <div class="text-danger text-center">
                                    <?php echo session()->get('setup-failed'); ?>

                                </div>
                            <?php endif; ?>
                            <div class="form-group <?php echo e($errors->has('firstname') ? 'has-error' : ""); ?>">
                                <?php echo $errors->first('firstname', '<span class="text-danger">:message</span>'); ?>

                                <?php echo e(Form::input('text', 'firstname' ,null, ['class' => 'form-control', 'placeholder' => 'Firstname'])); ?>

                            </div>
                            <div class="form-group <?php echo e($errors->has('lastname') ? 'has-error' : ""); ?>">
                                <?php echo $errors->first('lastname', '<span class="text-danger">:message</span>'); ?>

                                <?php echo e(Form::input('text', 'lastname' ,null, ['class' => 'form-control', 'placeholder' => 'Lastname'])); ?>

                            </div>
                            <div class="form-group <?php echo e($errors->has('email') ? 'has-error' : ""); ?>">
                                <?php echo $errors->first('email', '<span class="text-danger">:message</span>'); ?>

                                <?php echo e(Form::input('email', 'email' ,null, ['class' => 'form-control', 'placeholder' => 'Email'])); ?>

                            </div>
                            <?php echo $errors->first('contact', '<span class="text-danger">:message</span><br>'); ?>

                            <div class="form-group input-group <?php echo e($errors->has('contact') ? 'has-error' : ""); ?>">
                                <span class="input-group-addon">+63</span>
                                <?php echo e(Form::input('text', 'contact', null, ['class' => 'form-control', 'placeholder' => 'Contact Number'])); ?>

                            </div>
                            <div class="form-group <?php echo e($errors->has('gender') ? 'has-error' : ""); ?>">
                                <?php echo $errors->first('gender', '<span class="text-danger">:message</span>'); ?>

                                <?php echo e(Form::select('gender', ['' =>'Gender','male' => 'Male', 'female' => 'Female'], null, ['class' => 'form-control'])); ?>

                            </div>
                            <div class="form-group <?php echo e($errors->has('key') ? 'has-error' : ""); ?>">
                                <?php echo $errors->first('key', '<span class="text-danger">:message</span>'); ?>

                                <?php echo e(Form::input('text', 'key' ,null, ['class' => 'form-control', 'placeholder' => 'APP-key: xxxxxxxxxxxxxxxx'])); ?>

                            </div>
                            <?php echo e(Form::submit('Sign Up',  ['class' => 'btn btn-lg btn-success'])); ?>

                        </fieldset>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>