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
                            <div class="row">
                                <div class="col-md-6 col-sm-7 col-xs-7">
                                    <h4>
                                        <i class="fa fa-pencil fa-fw"></i> Digital Signature
                                    </h4>
                                </div>
                                <div class="col-md-6 col-sm-5 col-xs-5">
                                    <div class="tooltip-demo pull-right">
                                        <button class="btn btn-success btn-circle" data-toggle="tooltip" data-placement="top" title="Add Signature" id="trigger">
                                            <span class="fa fa-plus"></span>
                                        </button>
                                        <a href="" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="top" title="Delete All Signatures">
                                            <span class="fa fa-minus"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?php echo e(Form::open(['method' => 'post', 'url' => route('generateSignature'), 'class' => 'form-inline', 'id' => 'addSign', 'style' => 'display: none;'])); ?>

                            <fieldset>
                                <?php /*hanldes auth->failed msg*/ ?>
                                <?php if(session()->has('failed')): ?>
                                    <div class="text-danger text-center">
                                        <?php echo e(session()->get('failed')); ?>

                                    </div>
                                <?php endif; ?>
                                <?php /*/handles auth->failed msg*/ ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group <?php echo e($errors->has('count') ? 'has-error' : ""); ?>">
                                            <?php echo $errors->first('count', '<span class="text-danger">:message</span>'); ?>

                                            <label for="count" class="form-inline">How many signature(s) to generate?</label>
                                            <?php echo e(Form::select('count', [
                                                1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5',
                                                6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10'],
                                                 null, ['class' => 'form-control'])); ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 pull-right">
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
                                        <td><?php echo e($user->used_by == null ? "Not Used" : $users->where('id', $user->used_by)->first()->name); ?></td>
                                        <td class="center"><a href="" data-toggle="modal" data-target="#signatureModal<?php echo e($user->id); ?>">View Details</a></td>
                                    </tr>

                                    <div class='modal fade' id='signatureModal<?php echo e($user->id); ?>' role='dialog'>
                                        <div class='modal-dialog modal-md'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                    <h4 class='modal-title'>Detailed View</h4>
                                                </div>
                                                <div class='modal-body'>
                                                    <ul class="list-unstyled">
                                                        <li>Signature: <i class="pull-right"><?php echo e($user->signature); ?></i></li>
                                                        <li>Date created: <i class="pull-right"><?php echo e($user->created_at->format('M. d, Y - h:i A')); ?></i></li>
                                                        <li>
                                                            Used by:
                                                            <i class="pull-right">
                                                                <?php if($user->used_by == null): ?>
                                                                    Not Used
                                                                <?php else: ?>
                                                                    <?php echo e($users->where('id', $user->used_by)->first()->name); ?>

                                                                    at <?php echo e($user->updated_at->format('M. d, Y - h:i A')); ?>

                                                                <?php endif; ?>
                                                            </i>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class='modal-footer'>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

    <script>
        $(document).ready(function(){
            $("#trigger").click(function(){
                $("#addSign").slideToggle("slow");
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>