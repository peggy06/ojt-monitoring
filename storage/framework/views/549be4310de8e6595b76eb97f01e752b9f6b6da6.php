<?php echo e(Form::open(['method' => 'patch', 'url' => route('changeDP'), 'files' => true])); ?>


<div class="form-group <?php echo e($errors->has('image') ? 'has-error' : ""); ?>">
    <?php echo $errors->first('image', '<span class="text-danger">:message</span>'); ?>

    <?php echo e(Form::file('image', null)); ?>

    <span class="small text-info pull-right">File size limit (2mb)</span><br>
</div>
<?php echo e(Form::submit('Upload', ['class' => 'btn btn-primary pull-right'])); ?>