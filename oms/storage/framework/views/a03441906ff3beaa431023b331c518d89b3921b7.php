<?php $__env->startSection('content'); ?>
    <div class="wrapper">
        <?php echo $__env->make('backend.admin.templates.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
       <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Departments</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-6 col-sm-7 col-xs-9">
                                        <h4>
                                            <i class="fa fa-university fa-fw"></i> Campus Departments
                                        </h4>
                                    </div>
                                    <div class="col-md-6 col-sm-5 col-xs-3">
                                        <div class="tooltip-demo pull-right">
                                            <button class="btn btn-success btn-circle" data-toggle="tooltip" data-placement="top" title="Add Department" id="deptTrigger">
                                                <span class="fa fa-plus"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <?php echo e(Form::open(['method' => 'post', 'url' => route('addDepartment'), 'class' => 'form-inline', 'id' => 'addDept', 'style' => 'display: none'])); ?>

                                    <fieldset>
                                        <div class="form-group">
                                            <?php echo e(Form::text('deptName', null, ['class' => 'form-control', 'placeholder' => 'Department Full Title'])); ?>

                                        </div>
                                        <div class="form-group">
                                            <?php echo e(Form::text('deptPrefix', null, ['class' => 'form-control', 'placeholder' => 'Prefix'])); ?>

                                        </div>
                                        <?php echo e(Form::submit('Add Department', ['class' => 'btn btn-success btn-md form-control'])); ?>


                                    </fieldset>

                                    <hr>
                                <?php echo e(Form::close()); ?>

                                <div class="dataTable_wrapper">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                        <tr>
                                            <th>Department</th>
                                            <th>Prefix</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($department->where('deleted', '0')->get() as $dept): ?>
                                            <tr>
                                                <td><?php echo e($dept->name); ?></td>
                                                <td><?php echo e($dept->prefix); ?></td>
                                                <td>
                                                    <a href="">Delete</a>
                                                </td>
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
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    </div>

    <script>
        $(document).ready(function(){
            $("#deptTrigger").click(function(){
                $("#addDept").slideToggle("slow");
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>