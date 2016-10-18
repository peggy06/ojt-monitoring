<?php $__env->startSection('content'); ?>
    <div class="container">

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title" style="color: #fff">Set Password
                            <span class="pull-right">
                                <a href="<?php echo e(route('showLogin')); ?>"><i class="fa fa-sign-in fa-fw"></i></a>
                            </span>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <?php echo e(Form::model('users', ['method' => 'patch', 'url' => route('setup', $vCode->user_id)])); ?>

                        <fieldset>
                            <?php /*hanldes auth->failed msg*/ ?>
                            <?php if(session()->has('failed')): ?>
                                <div class="text-danger text-center">
                                    <?php echo e(session()->get('failed')); ?>

                                </div>
                            <?php endif; ?>
                            <?php /*/handles auth->failed msg*/ ?>

                            <?php if($user->where('id', $vCode->user_id)->first()->role == 2): ?>
                                <div class="form-group">
                                    <label for="department">Department:</label>
                                    <select name="department" id="department" class="form-control">
                                        <?php foreach($departments as $department): ?>
                                            <option value="<?php echo e($department->id); ?>"><?php echo e($department->prefix); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            <?php endif; ?>
                            <div class="form-group <?php echo e($errors->has('password') ? 'has-error' : ""); ?>">
                                <?php echo $errors->first('password', '<span class="text-danger">:message</span>'); ?>

                                <?php echo e(Form::password('password', ['id'=> 'password', 'class' => 'form-control', 'placeholder' => 'Password'])); ?>

                            </div>
                            <div class="form-group <?php echo e($errors->has('password') ? 'has-error' : ""); ?>">
                                <?php echo $errors->first('password', '<span class="text-danger">:message</span>'); ?>

                                <?php echo e(Form::password('confirm', ['id' => 'confirm', 'class' => 'form-control', 'placeholder' => 'Confirm Password'])); ?>

                            </div>
                            <?php echo e(Form::submit('Finish',  ['class' => 'btn btn-lg btn-outline btn-success'])); ?>


                        </fieldset>
                        <?php echo e(Form::close()); ?>

                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>