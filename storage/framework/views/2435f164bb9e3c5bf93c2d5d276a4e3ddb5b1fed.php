<?php $__env->startSection('content'); ?>
    <div id="wrapper">

        <!-- Navigation -->
        <?php echo $__env->make('frontend.users.advisers.templates.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Profile</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4><span class="fa fa-fw">@</span> Change Email</h4>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <?php echo e(Form::open(['method' => 'patch', 'url' => route('updateEmail')])); ?>

                                <fieldset>
                                    <?php if(session()->has('failed')): ?>
                                        <div class="text-danger text-center">
                                            <?php echo e(session()->get('failed')); ?>

                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group">
                                        <?php echo e(Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'New Email'] )); ?>

                                    </div>
                                    <div class="form-group">
                                        <?php echo e(Form::email('confirmEmail', null, ['class' => 'form-control', 'placeholder' => 'Confirm Email'])); ?>

                                    </div>
                                    <div class="form-group">
                                        <?php echo e(Form::password('password', ['class' => 'form-control', 'placeholder' => 'Current password'])); ?>

                                    </div>
                                    <?php echo e(Form::submit('Update Email', ['class' => 'btn btn-success from-control'])); ?>

                                        <a href="<?php echo e(route('profile')); ?>" class="btn btn-danger btn-md">Cancel</a>
                                    <?php echo e(Form::close()); ?>

                                </fieldset>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
<!-- /#wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>