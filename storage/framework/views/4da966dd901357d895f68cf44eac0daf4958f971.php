<?php echo e(Form::open(['method' => 'post', 'url' => route('userRegister')])); ?>

<fieldset>
    <?php /*hanldes auth->failed msg*/ ?>
    <?php if(session()->has('reg-failed')): ?>
        <div class="text-danger text-center">
            <?php echo session()->get('reg-failed'); ?>

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
    <div class="form-group <?php echo e($errors->has('bday') ? 'has-error' : ""); ?>">
        <label for="bday">Birthday:</label>
        <?php echo $errors->first('bday', '<span class="text-danger">:message</span>'); ?>

        <?php echo e(Form::date('bday', null, ['class' => 'form-control', 'placeholder' => 'mm/dd/yyy'])); ?>

    </div>
    <div class="form-group <?php echo e($errors->has('signature') ? 'has-error' : ""); ?>">
        <?php echo $errors->first('signature', '<span class="text-danger">:message</span>'); ?>

        <?php echo e(Form::input('text','signature', null, ['class' => 'form-control', 'placeholder' => 'Digital Signature'])); ?>

    </div>
    <?php echo e(Form::submit('Sign Up',  ['class' => 'btn btn-lg btn-success'])); ?>

</fieldset>
<?php echo e(Form::close()); ?>