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
                                <div class="col-md-8">

                                    <h4><i class="fa fa-user fa-fw"></i> Student List</h4>
                                </div>
                                <div class="col-md-4">
                                    <ul class="list-inline">
                                        <li class="sidebar-search">
                                            <div class="input-group custom-search-form">
                                                <input type="text" class="form-control" placeholder="Search...">
                                             <span class="input-group-btn">
                                                <button class="btn btn-default" type="button">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </span>
                                            </div>
                                            <!-- /input-group -->
                                        </li>
                                    </ul>
                                </div>
                            </div>


                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php foreach( $users as $user ): ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo e($user->name); ?></td>
                                            <td></td>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>