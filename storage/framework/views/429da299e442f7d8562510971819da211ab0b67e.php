<?php $__env->startSection('content'); ?>
    <div id="wrapper">

        <!-- Navigation -->
        <?php echo $__env->make('backend.admin.templates.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">e-Logbook</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>
                            <?php if(session()->has('deletedLogs')): ?>
                                <i class="fa fa-trash fa-fw"></i> Deleted Logs |
                                <span class="small"><a href="<?php echo e(route('activeLogs')); ?>">Activity Log</a></span>
                                <div class="pull-right">
                                    <a href="<?php echo e(route('restoreLogs')); ?>"><span class="glyphicon glyphicon-trash"></span> Restore All</a>
                                </div>
                            <?php else: ?>
                                <i class="fa fa-list-alt fa-fw"></i> Activity Log |
                                <span class="small"><a href="<?php echo e(route('deletedLogs')); ?>">Deleted Log</a></span>
                                <?php /*TODO: decide if this function will be added or it was too risky ?*/ ?>
                                <?php /*<div class="pull-right">*/ ?>
                                <?php /*<a href="<?php echo e(route('resetLogs')); ?>" class="text-danger"><span class="fa fa-minus-circle fa-fw"></span> Delete All</a>*/ ?>
                                <?php /*</div>*/ ?>
                            <?php endif; ?>
                            </h4>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <th>User</th>
                                        <th>Activity</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                    <?php if(session()->has('deletedLogs')): ?>
                                        <?php foreach( $logs->where('deleted', '1')->get() as $log): ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo e($users->where('id', $log->user_id)->first()->name == auth('admin')->user()->name ? "You" : $users->where('id', $log->user_id)->first()->name); ?></td>
                                                <td><?php echo e($log->activity); ?></td>
                                                <td><?php echo e($log->created_at->diffForHumans()); ?></td>
                                                <td class="center"><a href="">View Details</a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <?php foreach( $logs->where('deleted', '0')->get() as $log): ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo e($users->where('id', $log->user_id)->first()->name == auth('admin')->user()->name ? "You" : $users->where('id', $log->user_id)->first()->name); ?></td>
                                                <td><?php echo e($log->activity); ?></td>
                                                <td><?php echo e($log->created_at->format('M. d, Y')); ?></td>
                                                <td class="center"><a href="" data-toggle="modal" data-target="#activityModal<?php echo e($log->id); ?>">View Details</a></td>
                                            </tr>

                                            <div class='modal fade' id='activityModal<?php echo e($log->id); ?>' role='dialog'>
                                                <div class='modal-dialog modal-sm'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                            <h4 class='modal-title'>Detailed View</h4>
                                                        </div>
                                                        <div class='modal-body'>
                                                            <ul class="list-unstyled">
                                                                <li><?php echo e($users->where('id', $log->user_id)->first()->name); ?></li>
                                                                <li><?php echo e($log->activity); ?></li>
                                                                <li>at <?php echo e($log->created_at->format('M. d, Y h:i:s A')); ?></li>
                                                            </ul>
                                                        </div>
                                                        <div class='modal-footer'>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>