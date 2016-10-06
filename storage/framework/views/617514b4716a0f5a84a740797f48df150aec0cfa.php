<?php $__env->startSection('content'); ?>
    <div id="wrapper">

        <!-- Navigation -->
        <?php echo $__env->make('backend.admin.templates.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <!-- Page Content -->
        <div id="page-wrapper">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">My Signature</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-pencil fa-fw"></i> Digital Signature
                            <div class="pull-right">
                                <ul class="list-inline">
                                    <li><span class="fa fa-plus-circle fa-fw"></span></li>
                                    <li><span class="fa fa-minus-circle fa-fw"></span></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?php echo e(Form::open(['method' => 'post', 'url' => route('generateSignature'), 'class' => 'form-inline'])); ?>

                            <fieldset>
                                <?php /*hanldes auth->failed msg*/ ?>
                                <?php if(session()->has('failed')): ?>
                                    <div class="text-danger text-center">
                                        <?php echo e(session()->get('failed')); ?>

                                    </div>
                                <?php endif; ?>
                                <?php /*/handles auth->failed msg*/ ?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group <?php echo e($errors->has('count') ? 'has-error' : ""); ?>">
                                            <?php echo $errors->first('count', '<span class="text-danger">:message</span>'); ?>

                                            <label for="count" class="form-inline">How many signature(s) to generate?</label>
                                            <?php echo e(Form::select('count', [
                                                1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5',
                                                6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10'],
                                                 null, ['class' => 'form-control'])); ?>

                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo e(Form::submit('Generate',  ['class' => 'btn btn-md btn-success pull-left'])); ?>

                                    </div>
                                </div>
                            </fieldset>
                            <?php echo e(Form::close()); ?>

                            <br>
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>Signature</th>
                                        <th>Used by</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php foreach( $current_user->signatures as $user): ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo e($user->signature); ?></td>
                                        <td><?php echo e($user->used_by == null ? "Not Used" : "Used"); ?></td>
                                        <td class="center"><a href="">View Details</a></td>
                                    </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>