<?php $__env->startSection('content'); ?>
    <div id="wrapper">
        <!-- Navigation -->
        <?php echo $__env->make('backend.admin.templates.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <!-- Page Content -->
        <div id="page-wrapper">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Dashboard</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <?php /*signature-panel*/ ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-12 text-right">
                                        <h3><?php echo e($signature->find(auth('admin')->user()->id)->signature); ?></h3>
                                        <div>Your Signature</div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <span class="pull-left text-danger">Serve as your Digital ID</span>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <?php /*students-panel*/ ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo e($users->where('role', '3')->count()); ?></div>
                                        <div>Total Student(s)</div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo e(route('adminCollectionStudent')); ?>">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php /*advisers-panel*/ ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="glyphicon glyphicon-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo e($users->where(['role' => '2', 'deleted' => '0'])->count()); ?></div>
                                        <div>Total Adviser(s)</div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo e(route('adminCollectionAdviser')); ?>">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <?php /*users-panel*/ ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo e($logs->where('deleted', '0')->count()); ?></div>
                                        <div>Total Log(s)</div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo e(route('adminLogs')); ?>">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="chat-panel panel panel-default">
                            <div class="panel-heading">
                                <span class="fa fa-list-alt fa-fw"></span> Activities of the day
                            </div>
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Activity</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($logs->where('deleted', '0')->get() as $log): ?>
                                            <?php if($users->where('id', $log->user_id)->first()->name != auth('admin')->user()->name && $log->created_at->format('m-d-Y') == \Carbon\Carbon::today()->format('m-d-Y')): ?>
                                                <tr class="odd gradeX">
                                                    <td><?php echo e($users->where('id', $log->user_id)->first()->name); ?></td>
                                                    <td><?php echo e($log->activity); ?></td>
                                                    <td><?php echo e($log->created_at->diffForHumans()); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-lg-4 -->
                    <div class="col-lg-4">
                        <div class="chat-panel panel panel-default" id="chat">
                            <div class="panel-heading">
                                <i class="fa fa-users fa-fw"></i>
                                User List
                                <?php /*<a href="<?php echo e(route('chatRefresh')); ?>"><i class="fa fa-refresh fa-fw pull-right"></i></a>*/ ?>
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <ul class="chat">
                                    <?php foreach($users->where(['deleted' => '0', 'confirmed' => '1'])->get() as $user): ?>
                                        <?php if($user->name != auth('admin')->user()->name): ?>
                                            <li>
                                                <?php echo e($user->name); ?>

                                                <span class="small pull-right">
                                                     <?php echo e($user->isOnline == 0 ? $user->updated_at->diffForHumans() : "Now"); ?><span class="fa fa-circle fa-fw <?php echo e($user->isOnline == 1 ? "text-online" : "text-muted"); ?>"></span>
                                                    </span>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel .chat-panel -->
                    </div>
                </div>
                <?php echo $__env->make('templates.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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